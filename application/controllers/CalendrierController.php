<?php

class CalendrierController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->append('Calendrier');
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
        $this->mergeQueryString();
        $this->view->headLink()->appendStylesheet('/css/calendrier/calendrier_consultation.css');
        $this->view->headScript()->appendFile('/js/calendrier.js');

        $mois = $this->getRequest()->getParam('mois');
        $annee = $this->getRequest()->getParam('annee');
        $datePicker = new Application_Form_DatePicker();
        $invalidForm = true;
        if (isset($mois) && isset($annee)) {
            if ($datePicker->isValid($this->getRequest()->getParams())) {
                $datePicker->getElement('mois')->setValue($mois);
                $datePicker->getElement('annee')->setValue($annee);
                $displayedMonth = new Zend_Date($mois.'/'.$annee, Zend_Date::MONTH.'/'.Zend_Date::YEAR);
                $invalidForm = false;
            }
        }
        if ($invalidForm) {
            $displayedMonth = new Zend_Date(null, Zend_Date::MONTH.'/'.Zend_Date::YEAR);
            $datePicker->getElement('mois')->setValue($displayedMonth->get(Zend_Date::MONTH));
            $datePicker->getElement('annee')->setValue($displayedMonth->get(Zend_Date::YEAR));
        }


        $eventMapper = new Application_Model_EvenementMapper();
        $events = $eventMapper->findByMonth(new Zend_Date($displayedMonth));
        $legend = array();
        foreach ($events as $event) {
            if (!isset($legend[$event->type->numero])) {
                $legend[$event->type->numero] = $event->type;
            }
        }

        $this->view->datePicker = $datePicker;
        $this->view->displayedMonth = $displayedMonth;
        $this->view->legend = $legend;
        $this->view->evenements = $events;
    }

    /**
     * Translate standard URL parameters (?foo=bar&baz=bork) to zend-style 
     * param (foo/bar/baz/bork).  Query-string style
     * values override existing route-params.
     */
    public function mergeQueryString() {
        if ($this->getRequest()->isPost()) {
            throw new Exception("mergeQueryString only works on GET requests.");
        }
        $q = $this->getRequest()->getQuery();
        $p = $this->getRequest()->getParams();
        if (empty($q)) {
            //there's nothing to do.
            return;
        }
        $action = $p['action'];
        $controller = $p['controller'];
        $module = $p['module'];
        unset($p['action'], $p['controller'], $p['module']);
        $params = array_merge($p, $q);
        $this->_helper->getHelper('Redirector')
                ->setCode(301)
                ->gotoSimple(
                        $action, $controller, $module, $params);
    }

    public function ajouterAction() {
        $this->view->headLink()->appendStylesheet('/css/calendrier/calendrier_ajout.css');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.additional-methods.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js');
        $this->view->headScript()->appendFile('/js/calendrier_ajout.js');

        $request = $this->getRequest();
        // Si le formulaire a été soumis
        if (count($request->getPost()) > 0) {
            /*
             * Validation
             */
            $nom = $request->getParam('nomEvent');
            $dates = explode(',', $request->getParam('hdnDates'));
            if (!empty($nom) && !empty($dates)) {
                $evenementMapper = new Application_Model_EvenementMapper();
                if (!$request->getParam('boolHoraire')) {
                    $horaireDebut = $request->getParam('debutEventHeure').'h'.$request->getParam('debutEventMinute');
                    $horaireFin = $request->getParam('finEventHeure').'h'.$request->getParam('finEventMinute');
                } else {
                    $horaireDebut = null;
                    $horaireFin = null;
                }
                foreach ($dates as $date) {
                    // Because of the last ',' in hdnDates value
                    if (empty($date)) {
                        continue;
                    }
                    $evenement = new Application_Model_Evenement(array(
                                'type' => $request->getParam('typeEvent', 1),
                                'date' => $date,
                                'titre' => $nom,
                                'id_lieu' => $request->getParam('id_lieuEvent', 0),
                                'lieu' => $request->getParam('text_lieuEvent', ''),
                                'duree' => $request->getParam('duree_event'),
                                'horaire_debut' => $horaireDebut,
                                'horaire_fin' => $horaireFin,
                                'description' => $request->getParam('commentaireEvent'),
                            ));
                    $evenementMapper->save($evenement);
                }
                $this->_helper->flashMessenger("Evènement correctement ajouté");
            } else {
                $this->_helper->flashMessenger("Le nom et les dates de l'évènement doivent être renseignés");
            }
        }

        $typeEventMapper = new Application_Model_TypeEventMapper();
        $this->view->types = $typeEventMapper->fetchAll();
        $lieuMapper = new Application_Model_LieuUltimateMapper();
        $this->view->lieux = $lieuMapper->fetchAll();
    }

}

