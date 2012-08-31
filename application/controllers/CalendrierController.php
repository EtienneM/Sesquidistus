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


        $eventMapper = new Application_Model_Mapper_Evenement();
        $tmpEvents = $eventMapper->findByMonth(new Zend_Date($displayedMonth));
        $legend = array();
        $events = array();
        foreach ($tmpEvents as $event) {
            if (!isset($legend[$event->type->id])) {
                $legend[$event->type->id] = $event->type;
            }
            $currentEventDate = new Zend_Date($event->date);
            for ($i = 0; $i < $event->getDuree(); $i++) {
                if (!isset($events[$currentEventDate->getIso()])) {
                    $events[$currentEventDate->getIso()] = array();
                }
                $events[$currentEventDate->getIso()][] = $event;
                $currentEventDate->addDay(1);
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

    public function editerAction() {
        $this->view->headLink()->appendStylesheet('/css/calendrier/calendrier_ajout.css');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.additional-methods.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js');
        $this->view->headScript()->appendFile('/js/calendrier_ajout.js');

        $request = $this->getRequest();
        $evenementMapper = new Application_Model_Mapper_Evenement();
        $evenement = new Application_Model_Evenement();
        $id=$request->getParam('id_event');
        
        // S'il s'agit d'une modification 
        if (!empty($id)) {
            $evenementMapper->find($id, $evenement);
        }
        $this->view->evenement = $evenement;
        
        // Si le formulaire a été soumis
        if (count($request->getPost()) > 0) {
            /*
             * Validation
             */
            $id = $request->getParam('hdnId');
            $nom = $request->getParam('nomEvent');
            $dates = explode(',', $request->getParam('hdnDates'));
            if (!empty($nom) && !empty($dates)) {
                if (!$request->getParam('boolHoraire')) {
                    $minuteDebut = ($request->getParam('debutEventMinute') == 0)?'00':$request->getParam('debutEventMinute');
                    $horaireDebut = $request->getParam('debutEventHeure').'h'.$minuteDebut;
                    $minuteFin = ($request->getParam('finEventMinute') == 0)?'00':$request->getParam('finEventMinute');
                    $horaireFin = $request->getParam('finEventHeure').'h'.$minuteFin;
                } else {
                    $horaireDebut = null;
                    $horaireFin = null;
                }
                foreach ($dates as $date) {
                    // Because of the last ',' in hdnDates value
                    if (empty($date)) {
                        continue;
                    }
                    $idNewEvenement = null;
                    if (!empty($id) && $evenement->getDate()->compareDate($date, Zend_Date::DAY . '/' . Zend_Date::MONTH_SHORT . '/' . Zend_Date::YEAR) === 0) {
                        $idNewEvenement = $id;
                    }
                    $newEvenement = new Application_Model_Evenement(array(
                                'id' => $idNewEvenement,
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
                    $evenementMapper->save($newEvenement);
                }
                $this->_helper->flashMessenger("Evènement correctement ajouté");
            } else {
                $this->_helper->flashMessenger("Le nom et les dates de l'évènement doivent être renseignés");
            }
            $this->_redirect('/calendrier/index/');
        }
        
        $typeEventMapper = new Application_Model_Mapper_TypeEvent();
        $this->view->types = $typeEventMapper->fetchAll();
        $lieuMapper = new Application_Model_Mapper_LieuUltimate();
        $this->view->lieux = $lieuMapper->fetchAll();
    }

}

