<?php

class UltimateController extends My_Controller_Action_CustomContent {

    public function init() {
        parent::init();
        $this->view->headTitle()->append("L'utlimate");
        $this->view->headLink()->appendStylesheet('/css/club/club.css');
    }

    public function indexAction() {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()
                && $auth->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN) {
            $this->view->headScript()->appendFile('/js/category.js')
                    ->appendFile('/js/tinymce/jquery.tinymce.js');
        }
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $ultimateMapper = new Application_Model_UltimateMapper();
        $this->view->sections = $ultimateMapper->fetchAll();
        foreach ($this->view->sections as $section) {
            if ($id == $section->id) {
                $this->view->ultimate = $section;
                break;
            }
        }
    }

    public function modifierAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $ultimateMapper = new Application_Model_UltimateMapper();
        // Enregistrement du nouveau contenu s'il est présent
        if (!is_null($content = $request->getParam('content')) && !is_null($title = $request->getParam('title'))) {
            $ultimate = new Application_Model_Ultimate(array(
                        'id' => $id,
                        'titre' => $title,
                        'contenu' => $content));
            $ultimateMapper->save($ultimate);
            $this->_helper->flashMessenger('Modification du contenu réussi');
        }
        $this->_redirect('/ultimate/index/id/'.$id);
    }
    
    public function ajouterAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $ultimateMapper = new Application_Model_UltimateMapper();
        // Enregistrement du nouveau contenu s'il est présent
        if (!is_null($title = $request->getParam('addTitle'))) {
            $ultimate = new Application_Model_Ultimate(array(
                        'titre' => $title,
                        'contenu' => ''));
            $ultimateMapper->save($ultimate);
            $this->_helper->flashMessenger('Catégorie ajoutée avec succès');
        }
        $this->_redirect('/ultimate/index/id/'.$id);
    }
    
    public function supprimerAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $ultimateMapper = new Application_Model_UltimateMapper();
        if (!is_null($idDelCat = $request->getParam('delCat'))) {
            $ultimateMapper->getDbTable()->delete(array('id = ?' => $idDelCat));
            $this->_helper->flashMessenger('Catégorie supprimée avec succès');
            if ($id == $idDelCat) {
                $id = 1;
            }
        }
        $this->_redirect('/ultimate/index/id/'.$id);
    }

}

