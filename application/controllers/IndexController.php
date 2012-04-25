<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $article = new Application_Model_ArticleMapper();
        $idEvent = $this->getRequest()->getParam('id_event');
        if (is_null($idEvent)) {
            $this->view->articles = $article->fetchAll();
        } else {
            $this->view->articles = $article->findByEvent($idEvent);
        }
        $this->view->nextTraining = array(
            'titre' => 'Entrainement Outdoor',
            'date' => new Zend_Date(),
            'nom_lieu' => 'Stade U',
            'horaire_debut' => '9h',
            'horaire_fin' => '10h',
        );
        $this->view->nextTournoi = array(
            'titre' => 'Championnat FFDF Open Outdoor ',
            'dateEvent' => 'Du 28/04/2012 au 29/04/2012',
            'nom_lieu' => 'Besançon',
        );
        $this->view->video = array();
    }

    public function contactAction() {
        // action body
    }

    public function aproposAction() {
        // action body
    }

    public function mentionsAction() {
        // action body
    }

}

