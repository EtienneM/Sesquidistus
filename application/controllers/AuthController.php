<?php

class AuthController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->append('Connexion');
        $this->view->headLink()->appendStylesheet("/css/membres/login.css");
    }

    public function indexAction() {
        return $this->_forward('login');
    }

    public function loginAction() {
        $db = $this->_getParam('db');
        $loginForm = new Application_Form_Auth_Login($this->getRequest()->getPost());
        if ($loginForm->isValid($this->getRequest()->getPost())) {
            $adapter = new Zend_Auth_Adapter_DbTable(
                            $db,
                            'membre',
                            'login',
                            'passwd'
                    //'MD5(CONCAT(?, password_salt))'
            );

            $adapter->setIdentity($loginForm->getValue('login'));
            $adapter->setCredential(Application_Model_User::hashPasswd($loginForm->getValue('passwd')));
            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);
            if ($result->isValid()) {
                $userMapper = new Application_Model_Mapper_User();
                $user = $userMapper->findByLogin($result->getIdentity());
                $auth->getStorage()->write($user);
                $this->getResponse()->setRedirect('/');
                return;
            } else {
                $loginForm->setErrorMessages(array('Identifiant/mot de passe non reconnu'));
            }
        }
        $this->view->loginForm = $loginForm;
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/');
    }

}

