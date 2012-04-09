<?php

class UltimateController extends Zend_Controller_Action
{

    public function init() {
        $this->view->headTitle()->append('L\'utlimate');
        $this->view->headLink()->appendStylesheet('/css/club/club.css');

        $this->view->sections = array(
            array(
                'id' => 1,
                'label' => 'Histoire de Frisbee',
            ),
            array(
                'id' => 2,
                'label' => 'Histoire d\'Ultimate',
            ),
        );
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

