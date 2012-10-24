<?php

class GalerieController extends Zend_Controller_Action {

    public function init() {
        $this->view->headLink()->appendStylesheet('/css/galerie/galerie.css');
        $this->view->headTitle()->append('Photos & vidéos');
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet('/css/facebook.css');
        $this->view->headScript()->appendFile('/js/galerie.js');
        $request = $this->getRequest();
        $idAlbum = $request->getParam('id');
        $this->view->adminAlbum = $request->getParam('admin', false);
        $albumMapper = new Application_Model_Mapper_Album();
        $imageMapper = new Application_Model_Mapper_Image();
        if (!is_null($request->getParam('kym'))) { // Affiche les albums qui concerne le KYM
            $this->view->isAlbum = false; // True if we display an album
            $albums = $albumMapper->fetchAll();
            $this->view->titre = 'Galerie photos & vidéos du Keep Your Mustache';
            $albums = $albumMapper->findKym();
            $images = array();
            foreach ($albums as $album) {
                $images[] = $album->getFirstImage();
            }
            $this->view->albums = $albums;
        } else if (empty($idAlbum)) { // Afficher la liste des albums
            $this->view->isAlbum = false; // True if we display an album
            $albums = $albumMapper->fetchAll();
            $images = array();
            $iDefault = null;
            $videoMapper = new Application_Model_Mapper_Video();
            for ($i = 0; $i < count($albums); $i++) {
                if ($albums[$i]->id == 1) {
                    $iDefault = $i;
                    continue;
                }
                $res = $imageMapper->findFirstImage($albums[$i]);
                // S'il n'y a pas de première image, on peut trouver du côté des vidéos
                if (empty($res)) {
                    $res = $videoMapper->findFirstImage($albums[$i]);
                }
                $images[] = $albums[$i]->getFirstImage();
            }
            /*
             * Ne pas afficher l'album par défaut (id=1)
             */
            if (!is_null($iDefault)) {
                $tmp = array();
                for ($i = 0; $i < count($albums); $i++) {
                    if ($i == $iDefault) {
                        continue;
                    }
                    $tmp[] = $albums[$i];
                }
                $albums = $tmp;
            }
            $this->view->titre = 'Galerie photos & vidéos';
            $this->view->albums = $albums;
        } else { // Afficher un album
            $this->view->isAlbum = true; // True if we display an album
            $album = new Application_Model_Album();
            $albumMapper->find($idAlbum, $album);
            $this->view->titre = 'Album "' . $album->getNom() . '"';
            $images = $album->getImages();
            $this->view->album = $album;
            $albums = $albumMapper->fetchAll();
            $this->view->albums = $albums;
            $this->view->videos = $album->getVideos();
        }
        $this->view->images = $images;
    }

    public function ajouterAction() {
        $request = $this->getRequest();
        $albumMapper = new Application_Model_Mapper_Album();
        // Enregistrement du nouvel album
        if (!is_null($nom = $request->getParam('nom'))) {
            $album = new Application_Model_Album(array(
                        'nom' => $nom,
                        'date' => new Zend_Date()));
            $albumMapper->save($album);
            mkdir(APPLICATION_PATH . '/../public/' . $album->getMiniPath(), $recursive = true);
            mkdir(APPLICATION_PATH . '/../public/' . $album->getPath(), $recursive = true);
            $this->_helper->flashMessenger('Album ajouté avec succès');
        }
        $this->_redirect($this->_helper->url('index', 'galerie', null, array('admin' => true)));
    }

    /**
     * Suppression d'un album. 
     */
    public function supprimeralbumAction() {
        $request = $this->getRequest();
        $albumMapper = new Application_Model_Mapper_Album();
        if (!is_null($ids = $request->getParam('elements'))) {
            foreach ($ids as $id) {
                $album = new Application_Model_Album();
                $albumMapper->find($id, $album);
                // Suppression des photos
                $this->_helper->rmDir(APPLICATION_PATH . '/../public/' . $album->getMiniPath());
                $this->_helper->rmDir(APPLICATION_PATH . '/../public/' . $album->getPath());
                // TODO: Suppression des photos et vidéos de la BDD
                $albumMapper->getDbTable()->delete(array('id = ?' => $id));
            }
            $this->_helper->flashMessenger('Album(s) supprimé(s) avec succès');
        }
        $this->_redirect($this->_helper->url('index', 'galerie', null, array('admin' => true)));
    }

    /**
     * Suppression d'images et/ou de vidéos. 
     */
    public function supprimerelementsAction() {
        $request = $this->getRequest();
        $idAlbum = $request->getParam('idAlbum');
        if (empty($idAlbum)) {
            $this->_helper->flashMessenger('Impossible de supprimer les éléments sélectionnés. Veuillez contacter le webmaster.');
            $this->_redirect($this->_helper->url('index', 'galerie', null, array()));
        }
        $albumMapper = new Application_Model_Mapper_Album();
        $album = new Application_Model_Album();
        $albumMapper->find($idAlbum, $album);
        $idsImages = $request->getParam('elements', array());
        $idsVideos = $request->getParam('videos', array());
        if (!empty($idsImages)
                || !empty($idsVideos)) {
            $imageMapper = new Application_Model_Mapper_Image();
            $videoMapper = new Application_Model_Mapper_Video();
            foreach ($idsImages as $id) {
                $image = new Application_Model_Image();
                $imageMapper->find($id, $image);
                $image->setAlbum($album);
                // Suppression des photos
                $nom = $image->getNom();
                if (!empty($nom)) {
                    unlink(APPLICATION_PATH . '/../public/' . $image->getNomWithPath());
                    unlink(APPLICATION_PATH . '/../public/' . $image->getNomWithMiniPath());
                }
                $imageMapper->getDbTable()->delete(array('id = ?' => $id));
            }
            if (!empty($idsImages)) {
                $this->_helper->flashMessenger('Image(s) supprimée(s) avec succès');
            }
            foreach ($idsVideos as $id) {
                $videoMapper->getDbTable()->delete(array('id = ?' => $id));
            }
            if (!empty($idsVideos)) {
                $this->_helper->flashMessenger('Vidéo(s) supprimée(s) avec succès');
            }
        }
        $this->_redirect($this->_helper->url('index', 'galerie', null, array('id' => $idAlbum, 'admin' => true)));
    }

    /**
     * Déplacer des vidéos ou des photos dans un nouvel album 
     */
    public function deplacerAction() {
        $request = $this->getRequest();
        $idAlbum = $request->getParam('idAlbum');
        //For debugging purpose when commenting the redirect instruction
        //$this->_helper->layout->disableLayout();
        //$this->_helper->viewRenderer->setNoRender(true);
        if (empty($idAlbum)) {
            $this->_helper->flashMessenger('Impossible de supprimer les éléments sélectionnés. Veuillez contacter le webmaster.');
            $this->_redirect($this->_helper->url('index', 'galerie', null, array()));
        }
        $albumMapper = new Application_Model_Mapper_Album();
        $albumSrc = new Application_Model_Album();
        $albumMapper->find($idAlbum, $albumSrc);
        $destination = $request->getParam('albumDestination');
        $idsImages = $request->getParam('elements', array());
        $idsVideos = $request->getParam('videos', array());
        if ((!empty($idsImages) || !empty($idsVideos)) && !empty($destination)) {
            $albumDestination = new Application_Model_Album();
            $directory = APPLICATION_PATH . '/../public/' . $albumDestination->getPath();
            if (!is_dir($directory)) {
                mkdir($directory);
            }
            $albumMapper->find($destination, $albumDestination);
            $imageMapper = new Application_Model_Mapper_Image();
            foreach ($idsImages as $id) {
                $image = new Application_Model_Image();
                $imageMapper->find($id, $image);
                $image->setAlbum($albumSrc);
                // Déplacement des fichiers
                $nom = $image->getNom();
                if (!empty($nom)) {
                    $src = APPLICATION_PATH . '/../public/' . $image->getNomWithPath();
                    $srcMini = APPLICATION_PATH . '/../public/' . $image->getNomWithMiniPath();
                    $image->setAlbum($albumDestination);
                    if (file_exists($src)) {
                        rename($src, APPLICATION_PATH . '/../public/' . $image->getNomWithPath());
                    }
                    if (file_exists($srcMini)) {
                        rename($srcMini, APPLICATION_PATH . '/../public/' . $image->getNomWithMiniPath());
                    }
                } else {
                    $image->setAlbum($albumDestination);
                }
                $imageMapper->save($image);
            }
            if (!empty($idsImages)) {
                $this->_helper->flashMessenger('Image(s) déplacée(s) avec succès');
            }
            $videoMapper = new Application_Model_Mapper_Video();
            foreach ($idsVideos as $id) {
                $video = new Application_Model_Video();
                $videoMapper->find($id, $video);
                $video->setAlbum($albumDestination);
                $videoMapper->save($video);
            }
            if (!empty($idsVideos)) {
                $this->_helper->flashMessenger('Vidéo(s) déplacée(s) avec succès');
            }
        }
        $this->_redirect($this->_helper->url('index', 'galerie', null, array('id' => $idAlbum, 'admin' => true)));
    }

    /**
     * Soumettre une vidéo ou des photos
     */
    public function soumettreAction() {
        $this->view->headScript()->appendFile('/js/fileuploader.js')
                ->appendFile('/js/soumettre.js');
        $this->view->headLink()->appendStylesheet('/css/fileuploader.css');
        $albumMapper = new Application_Model_Mapper_Album();
        $this->view->albums = $albumMapper->fetchAll();
        $request = $this->getRequest();
        if (!is_null($uri = $request->getParam('lienVideo'))
                && !is_null($id_album = $request->getParam('sltAlbumVideo'))) {
            $album = new Application_Model_Album();
            $albumMapper->find($id_album, $album);
            $videoMapper = new Application_Model_Mapper_Video();
            $getId = new My_Filter_VideoID();
            $res = $getId->filter($uri);
            $video = new Application_Model_Video(array(
                        'type' => $res['type'],
                        'id_site' => $res['id'],
                        'titre' => $res['title'],
                        'description' => $res['description'],
                        'id_album' => $album->getId(),
                    ));
            $videoMapper->save($video);
            $this->view->flashMessages = array_merge(array('Vidéo ajoutée avec succès'), $this->view->flashMessages);
        }
    }

    /**
     * Upload d'une photo
     */
    public function uploadAction() {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $this->_helper->layout->disableLayout();
        }
        $albumMapper = new Application_Model_Mapper_Album();
        $album = new Application_Model_Album();
        $albumMapper->find($this->getRequest()->getParam('sltAlbum'), $album);
        $directory = APPLICATION_PATH . '/../public/' . $album->getPath();
        if (!is_dir($directory)) {
            mkdir($directory);
        }
        $res = $this->_helper->fileupload($directory);
        // If upload is a success...
        if (isset($res['success']) && $res['success']) {
            // ... add to DB and...
            $imageMapper = new Application_Model_Mapper_Image();
            $image = new Application_Model_Image(array(
                        'nom' => $res['name'],
                        'height' => $res['height'],
                        'width' => $res['width'],
                        'id_album' => $album->getId(),
                    ));
            $imageMapper->save($image);
            // ... create the thumbnail
            $createThumbnail = new My_Controller_Action_CreateThumbnail($directory . '/' . $res['name'], APPLICATION_PATH . '/../public/' . $album->getMiniPath(), 120);
            $createThumbnail->create();
            $this->_helper->flashMessenger('Image ajoutée avec succès');
        }
        $this->getResponse()->setHeader('content-type', 'application/json', true);
        echo htmlspecialchars(Zend_Json::encode($res), ENT_NOQUOTES);
    }

    /**
     * Action pour l'administration du bandeau défilant
     * @throws Zend_Exception 
     */
    public function bandeauAction() {
        $this->view->headTitle()->append('Modifier le bandeau');
        $this->view->headScript()->appendFile('/js/jquery/jquery.jcrop.min.js')
                ->appendFile('/js/jquery/jquery.validate.min.js')
                ->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js')
                ->appendFile('/js/bandeau_admin.js');
        $this->view->headLink()->appendStylesheet('/css/galerie/jquery.jcrop.min.css')
                ->appendStylesheet('/css/galerie/bandeau.css');
        $imageMapper = new Application_Model_Mapper_Image();
        $request = $this->getRequest();
        $errorMessages = $request->getParam('errorMessages', array());
        // Une image vient d'être uploadée et doit être rognée
        if (!is_null($img = $request->getParam('imgToCrop'))) {
            // S'il n'y a pas eu d'erreurs
            if (empty($errorMessages)) {
                $this->view->imgToCrop = Application_Model_Image::_getBandeauUploadedPath() . $img;
            }
        } // Une image vient d'être rognée
        else if (!is_null($imgCrop = $request->getParam('imgCrop'))) {
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
            $img_r = imagecreatefromjpeg(APPLICATION_PATH . '/../public/' . $imgCrop);
            $dst_r = ImageCreateTrueColor($destWidth, $destHeight);
            $x1 = $request->getParam('x1');
            $y1 = $request->getParam('y1');
            imagecopyresampled($dst_r, $img_r, 0, 0, $x1, $y1, $destWidth, $destHeight, $width, $height);
            $jpeg_quality = 90;
            imagejpeg($dst_r, APPLICATION_PATH . '/../public/' . $image->getNomWithPath(), $jpeg_quality);
            unlink(APPLICATION_PATH . '/../public/' . Application_Model_Image::_getBandeauUploadedPath() . $image->getNom());
            $this->_helper->flashMessenger('Image ajoutée au bandeau');
        }
        $this->view->errorMessages = $errorMessages;
        $this->view->images = $imageMapper->fetchBandeau();
    }

    /**
     * Suppression d'une image du bandeau défilant 
     */
    public function supprimerbandeauAction() {
        $request = $this->getRequest();
        $imageMapper = new Application_Model_Mapper_Image();
        if (!is_null($id = $request->getParam('id'))) {
            $image = new Application_Model_Image();
            $imageMapper->find($id, $image);
            unlink(APPLICATION_PATH . '/../public/' . $image->getNomWithPath());
            $imageMapper->getDbTable()->delete(array('id = ?' => $id));
            $this->_helper->flashMessenger('Image supprimée avec succès');
        }
        $this->_redirect($this->_helper->url('bandeau', 'galerie'));
    }

    /**
     * Ajout d'une image au bandeau défilant
     */
    public function ajouterbandeauAction() {
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $adapter->addValidator(new Zend_Validate_File_Count(1))
                ->addValidator(new Zend_Validate_File_Size(array('min' => 0, 'max' => 5242880)))// Max size = 5 Mo
                ->addValidator(new Zend_Validate_File_IsImage('image/jpeg'));
        $file = $adapter->getFileInfo('imgSrc');
        $filterAccent = new My_Filter_Accent();
        $filename = $filterAccent->filter($file['imgSrc']['name']);
        $bandeauUploadedAbsolutePath = APPLICATION_PATH . '/../public/' . Application_Model_Image::_getBandeauUploadedPath();
        $adapter->addFilter(new Zend_Filter_File_Rename(array(
                    'target' => $bandeauUploadedAbsolutePath . $filename,
                    'overwrite' => true,
                )));
        if (!file_exists($bandeauUploadedAbsolutePath)) {
            mkdir($bandeauUploadedAbsolutePath);
        }
        $adapter->receive('imgSrc');
        $this->_forward('bandeau', 'galerie', null, array('imgToCrop' => $filename, 'errorMessages' => $adapter->getMessages()));
    }

}

