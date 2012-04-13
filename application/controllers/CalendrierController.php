<?php

class CalendrierController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        /* $es = new Application_Model_DbTable_Evenement();
          $e = $es->find(376)->current();
          //Zend_Debug::dump($e->findParentRow('Application_Model_DbTable_TypeEvent'));
          Zend_Debug::dump($e->findParentApplication_Model_DbTable_TypeEvent()); */
        /* $es = new Application_Model_DbTable_TypeEvent();
          $e = $es->find(1)->current();
          //Zend_Debug::dump($e->findDependentRowset('Application_Model_DbTable_Evenement'));
          Zend_Debug::dump($e->findApplication_Model_DbTable_Evenement()); */
        $this->view->headLink()->appendStylesheet('/css/calendrier/calendrier_consultation.css');
        $this->view->headScript()
                ->appendFile('/js/calendrier_global.js')
                ->appendFile('/js/calendrier_consultation.js');
        
        $mois = $this->getRequest()->getParam('mois');
        $annee = $this->getRequest()->getParam('annee');
        if (!isset($mois) || !isset($annee)) {
            $displayedMonth = new Zend_Date(null, Zend_Date::MONTH.'/'.Zend_Date::YEAR);
        } else {
            $displayedMonth = new Zend_Date($mois.'/'.$annee, Zend_Date::MONTH.'/'.Zend_Date::YEAR);
        }
        $eventMapper = new Application_Model_EvenementMapper();
        $events = $eventMapper->getFromMonth($displayedMonth);
        
        $this->view->displayedMonth = $displayedMonth;
        $this->view->legend = array(); // TODO
        $this->view->evenements = $events;
    }

    public function ajoutAction() {
        $this->view->headLink()->appendStylesheet('/css/calendrier/calendrier_ajout.css');
    }

}

