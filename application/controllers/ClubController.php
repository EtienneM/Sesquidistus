<?php

class ClubController extends My_Controller_Action_CustomContent {

    public function init() {
        $this->_titre = 'Le club';
        $this->_styleSheets[] = '/css/club/club.css';

        $this->_sections = array(
            array(
                'id' => 1,
                'label' => 'Présentation',
            ),
            array(
                'id' => 2,
                'label' => 'Palmarès',
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
        $this->view->club = array(
            'titre' => 'biniou',
            'contenu' => 'bliblablou'
        );
        $this->view->id = $id;
    }


}

