<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet('/css/pagination.css')
                ->appendStylesheet('/css/article.css');
        $this->view->headScript()->appendFile('/js/index_admin.js');
        $article = new Application_Model_ArticleMapper();
        $idEvent = $this->getRequest()->getParam('id_event');
        $page = $this->getRequest()->getParam('page', 1);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('index/_controls.phtml');
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        $articles = $article->findByEvent($idEvent, $page, $paginator);
        $this->view->articles = $articles;
        $this->view->paginator = $paginator;

        $evenementMapper = new Application_Model_EvenementMapper();
        $this->view->nextTraining = $evenementMapper->findNext(1);
        $this->view->nextTournoi = $evenementMapper->findNext(array(4, 5));
        $this->view->video = array();
    }

    public function contactAction() {
        
    }

    public function aproposAction() {
        
    }

    public function mentionsAction() {
        
    }

}

