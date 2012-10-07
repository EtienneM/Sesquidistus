<?php

/**
 * Génération du sitemap pour les moteurs de recherche
 *
 * @author emichon
 */
class SitemapController extends Zend_Controller_Action {

    public function preDispatch() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction() {
        $this->getResponse()->setHeader('content-type', 'application/xml', true);
        $config = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml', 'nav');
        $navigation = new Zend_Navigation($config);
        $sitemapHelper = new Zend_View_Helper_Navigation_Sitemap();
        $sitemapHelper->setView($this->view);
        $sitemapHelper->sitemap($navigation);
        echo $sitemapHelper->render();
    }

}
