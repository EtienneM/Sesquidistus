<?php

class ArticleController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->append('Articles');
    }

    public function indexAction() {
        return $this->_redirect('/');
    }

    public function ecrireAction() {
        $this->view->headScript()->appendFile('/js/tinymce/jquery.tinymce.js')
                ->appendFile('/js/jquery/jquery-ui.min.js')
                ->appendFile('/js/jquery/jquery.validate.min.js')
                ->appendFile('/js/jquery/jquery.validate.localization/messages_fr.js')
                ->appendFile('/js/article.js');
        $this->view->headLink()->appendStylesheet('/css/article.css');

        $articleMapper = new Application_Model_ArticleMapper();
        $article = new Application_Model_Article();
        $request = $this->getRequest();
        $titre = $request->getParam('titre');
        $id = $request->getParam('id');
        
        // Modifier un article
        if (!empty($id)) {
            $articleMapper->find($id, $article);
        }
        
        if (!empty($titre)) {
            $article->setOptions(array(
                        'titre' => $titre,
                        'contenu' => $request->getParam('contenu'),
                        'id_event' => $request->getParam('idEvent'),
                        'date' => new Zend_Date(),
                        'id_member' => Zend_Auth::getInstance()->getIdentity()->id,
                    ));
            $articleMapper->save($article);
            $this->_helper->flashMessenger('Article ajouté avec succès');
            return $this->_helper->redirector('index');
        }
        
        $this->view->article = $article;
    }
    
    public function supprimerAction() {
        $request = $this->getRequest();
        $articleMapper = new Application_Model_ArticleMapper();
        if (!is_null($id = $request->getParam('id'))) {
            $articleMapper->getDbTable()->delete(array('id = ?' => $id));
            $this->_helper->flashMessenger('Article supprimé avec succès');
        }
        $this->getResponse()->setRedirect('/');
    }

}

