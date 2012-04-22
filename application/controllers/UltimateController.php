<?php

class UltimateController extends My_Controller_Action_CustomContent {

    public function init() {
        $this->_titre = 'L\'utlimate';
        $this->view->headLink()->appendStylesheet('/css/club/club.css');

        $this->_sections = array(
            array(
                'id' => 1,
                'label' => 'Histoire de Frisbee',
            ),
            array(
                'id' => 2,
                'label' => 'Histoire d\'Ultimate',
            ),
        );
        parent::init();
    }

    public function indexAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        if (!isset($id)) {
            $id = 1;
        }
        // Requête SQL pour trouver en fonction de l'id le contenu
        $this->view->ultimate = array(
            'titre' => 'biniou',
            'contenu' => 'bliblablou'
        );
        $this->view->id = $id;
    }
}

