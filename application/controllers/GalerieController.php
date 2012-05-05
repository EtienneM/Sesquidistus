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

}

