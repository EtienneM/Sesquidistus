<?php

class AutreController extends Zend_Controller_Action {
	public function contactAction() {
		$this->view->headTitle()->append('Contact');
		$this->view->headScript()->appendFile('/js/jquery/jquery.validate.min.js')
								->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js')
								->appendFile('/js/contact.js');
		$this->view->headLink()->appendStylesheet('/css/contact.css');
		$contactMapper = new Application_Model_Mapper_Contact();
		$contacts = $contactMapper->fetchAll();
		$this->view->contact = $contacts[0];
		$request = $this->getRequest();
		$modifier = $request->getParam('modifier', false);
		$this->view->modifier = $modifier;
		$auth = Zend_Auth::getInstance();
		if ($modifier && $auth->hasIdentity()
				&& $auth->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN) {
	
			if (!is_null($firstName = $request->getParam('firstName')) && !is_null($email = $request->getParam('email'))) {
				$contact = new Application_Model_Contact(array(
						'id' => 1,
						'prenom' => $firstName,
						'nom' => $request->getParam('lastName'),
						'telephone' => $request->getParam('phone'),
						'email' => $email,
				));
				$contactMapper->save($contact);
				$this->_helper->flashMessenger('Modification du contact réussi');
				$this->_redirect('/autre/contact');
			} else {
				//TODO Message erreur
			}
		}
	}
	
	public function changelangAction() {
		$this->_helper->viewRenderer->setNoRender();
		$lang = $this->getRequest()->getParam('lang', 'fr');
		$translate = new Zend_Session_Namespace('translate');
		if (!$translate->Zend_Translate->isAvailable($lang)) {
			// not available languages are rerouted to another language
			$lang = 'fr';
		}
		$translate->Zend_Translate->setLocale($lang);
		$this->redirect('/');
	}
	
	public function aproposAction() {
	
	}
	
	public function mentionsAction() {
	
	}
}
