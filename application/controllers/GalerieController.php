<?php

class GalerieController extends Zend_Controller_Action {

    public function init() {
        $this->view->headLink()->appendStylesheet('/css/galerie/galerie.css');
        $this->view->headTitle()->append('Photos & vidéos');
    }

    public function indexAction() {
        $this->view->headScript()->appendFile('/js/galerie.js');
        $request = $this->getRequest();
        $idAlbum = $request->getParam('id');
        $this->view->adminAlbum = $request->getParam('admin', false);
        $albumMapper = new Application_Model_AlbumMapper();
        $imageMapper = new Application_Model_ImageMapper();
        if (empty($idAlbum)) { // Afficher la liste des albums
            $albums = $albumMapper->fetchAll();
            $images = array();
            for ($i = 0; $i < count($albums); $i++) {
                $images[] = $imageMapper->findFirstImage($albums[$i]);
            }
            $this->view->titre = 'Galerie photos & vidéos';
            $this->view->albums = $albums;
        } else { // Afficher un album
            $album = new Application_Model_Album();
            $albumMapper->find($idAlbum, $album);
            $this->view->titre = 'Album "'.$album->getNom().'"';
            $images = $album->getImages();
            $this->view->album = $album;
        }
        $this->view->images = $images;
    }

    public function ajouterAction() {
        $request = $this->getRequest();
        $albumMapper = new Application_Model_AlbumMapper();
        // Enregistrement du nouvel album
        if (!is_null($nom = $request->getParam('nom'))) {
            $album = new Application_Model_Album(array(
                        'nom' => $nom,
                        'date' => new Zend_Date()));
            $albumMapper->save($album);
            mkdir(APPLICATION_PATH.'/../public/'.$album->getMiniPath(), $recursive = true);
            mkdir(APPLICATION_PATH.'/../public/'.$album->getPath(), $recursive = true);
            $this->_helper->flashMessenger('Album ajoutée avec succès');
        }
        $this->_redirect($this->_helper->url('index', 'galerie', null, array('admin' => true)));
    }

    public function supprimerAction() {
        $request = $this->getRequest();
        $albumMapper = new Application_Model_AlbumMapper();
        if (!is_null($ids = $request->getParam('del'))) {
            foreach ($ids as $id) {
                $album = new Application_Model_Album();
                $albumMapper->find($id, $album);
                // Suppression des photos
                $this->_helper->rmDir(APPLICATION_PATH.'/../public/'.$album->getMiniPath());
                $this->_helper->rmDir(APPLICATION_PATH.'/../public/'.$album->getPath());
                $albumMapper->getDbTable()->delete(array('id = ?' => $id));
            }
            $this->_helper->flashMessenger('Albums supprimés avec succès');
        }
        $this->_redirect($this->_helper->url('index', 'galerie', null, array('admin' => true)));
    }

    public function bandeauAction() {
        $this->view->headScript()->appendFile('/js/jquery/jquery.jcrop.min.js')
                ->appendFile('/js/bandeau_admin.js');
        $this->view->headLink()->appendStylesheet('/css/galerie/jquery.jcrop.min.css')
                ->appendStylesheet('/css/galerie/bandeau.css');
        $imageMapper = new Application_Model_ImageMapper();
        $request = $this->getRequest();
        if (!is_null($imgCrop = $request->getParam('imgCrop'))) {
            $destWidth = 900;
            $destHeight = 200;
            $width = $request->getParam('width');
            $height = $request->getParam('height');
            if ($width < $destWidth || $height < $destHeight) {
                throw new Zend_Exception("La hauteur et ou la largeur sont trop petits ($width x $height)");
            }
            // Sauvegarde en BDD
            $image = new Application_Model_Image(array(
                        'nom' => basename($imgCrop),
                        'width' => $width,
                        'height' => $height,
                        'slideshow' => true,
                    ));
            $imageMapper->save($image);
            // Sauvegarde de l'image rogné
            $img_r = imagecreatefromjpeg(APPLICATION_PATH.'/../public/'.$imgCrop);
            $dst_r = ImageCreateTrueColor($destWidth, $destHeight);
            $x1 = $request->getParam('x1');
            $y1 = $request->getParam('y1');
            $x2 = $request->getParam('x2');
            $y2 = $request->getParam('y2');
            imagecopyresampled($dst_r, $img_r, 0, 0, $x1, $y1, $destWidth, $destHeight, $width, $height);
            $jpeg_quality = 90;
            imagejpeg($dst_r, APPLICATION_PATH.'/../public/'.$image->getNomWithPath(), $jpeg_quality);
            unlink(APPLICATION_PATH.'/../public/'.Application_Model_Image::_getBandeauUploadedPath().$image->getNom());
        }
        $this->view->images = $imageMapper->fetchBandeau();
    }

    public function supprimerbandeauAction() {
        $request = $this->getRequest();
        $imageMapper = new Application_Model_ImageMapper();
        if (!is_null($id = $request->getParam('id'))) {
            $image = new Application_Model_Image();
            $imageMapper->find($id, $image);
            unlink(APPLICATION_PATH.'/../public/'.$image->getNomWithPath());
            $imageMapper->getDbTable()->delete(array('id = ?' => $id));
            $this->_helper->flashMessenger('Image supprimée avec succès');
        }
        $this->_redirect($this->_helper->url('bandeau', 'galerie'));
    }

}

