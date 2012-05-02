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

        $request = $this->getRequest();
        $titre = $request->getParam('titre');
        if (!empty($titre)) {
            $articleMapper = new Application_Model_ArticleMapper();
            $article = new Application_Model_Article(array(
                        'titre' => $titre,
                        'contenu' => $request->getParam('contenu'),
                        'id_event' => $request->getParam('idEvent'),
                        'date_article' => new Zend_Date(),
                        'id_member' => Zend_Auth::getInstance()->getIdentity()->id,
                    ));
            //Zend_Debug::dump($article);
            $articleMapper->save($article);
            $this->_helper->flashMessenger('Article ajouté avec succès');
        }
    }

}

