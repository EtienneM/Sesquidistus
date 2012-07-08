<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        $this->view->headLink()->appendStylesheet('/css/pagination.css')
                ->appendStylesheet('/css/article.css');
        $this->view->headScript()->appendFile('/js/index_admin.js');
        $article = new Application_Model_ArticleMapper();
        $idEvent = $this->getRequest()->getParam('id_event');
        $page = $this->getRequest()->getParam('page', 1);
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('index/_controls.phtml');
        Zend_Paginator::setDefaultScrollingStyle('Sliding');
        $articles = $article->findByEvent($idEvent, $page, $paginator);
        $this->view->articles = $articles;
        $this->view->paginator = $paginator;

        $evenementMapper = new Application_Model_EvenementMapper();
        $this->view->nextTraining = $evenementMapper->findNext(1);
        $this->view->nextTournoi = $evenementMapper->findNext(array(4, 5));
        $this->view->video = array();
    }

    public function contactAction() {
        $this->view->headTitle()->append('Contact');
        $this->view->headScript()->appendFile('/js/jquery/jquery.validate.min.js')
                ->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js')
                ->appendFile('/js/contact.js');
        $this->view->headLink()->appendStylesheet('/css/contact.css');
        $contactMapper = new Application_Model_ContactMapper();
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
                //$this->getRequest()->clearParams();
                $this->_helper->flashMessenger('Modification du contact réussi');
                $this->_redirect('/index/contact');
            } else {
                //TODO Message erreur
            }
        }
    }

    public function aproposAction() {
        
    }

    public function mentionsAction() {
        
    }

}

