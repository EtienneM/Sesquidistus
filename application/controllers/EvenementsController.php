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
        $articleMapper = new Application_Model_ArticleMapper();
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

}

