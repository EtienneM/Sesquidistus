<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet("/css/membres/login.css");
    }

    public function editprofilAction() {
        // TODO Vérification des droits.
        $this->view->headLink()->appendStylesheet("/css/membres/profil.css");
    }
}

