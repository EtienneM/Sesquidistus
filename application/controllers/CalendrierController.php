<?php

require_once('iCalcreator/iCalcreator.php');

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
	    if (Zend_Auth::getInstance()->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN) {
	        $this->view->headScript()->appendFile('/js/calendrier_admin.js');
	    } else {
	        $this->view->headScript()->appendFile('/js/calendrier.js');
	    }


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
	    // Zend_Debug::dump($event->date->get(Zend_Date::ISO_8601));
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
	    $this->view->headScript()->appendFile('/js/jquery/jquery.validate.min.js')
	            ->appendFile('/js/jquery/jquery.validate.additional-methods.min.js')
	            ->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js')
	            ->appendFile('/js/calendrier_ajout.js');

	    $request = $this->getRequest();
	    $evenementMapper = new Application_Model_Mapper_Evenement();
	    $evenement = new Application_Model_Evenement();
	    $id = $request->getParam('id_event');

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
	        $dates = explode(',', $request->getParam('hdnDates', $request->getParam('txtDates')));
	        if (!empty($nom) && !empty($dates)) {
	            if (!$request->getParam('boolHoraire')) {
	                $minuteDebut = ($request->getParam('debutEventMinute') == 0) ? '00' : $request->getParam('debutEventMinute');
	                $horaireDebut = $request->getParam('debutEventHeure').'h'.$minuteDebut;
	                $minuteFin = ($request->getParam('finEventMinute') == 0) ? '00' : $request->getParam('finEventMinute');
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
	                if (!empty($id) && $evenement->getDate()->compareDate($date, Zend_Date::DAY.'/'.Zend_Date::MONTH_SHORT.'/'.Zend_Date::YEAR) === 0) {
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
	            $this->_helper->flashMessenger('Événement correctement ajouté');
	        } else {
	            $this->_helper->flashMessenger("Le nom et les dates de l’événement doivent être renseignés");
	        }
	        $this->_redirect('/calendrier/index/');
	    }

	    $typeEventMapper = new Application_Model_Mapper_TypeEvent();
	    $this->view->types = $typeEventMapper->fetchAll();
	    $lieuMapper = new Application_Model_Mapper_LieuUltimate();
	    $this->view->lieux = $lieuMapper->fetchAll();
	}

	public function supprimerAction() {
	    if (!is_null($id = $this->getRequest()->getParam('id_event'))) {
	        $eventMapper = new Application_Model_Mapper_Evenement();
	        $evenement = new Application_Model_Evenement();
	        $eventMapper->find($id, $evenement);
	        $eventMapper->delete($evenement);
	        $this->_helper->flashMessenger('Événement supprimé');
	    }
	    $this->_redirect('/calendrier');
	}

	/**
	 * Export events from the month before today to in a year in the iCal format
	 * http://kigkonsult.se/iCalcreator/
	 */
	function icalAction() {
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);

		$tz = 'Europe/Paris';
		$config = array(
				'unique_id' => $_SERVER['HTTP_HOST'],
				'TZID' => $tz,
				'LANGUAGE' => 'fr',
				'filename' => 'calendrier_sesquidistus.ics',
		);
		$v = new vcalendar($config);
		$v->setProperty('METHOD', 'PUBLISH');
		$v->setProperty('CALSCALE', 'GREGORIAN');
		$v->setProperty('X-WR-CALNAME', 'Sesquidistus');
		$v->setProperty('X-WR-CALDESC', 'Entrainements et tournois des Sesquidistus');
		$v->setProperty('X-WR-TIMEZONE', $tz);
		$v->setProperty('X-WR-RELCALID', $config['unique_id']);
		$xprops = array('X-LIC-LOCATION' => $tz);
		iCalUtilityFunctions::createTimezone( $v, $tz, $xprops );

		$eventMapper = new Application_Model_Mapper_Evenement();
		$fromDate = new Zend_Date();
		$events = $eventMapper->findBySeason($fromDate->subMonth(1));
		foreach ($events as $event) {
			$vevent = & $v->newComponent('vevent');
			$startDate = new Zend_Date($event->date);
			$duree = $event->getDuree();
			$endDate = new Zend_Date($startDate);
			$endDate->addDay($duree-1);
			$horaireDebut = $event->getHoraire_debut();
			if (isset($horaireDebut) && !empty($horaireDebut)) {
				$horaireDebut = explode('h', $horaireDebut);
				$start = array(
	    				'year' => $startDate->get(Zend_Date::YEAR), 
	    				'month' => $startDate->get(Zend_Date::MONTH), 
	    				'day' => $startDate->get(Zend_Date::DAY), 
	    				'hour' => $horaireDebut[0], 'min' => $horaireDebut[1], 'sec' => 0);
	    		$vevent->setProperty('DTSTART', $start);
	    		$horaireFin = $event->getHoraire_fin();
	    		$end = array(
	    				'year' => $endDate->get(Zend_Date::YEAR),
	    				'month' => $endDate->get(Zend_Date::MONTH),
	    				'day' => $endDate->get(Zend_Date::DAY)
	    		);
	    		if (isset($horaireFin) && !empty($horaireFin)) {
		    		$horaireFin = explode('h', $horaireFin);
		    		$end = array_merge($end, array('hour' => $horaireFin[0], 'min' => $horaireFin[1], 'sec' => 0));
	    		} else {
	    			$end = array_merge($end, array('hour' => 23, 'min' => 59, 'sec' => 0));
	    		}
	    		$vevent->setProperty('DTEND', $end);
			} else { // For an all day event
				$date = $startDate->get(Zend_Date::YEAR).$startDate->get(Zend_Date::MONTH).$startDate->get(Zend_Date::DAY);
				$vevent->setProperty('DTSTART', $date, array('VALUE' => 'DATE'));
				$endDate->addDay(1); // DTEND seems to be exclusive
				$date = $endDate->get(Zend_Date::YEAR).$endDate->get(Zend_Date::MONTH).$endDate->get(Zend_Date::DAY);
				$vevent->setProperty('DTEND', $date, array('VALUE' => 'DATE'));
			}
			$location = $event->getLieu();
			if (!is_string($location)) {
				$location = $location->getNom();
			}
			$vevent->setProperty('LOCATION', $location);
			$vevent->setProperty('SUMMARY', $event->getTitre());
			$vevent->setProperty('DESCRIPTION', $event->getDescription());
			$vevent->setProperty('STATUS', 'CONFIRMED');
			$vevent->setProperty('UID', $event->getId().'@'.$config['unique_id']);
		}

		$v->returnCalendar(false, true);
	}
}

