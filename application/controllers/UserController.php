<?php

class UserController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet("/css/membres/login.css");
    }

    public function editprofilAction() {
        $this->view->headLink()->appendStylesheet("/css/membres/profil.css");
        $this->view->headScript()->appendFile('/js/profil.js');
        $profilForm = new Application_Form_Profil($this->getRequest()->getPost());
        $profilForm->removeDecorator('Errors');
        
        // Si le formulaire a été validé par l'utilisateur et qu'il est correct
        if (count($this->getRequest()->getPost()) > 0 && $profilForm->isValid($this->getRequest()->getPost())) {
            $profil = new Application_Model_Profil($profilForm->getValues());
            $user = Zend_Auth::getInstance()->getStorage()->read();
            $profil->id = $user->profil->id;
            $mapper = new Application_Model_ProfilMapper();
            $mapper->save($profil);
            // MàJ des infos de l'utilisateur stockées dans la session
            $userMapper = new Application_Model_UserMapper();
            Zend_Auth::getInstance()->getStorage()->write($userMapper->findByLogin($user->login));
            $this->_helper->FlashMessenger('Modification effetuée');
        } else {
            foreach ($profilForm->getMessages() as $messages) {
                foreach ($messages as $message) {
                    $this->_helper->FlashMessenger($message);
                }
            }
        }
        $user = Zend_Auth::getInstance()->getIdentity();
        $profilForm->setDefault('login', $user->login);
        $profilForm->setDefault('prenom', $user->profil->prenom);
        $profilForm->setDefault('mail', $user->profil->mail);
        $profilForm->setDefault('adhesion', $user->profil->adhesion->get('Y'));
        $profilForm->setDefault('adhesion', $user->profil->numero);
        $this->view->profilForm = $profilForm;
    }

}

