<?php

/**
 * Génération des flux de syndication
 *
 * @author emichon
 */
class FeedsController extends Zend_Controller_Action {

    public function preDispatch() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction() {
        $contactMapper = new Application_Model_Mapper_Contact();
        $contacts = $contactMapper->fetchAll();
        $feedArray = array(
            'title' => 'Sesquidistus',
            'link' => 'http://'.$_SERVER['HTTP_HOST'].'/feeds/',
            'charset' => 'utf-8',
            'description' => 'Flux de syndication pour les nouvelles du site Web des Sesquidistus',
            'author' => 'Sesquidistus',
            'email' => $contacts[0]->email,
            'webmaster' => $contacts[0]->email,
            'copyright' => 'Copyright © 2010 - '.date('Y').'Sesquidistus',
            'image' => '/images/minilogo.png',
            'generator' => 'Zend Framework Zend_Feed',
            'language' => 'fr',
            'entries' => array(),
        );
        $articleMapper = new Application_Model_Mapper_Article();
        foreach ($articleMapper->fetchAll(30) as $article) {
            $description = $article->contenu;
            if (strlen($article->contenu) > 150) {
                $description = substr($article->contenu, 0, 150).'...';
            }
            $feedArray['entries'][] = array(
                'title' => $article->titre,
                'link' => $this->_helper->url('index', 'index', null, array('id_article' => $article->id)),
                'description' => utf8_encode($article->contenu),
                'guid' => $article->id,
                'content' => utf8_encode($article->contenu),
                'lastUpdate' => $article->date->getTimestamp(),
            );
        }
        if (count($feedArray['entries']) > 0) {
            $feedArray['lastUpdate'] = $feedArray['entries'][0]['lastUpdate'];
            $feedArray['published'] = $feedArray['entries'][0]['lastUpdate'];
        }

        $feed = Zend_Feed::importArray($feedArray, 'rss');
        $this->getResponse()->setHeader('content-type', 'application/rss+xml', true);
        $feed->send();
    }

}
