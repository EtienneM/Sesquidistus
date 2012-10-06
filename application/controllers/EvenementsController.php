<?php

class EvenementsController extends Zend_Controller_Action {

    public function init() {
        $this->view->headLink()->appendStylesheet('/css/event/event.css');
        $this->view->headTitle()->append('Nos évènements');
    }

    public function indexAction() {
        $this->view->headScript()->appendFile('/js/evenements.js');
        $type = $this->getRequest()->getParam('type', 5);
        $evenementMapper = new Application_Model_Mapper_Evenement();
        $articleMapper = new Application_Model_Mapper_Article();
        // Depuis 2010 car c'est la date de création du site...
        $yearBegin = '2010';
        // ... jusqu'à cette année
        $dateToday = new Zend_Date('01/09/'.date('Y'), Zend_Date::DAY.'/'.Zend_Date::MONTH.'/'.Zend_Date::YEAR);
        $evenements = array();
        while ($yearBegin <= ($currentYear = $dateToday->get(Zend_Date::YEAR))) {
            $evenementsSaison = $evenementMapper->findBySeason($dateToday, $type);
            if (!empty($evenementsSaison)) {
                $evenements[$currentYear.' - '.($currentYear + 1)]['evenements'] = $evenementsSaison;
                $articles = array();
                foreach ($evenementsSaison as $evenement) {
                    // TODO à améliorer...
                    $id = $evenement->id;
                    if (count($articleMapper->findByEvent($id)) > 0) {
                        $articles[$id] = true;
                    } else {
                        $articles[$id] = false;
                    }
                }
                $evenements[$currentYear.' - '.($currentYear + 1)]['article'] = $articles;
            }
            $dateToday->subYear(1);
        }
        $this->view->evenements = $evenements;
        $this->view->type = $type;
    }

    public function listAction() {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $this->_helper->layout->disableLayout();
        }
        $begining = $request->getParam('term');
        $evenementMapper = new Application_Model_Mapper_Evenement();
        $events = $evenementMapper->findByWord($begining);
        $results = array();
        foreach ($events as $event) {
            $results[] = array(
                'id' => $event->id,
                'value' => $event->titre.' : '.$event->date->get(Zend_Date::DAY.'/'.Zend_Date::MONTH.'/'.Zend_Date::YEAR),
            );
        }
        $this->getResponse()->setHeader('content-type', 'application/json', true);
        echo Zend_Json::encode($results);
    }
    
    public function kymAction() {
        $this->view->headTitle()->append('Keep Your Moustache');
        $this->view->headLink()->appendStylesheet('/css/pagination.css')
                ->appendStylesheet('/css/article.css');
        $page = $this->getRequest()->getParam('page', 1);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('_controls.phtml');
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        $paginator = null;
        $articleMapper = new Application_Model_Mapper_Article();
        $this->view->articles = $articleMapper->findKym($page, $paginator);
        $this->view->paginator = $paginator;
        $albumMapper = new Application_Model_Mapper_Album();
        if (count($albums = $albumMapper->findKym()) > 0) {
            $this->view->album = $albums[0];
            foreach ($albums as $album) {
                $image = $album->getFirstImage();
                if (!is_null($image)) {
                    $this->view->album = $album;
                    break;
                }
            }
        }
    }

}

