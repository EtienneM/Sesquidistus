<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet('/css/pagination.css');
        $article = new Application_Model_ArticleMapper();
        $idEvent = $this->getRequest()->getParam('id_event');
        $page = $this->getRequest()->getParam('page', 1);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('index/_controls.phtml');
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        $articles = $article->findByEvent($idEvent, $page, $paginator);
        $this->view->articles = $articles;
        $this->view->paginator = $paginator;

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

