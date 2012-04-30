<?php

class ClubController extends My_Controller_Action_CustomContent {

    public function init() {
        parent::init();
        $this->view->headLink()->appendStylesheet('/css/club/club.css');
        $this->view->headTitle()->append('Le club');
    }

    public function indexAction() {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()
                && $auth->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN) {
            $this->view->headScript()->appendFile('/js/club.js')
                    ->appendFile('/js/tinymce/jquery.tinymce.js');
        }
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
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

    public function modifierAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $clubMapper = new Application_Model_ClubMapper();
        // Enregistrement du nouveau contenu s'il est présent
        if (!is_null($content = $request->getParam('content')) && !is_null($title = $request->getParam('title'))) {
            $club = new Application_Model_Club(array(
                        'id' => $id,
                        'titre' => $title,
                        'contenu' => $content));
            $clubMapper->save($club);
            $this->_helper->flashMessenger('Modification du contenu réussi');
        }
        $this->_redirect('/club/index/id/'.$id);
    }

    public function ajouterAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $clubMapper = new Application_Model_ClubMapper();
        // Enregistrement du nouveau contenu s'il est présent
        if (!is_null($title = $request->getParam('addTitle'))) {
            $club = new Application_Model_Club(array(
                        'titre' => $title,
                        'contenu' => ''));
            $clubMapper->save($club);
            $this->_helper->flashMessenger('Catégorie ajoutée avec succès');
        }
        $this->_redirect('/club/index/id/'.$id);
    }

    public function supprimerAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $clubMapper = new Application_Model_ClubMapper();
        if (!is_null($idDelCat = $request->getParam('delCat'))) {
            $clubMapper->getDbTable()->delete(array('id = ?' => $idDelCat));
            $this->_helper->flashMessenger('Catégorie supprimée avec succès');
            if ($id == $idDelCat) {
                $id = 1;
            }
        }
        $this->_redirect('/club/index/id/'.$id);
    }

}

