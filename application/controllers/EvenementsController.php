<?php

class EvenementsController extends Zend_Controller_Action {

    public function init() {
        $this->view->headLink()->appendStylesheet('/css/event/event.css');
        $this->view->headTitle()->append('Nos évènements');
    }

    public function indexAction() {
        $this->view->headScript()->appendFile('/js/evenements.js');
        $type = $this->getRequest()->getParam('type', 5);
        $evenementMapper = new Application_Model_EvenementMapper();
        $yearBegin = '2010';
        $dateToday = new Zend_Date('01/09/'.date('Y'), Zend_Date::DAY.'/'.Zend_Date::MONTH.'/'.Zend_Date::YEAR);
        $evenements = array();
        while ($yearBegin <= ($currentYear = $dateToday->get(Zend_Date::YEAR))) {
            $e = $evenementMapper->findBySeason($dateToday, $type);
            if (!empty($e)) {
                $evenements[$currentYear.' - '.($currentYear + 1)] = $e;
            }
            $dateToday->subYear(1);
        }
        $this->view->evenements = $evenements;
        $this->view->type = $type;
    }

}

