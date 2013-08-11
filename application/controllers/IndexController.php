<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet('/css/pagination.css')
                ->appendStylesheet('/css/article.css')
                ->appendStylesheet('/css/social.css');
        $this->view->headScript()->appendFile('/js/index_admin.js')
                ->appendFile('/js/index.js');
        $articleMapper = new Application_Model_Mapper_Article();
        $idEvent = $this->getRequest()->getParam('id_event');
        $page = $this->getRequest()->getParam('page', 1);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('_controls.phtml');
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        $paginator = null;
        if (!is_null($id = $this->getRequest()->getParam('id_article'))) {
            $article = new Application_Model_Article();
            $articleMapper->find($id, $article);
            $articles = array($article);
        } else {
            $articles = $articleMapper->findByEvent($idEvent, $page, $paginator);
        }
//         foreach ($articles as $article) {
//         	$article->getDate()->setLocale($this->view->translate->getLocale());
//         }
        $this->view->articles = $articles;
        $this->view->paginator = $paginator;

        $evenementMapper = new Application_Model_Mapper_Evenement();
        $this->view->nextTraining = $evenementMapper->findNext(1);
        $this->view->nextTournoi = $evenementMapper->findNext(array(4, 5, 11));
        $videoMapper = new Application_Model_Mapper_Video();
        $this->view->video = $videoMapper->findLastVideo();
    }
}

