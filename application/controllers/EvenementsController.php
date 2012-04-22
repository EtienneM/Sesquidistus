<?php

class EvenementsController extends Zend_Controller_Action {

    public function init() {
        $this->view->headLink()->appendStylesheet('/css/event/event.css');
    }

    public function indexAction() {
        $this->view->evenements = array();
        $evenement = new ArrayObject(array(
            'id' => 392,
            'titre'=>'Le titre',
            'lieu'=>'Le lieu',
            'date'=>new Zend_Date(),
        ), ArrayObject::ARRAY_AS_PROPS);
        $this->view->evenements[] = $evenement;
    }

}

