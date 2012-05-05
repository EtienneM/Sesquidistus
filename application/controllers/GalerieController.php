<?php

class GalerieController extends Zend_Controller_Action {

    public function init() {
        $this->view->headLink()->appendStylesheet('/css/galerie/galerie.css');
        $this->view->headTitle()->append('Photos & vidéos');
    }

    public function indexAction() {
        $request = $this->getRequest();
        $idAlbum = $request->getParam('id');
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

}

