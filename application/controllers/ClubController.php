<?php

class ClubController extends My_Controller_Action_CustomContent {

    public function init() {
        parent::init();
        $this->view->headLink()->appendStylesheet('/css/club/club.css');
        $this->view->headTitle()->append('Le club');
    }

    public function indexAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        if (!isset($id)) {
            $id = 1;
        }
        $clubMapper = new Application_Model_ClubMapper();
        $this->view->sections = $clubMapper->fetchAll();
        // Recherche de la section courante
        foreach ($this->view->sections as $section) {
            if ($id == $section->id) {
                $this->view->club = $section;
                break;
            }
        }
        
        if ($id == 3) {
            $this->view->headLink()->appendStylesheet('/css/membres/trombi.css');
            $profilMapper = new Application_Model_ProfilMapper();
            $everybody = array();
            $profils = $profilMapper->findAncien(false);
            if (count($profils) > 0) {
                $everybody["Sesqui d'aujourd'hui"] = array();
            }
            foreach ($profils as $profil) {
                $everybody["Sesqui d'aujourd'hui"][] = $profil;
            }
            $profils = $profilMapper->findAncien();
            if (count($profils) > 0) {
                $everybody["Sesqui d'hier"] = array();
            }
            foreach ($profils as $profil) {
                $everybody["Sesqui d'hier"][] = $profil;
            }
            $this->view->everybody = $everybody;
        } else if ($id == 5) {
            $this->view->headScript()
                    ->appendFile('http://maps.google.com/maps/api/js?sensor=false')
                    ->appendFile('/js/jquery/gmap3.min.js');
            $lieuxMapper = new Application_Model_LieuUltimateMapper();
            $this->view->lieux = $lieuxMapper->fetchAll();
        }
    }

}

