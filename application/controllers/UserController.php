<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet('/css/membres/login.css');
    }

    public function editprofilAction() {
        $this->view->headLink()->appendStylesheet('/css/membres/profil.css');
        $this->view->headScript()->appendFile('/js/profil.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.additional-methods.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js');
        $profilForm = new Application_Form_Profil($this->getRequest()->getPost());

        // Si le formulaire a été validé par l'utilisateur...
        if (count($this->getRequest()->getPost()) > 0) {
            // ...  et qu'il est correct
            if ($profilForm->isValid($this->getRequest()->getPost())) {
                $values = $profilForm->getValues();
                $values['adhesion'] = new Zend_Date($values['adhesion'], Zend_Date::YEAR);
                $profil = new Application_Model_Profil($values);
                $user = Zend_Auth::getInstance()->getIdentity();
                $profil->id = $user->profil->id;
                $mapper = new Application_Model_ProfilMapper();
                $mapper->save($profil);
                // MàJ des infos de l'utilisateur stockées dans la session
                $userMapper = new Application_Model_UserMapper();
                Zend_Auth::getInstance()->getStorage()->write($userMapper->findByLogin($user->login));
                $this->_helper->FlashMessenger('Modification effetuée');
            }
            $this->view->profilForm = $profilForm;
            return;
        }
        $user = Zend_Auth::getInstance()->getIdentity();
        $profilForm->setDefault('login', $user->login);
        $profilForm->setDefault('prenom', $user->profil->prenom);
        $profilForm->setDefault('mail', $user->profil->mail);
        $profilForm->setDefault('adhesion', $user->profil->adhesion->get('YYYY'));
        $profilForm->setDefault('numero', $user->profil->numero);
        $this->view->profilForm = $profilForm;

        $this->view->pwdForm = new Application_Form_Password();
    }

    public function editpwdAction() {
        $form = new Application_Form_Password($this->getRequest()->getPost());
        if ($form->isValid($this->getRequest()->getPost())) {
            Zend_Debug::dump('valide');
            $user = Zend_Auth::getInstance()->getIdentity();
            $values = $form->getValues();
            $user->setPasswd(Application_Model_User::hashPasswd($values['new_pwd']));
            Zend_Debug::dump($user);
            $userMapper = new Application_Model_UserMapper();
            $userMapper->save($user);
        }
        $this->getResponse()->setRedirect('editProfil');
    }

    public function listAction() {
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
    }
    
    public function viewAction() {
        $this->view->headLink()->appendStylesheet('/css/membres/profil.css');
        $userMapper = new Application_Model_UserMapper();
        $user = new Application_Model_User();
        $userMapper->find($this->getRequest()->getParam('user'), $user);
        if (is_null($user->id)) {
            throw new Zend_Controller_Action_Exception("L'utilisateur donné en 
                paramètre n'existe pas dans la base de données", 404);
        }
        $this->view->member = $user;
    }

}

