<?php

class AuthController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->append('Connexion');
        $this->view->headLink()->appendStylesheet("/css/membres/login.css");
    }

    public function indexAction() {
        return $this->_redirect('/auth/login');
    }

    public function loginAction() {
        $db = $this->_getParam('db');
//         $this->view->headScript()->appendFile('/js/jquery/jquery.browserid-min.js');
//         $this->view->headScript()->appendFile('/js/persona.js');
//         $this->view->headLink()->appendStylesheet('/css/persona-buttons.css');
        
        $loginForm = new Application_Form_Auth_Login($this->getRequest()->getPost());
        if ($loginForm->isValid($this->getRequest()->getPost())) {
            $adapter = new Zend_Auth_Adapter_DbTable(
                            $db,
                            'membre',
                            'login',
                            'passwd'
            );

            $adapter->setIdentity($loginForm->getValue('login'))
                    ->setCredential(Application_Model_User::hashPasswd($loginForm->getValue('passwd')));
            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);
            if ($result->isValid()) {
                $userMapper = new Application_Model_Mapper_User();
                $user = $userMapper->findByLogin($result->getIdentity());
                $auth->getStorage()->write($user);
                $this->_redirect('/');
            } else {
                $loginForm->setErrorMessages(array('Identifiant/mot de passe non reconnu'));
            }
        }
        $this->view->loginForm = $loginForm;
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');
    }

    public function personaAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $this->getResponse()->setHeader('content-type', 'application/json', true);
        $assertion = $this->getRequest()->getParam('assertion');
        
        $res = '';
        if (null !== $assertion) {
        	$browserID = new My_Helper_BrowserID($assertion);
        	$res = $browserID->verifyAssertion();
        	$verification = Zend_Json::decode($res, Zend_Json::TYPE_OBJECT);
        	if ($verification->status === 'okay') {
        		$userMapper = new Application_Model_Mapper_User();
        		$user = $userMapper->findByEmail($verification->email);
        		if ($user === null) {
        			$res = Zend_Json::encode(array('status'=>'failure', 'reason'=>'L\'email que vous avez envoyé ne correspond à aucun utilisateur'));
        		} else {
        			Zend_Auth::getInstance()->getStorage()->write($user);
        		}
        	}
        } else {
        	$res = Zend_Json::encode(array('status'=>'failure', 'reason'=>'Appelez cette page à travers un bouton Persona'));
        }
		echo $res;
    }

}

