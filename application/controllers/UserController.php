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
        $this->view->headScript()->appendFile('/js/profil.js')
                ->appendFile('/js/jquery/jquery.validate.min.js')
                ->appendFile('/js/jquery/jquery.validate.additional-methods.min.js')
                ->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js');

        $id = $this->getRequest()->getParam('id');
        if (Zend_Auth::getInstance()->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN && !empty($id)) {
            $userMapper = new Application_Model_Mapper_User();
            $user = new Application_Model_User();
            $userMapper->find($id, $user);
        } else {
            $user = Zend_Auth::getInstance()->getIdentity();
        }

        $profilForm = new Application_Form_Profil($this->getRequest()->getPost());
        // Si le formulaire a été validé par l'utilisateur...
        if (count($this->getRequest()->getPost()) > 0) {
            // ...  et qu'il est correct
            if ($profilForm->isValid($this->getRequest()->getPost())) {
                $values = $profilForm->getValues();
                $values['adhesion'] = new Zend_Date($values['adhesion'], Zend_Date::YEAR);
                $profilMapper = new Application_Model_Mapper_Profil();
                $profil = new Application_Model_Profil();
                $profilMapper->find($user->profil->id, $profil);
                $profil->setOptions($values);
                $profilMapper->save($profil);
                $user->setOptions($values);
                $user->getProfil()->setOptions($values);
                // MàJ des infos de l'utilisateur stockées dans la session si la 
                // modification concerne l'utilisateur actuellement connecté
                if (Zend_Auth::getInstance()->getIdentity()->getRoleId() != Application_Model_Acl::ROLE_ADMIN || empty($id)) {
                    $userMapper = new Application_Model_Mapper_User();
                    Zend_Auth::getInstance()->getStorage()->write($userMapper->findByLogin($user->login));
                }
                $this->view->flashMessages = array_merge(array('Modification effetuée'), $this->view->flashMessages);
            }
            $this->view->profilForm = $profilForm;
        }

        $this->view->userModif = $user;
        $profilForm->setDefault('login', $user->login);
        $profilForm->setDefault('prenom', $user->profil->prenom);
        $profilForm->setDefault('mail', $user->profil->mail);
        $profilForm->setDefault('adhesion', (!empty($user->profil->adhesion)) ? $user->profil->adhesion->get('YYYY') : '');
        $profilForm->setDefault('numero', $user->profil->numero);
        $this->view->profilForm = $profilForm;

        $this->view->pwdForm = new Application_Form_Password();
    }

    public function editavatarAction() {
        $this->_helper->viewRenderer->setNoRender();
        $id = $this->getRequest()->getParam('id');
        if (Zend_Auth::getInstance()->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN && !empty($id)) {
            $userMapper = new Application_Model_Mapper_User();
            $user = new Application_Model_User();
            $userMapper->find($id, $user);
        } else {
            $user = Zend_Auth::getInstance()->getIdentity();
        }
        $avatar = $user->profil->avatar;
        if (empty($avatar)) {
            $profilMapper = new Application_Model_Mapper_Profil();
            $filterAccent = new My_Filter_Accent();
            $user->profil->avatar = $filterAccent->filter($user->login).'.jpg';
            if (Zend_Auth::getInstance()->getIdentity()->getRoleId() != Application_Model_Acl::ROLE_ADMIN || empty($id)) {
                Zend_Auth::getInstance()->getStorage()->write($user);
            }
            $profilMapper->save($user->profil);
        }
        $adapter = new Zend_File_Transfer_Adapter_Http();
        $adapter->addValidator(new Zend_Validate_File_Count(1))
                ->addValidator(new Zend_Validate_File_Size(array('min' => 0, 'max' => 5242880)))// Max size = 5 Mo
                ->addValidator(new Zend_Validate_File_IsImage('image/jpeg'));
        $avatarDirectory = APPLICATION_PATH.'/../public/'.Application_Model_Profil::_getAvatarPath();
        $adapter->addFilter(new Zend_Filter_File_Rename(array(
                    'target' => $avatarDirectory.'/'.$user->profil->avatar,
                    'overwrite' => true,
                )));
        if (!is_dir($avatarDirectory)) {
            mkdir($avatarDirectory);
        }
        $adapter->receive('avatarUpload');
        /*
         * Shorten the original image
         */
        $shortenImage = new My_Controller_Action_CreateThumbnail($avatarDirectory.'/'.$user->profil->avatar,
                        $avatarDirectory, 120, 140);
        $shortenImage->create();
        /*
         * Create mini thumbnail
         */
        $createThumbnail = new My_Controller_Action_CreateThumbnail($avatarDirectory.'/'.$user->profil->avatar,
                        APPLICATION_PATH.'/../public/'.Application_Model_Profil::_getAvatarMiniPath(), 25, 25);
        $createThumbnail->create();

        $this->_helper->flashMessenger('Photo de profil ajouté');
        if (!empty($id)) {
            $param = "/id/$id";
        } else {
            $param = '';
        }
        $this->_redirect('/user/editProfil'.$param);
    }

    public function editpwdAction() {
        $form = new Application_Form_Password($this->getRequest()->getPost());
        $id = $this->getRequest()->getParam('id');
        if ($form->isValid($this->getRequest()->getPost())) {
            if (Zend_Auth::getInstance()->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN && !empty($id)) {
                $userMapper = new Application_Model_Mapper_User();
                $user = new Application_Model_User();
                $userMapper->find($id, $user);
            } else {
                $user = Zend_Auth::getInstance()->getIdentity();
            }
            $values = $form->getValues();
            $user->setPasswd(Application_Model_User::hashPasswd($values['new_pwd']));
            $userMapper = new Application_Model_Mapper_User();
            $userMapper->save($user);
            $this->_helper->flashMessenger('Mot de passe modifié');
        }
        if (!empty($id)) {
            $param = "/id/$id";
        } else {
            $param = '';
        }
        $this->_redirect('/user/editProfil'.$param);
    }

    public function listAction() {
        $this->view->headLink()->appendStylesheet('/css/membres/trombi.css');
        $profilMapper = new Application_Model_Mapper_Profil();
        $everybody = array();
        $profils = $profilMapper->findAncien(false);
        if (count($profils) > 0) {
            $everybody["Sesquis d'aujourd'hui"] = array();
        }
        foreach ($profils as $profil) {
            $everybody["Sesquis d'aujourd'hui"][] = $profil;
        }
        $profils = $profilMapper->findAncien();
        if (count($profils) > 0) {
            $everybody["Sesquis d'hier"] = array();
        }
        foreach ($profils as $profil) {
            $everybody["Sesquis d'hier"][] = $profil;
        }
        $this->view->everybody = $everybody;
    }

    public function viewAction() {
        $this->view->headLink()->appendStylesheet('/css/membres/profil.css');
        $this->view->headScript()->appendFile('/js/profil.js')
                ->appendFile('/js/jquery/jquery.validate.min.js')
                ->appendFile('/js/jquery/jquery.validate.additional-methods.min.js')
                ->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js');
        $userMapper = new Application_Model_Mapper_User();
        $user = new Application_Model_User();
        $userMapper->find($this->getRequest()->getParam('id'), $user);
        if (is_null($user->id)) {
            throw new Zend_Controller_Action_Exception("L'utilisateur donné en 
                paramètre n'existe pas dans la base de données", 404);
        }
        $this->view->member = $user;
    }

    public function createAction() {
        $this->view->headLink()->appendStylesheet('/css/membres/profil.css');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.additional-methods.min.js');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js');
        $this->view->headScript()->appendFile('/js/user-create.js');

        // Si le formulaire a été validé par l'utilisateur...
        $request = $this->getRequest();
        if (count($request->getPost()) > 0) {
            $mapperUser = new Application_Model_Mapper_User();
            $mapperProfil = new Application_Model_Mapper_Profil();
            $user = new Application_Model_User(array(
                        'login' => $request->getParam('login'),
                        'passwd' => Application_Model_User::hashPasswd($request->getParam('passwd')),
                        'admin' => 0,
                    ));
            $mapperUser->save($user);
            $profil = new Application_Model_Profil(array(
                        'id_membre' => $user->getId(),
                        'prenom' => $request->getParam('prenom'),
                        'numero' => ($request->getParam('numero') === '') ? null : $request->getParam('numero'),
                        'mail' => $request->getParam('mail'),
                    ));
            $adhesion = $request->getParam('adhesion');
            if (!empty($adhesion)) {
                $profil->setAdhesion(new Zend_Date($adhesion, Zend_Date::YEAR));
            }
            $mapperProfil->save($profil);
            $this->_helper->flashMessenger('Compte créé avec succès');
            $this->_redirect('/auth/login');
        }
    }

    public function supprimerAction() {
        $request = $this->getRequest();
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        if (!$request->isXmlHttpRequest()) {
            return;
        }
        if (!is_null($id = $request->getParam('id'))) {
            $userMapper = new Application_Model_Mapper_User();
            $user = new Application_Model_User();
            $userMapper->find($id, $user);
            $userMapper->delete($user);
            $this->_helper->flashMessenger('Membre supprimé avec succès');
        }
    }

    public function checkloginAction() {
        $request = $this->getRequest();
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        if (!$request->isXmlHttpRequest()) {
            return;
        }
        $this->getResponse()->setHeader('content-type', 'application/json', true);
        $login = $request->getParam('login');
        if (empty($login)) {
            echo Zend_Json::encode(array(false));
        }
        $userMapper = new Application_Model_Mapper_User();
        if (is_null($userMapper->findByLogin($login))) {
            $results = true;
        } else {
            $results = 'Cet identifiant existe déjà. En choisir un autre.';
        }
        echo Zend_Json::encode($results);
    }

}

