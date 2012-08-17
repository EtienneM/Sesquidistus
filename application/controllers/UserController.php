<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->append('Page membres');
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
                $mapper = new Application_Model_Mapper_Profil();
                $mapper->save($profil);
                // MàJ des infos de l'utilisateur stockées dans la session
                $userMapper = new Application_Model_Mapper_User();
                Zend_Auth::getInstance()->getStorage()->write($userMapper->findByLogin($user->login));
                $this->_helper->FlashMessenger('Modification effetuée');
            }
            $this->view->profilForm = $profilForm;
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

    public function editavatarAction() {
        $this->_helper->viewRenderer->setNoRender();
        $storage = Zend_Auth::getInstance()->getStorage();
        $user = $storage->read();
        $avatar = $user->profil->avatar;
        if (empty($avatar)) {
            $profilMapper = new Application_Model_Mapper_Profil();
            $filterAccent = new My_Filter_Accent();
            $user->profil->avatar = $filterAccent->filter($user->login).'.jpg';
            $storage->write($user);
            $profilMapper->save($user->profil);
        }
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $adapter->addValidator(new Zend_Validate_File_Count(1))
                ->addValidator(new Zend_Validate_File_Size(array('min' => 0, 'max' => 5242880)))// Max size = 5 Mo
                ->addValidator(new Zend_Validate_File_IsImage('image/jpeg'));
        $adapter->addFilter(new Zend_Filter_File_Rename(array(
                    'target' => APPLICATION_PATH . '/../public/' . Application_Model_Profil::_getAvatarPath() . $user->profil->avatar,
                    'overwrite' => true,
                )));
        $adapter->receive('avatarUpload');
        /*
         * Create thumbnail
         */
        
        
        //$this->_forward('bandeau', 'galerie', null, array('imgToCrop' => $filename, 'errorMessages' => $adapter->getMessages()));
        $this->getResponse()->setRedirect('editProfil');
    }

    public function editpwdAction() {
        $form = new Application_Form_Password($this->getRequest()->getPost());
        if ($form->isValid($this->getRequest()->getPost())) {
            $user = Zend_Auth::getInstance()->getIdentity();
            $values = $form->getValues();
            $user->setPasswd(Application_Model_User::hashPasswd($values['new_pwd']));
            $userMapper = new Application_Model_Mapper_User();
            $userMapper->save($user);
        }
        $this->getResponse()->setRedirect('editProfil');
    }

    public function listAction() {
        $this->view->headLink()->appendStylesheet('/css/membres/trombi.css');
        $profilMapper = new Application_Model_Mapper_Profil();
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
        $userMapper = new Application_Model_Mapper_User();
        $user = new Application_Model_User();
        $userMapper->find($this->getRequest()->getParam('user'), $user);
        if (is_null($user->id)) {
            throw new Zend_Controller_Action_Exception("L'utilisateur donné en 
                paramètre n'existe pas dans la base de données", 404);
        }
        $this->view->member = $user;
    }

}

