<?php

class GalerieController extends Zend_Controller_Action {

    public function init() {
        $this->view->headLink()->appendStylesheet('/css/gallerie/galerie.css');
        $this->_titre = 'Photos & vidéos';
    }

    public function indexAction() {
    }
}

