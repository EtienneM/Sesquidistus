<?php

class CalendrierController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet('/css/calendrier/calendrier_consultation.css');
        $this->view->headScript()
                        ->appendFile('/js/calendrier_global.js')
                        ->appendFile('/js/calendrier_consultation.js');
        $this->view->evenements = array(
            array (
                'jour' => 'Dimanche',
                'date' => '05/04/2012',
                'Nom' => 'nom_event',
                'Type' => 'type_event',
                'Lieu' => 'lieu_event',
                'Début' => '18h30',
                'Fin' => '20h30',
                'Commentaire' => 'commentaire;..',
            ),
        );
        $mois = $this->getRequest()->getParam('mois');
        $annee = $this->getRequest()->getParam('annee');
        if (!isset($mois) || !isset($annee)) {
            $this->view->displayedMonth = new Zend_Date(null, Zend_Date::MONTH.'/'.Zend_Date::YEAR);
        } else {
            $this->view->displayedMonth = new Zend_Date($mois.'/'.$annee, Zend_Date::MONTH.'/'.Zend_Date::YEAR);
        }
    }

    public function ajoutAction() {
        $this->view->headLink()->appendStylesheet('/css/calendrier/calendrier_ajout.css');
    }
}

