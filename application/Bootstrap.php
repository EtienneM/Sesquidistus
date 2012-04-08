<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('Sesquidistus')->setSeparator(' - ');
    }

    protected function _initScripts() {
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->headScript()
                ->appendFile('/js/jquery/jquery.min.js')
                ->appendFile('/js/fix_ie/iepngfix_tilebg.js')
                ->appendFile('/js/jquery/jquery-ui.min.js')
                ->appendFile('/js/galerie.js')
                ->appendFile('/js/jquery/jquery.dropmenu.js')
                ->appendFile('/js/jquery/jquery.ba-resize.min.js')
                ->appendFile('/js/jquery/hoverIE.js', 'text/javascript', array('conditional'=>'IE'));
    }

    protected function _initLink() {
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->headLink()
                ->headLink(array(
                    'rel' => 'favicon',
                    'href' => '/images/favicon.ico',
                    'type' => 'image/x-icon',
                ), 'PREPEND')
                ->appendStylesheet('/css/style.css')
                ->appendStylesheet('/css/dropmenu_apple.css')
                ->appendStylesheet('/css/dialog.css')
                ->appendStylesheet('/css/accordion.css')
                ->appendStylesheet('/css/accordionIE.css', 'screen', 'IE 6');
    }

    protected function _initMenu() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->menu = array(
            'index' => 1,
            'calendrier' => 2,
            'club' => 3,
            'ultimate' => 4,
            'galerie' => 5,
            'evenement' => 6,
            'contact' => 8,
        );
    }

    protected function _initFooter() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        
        $view->fromYear = 2010;
        $view->nowYear = (int)date("Y");
    }
}

