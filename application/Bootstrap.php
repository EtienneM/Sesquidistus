<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initMeta() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_RDFA');
        $view->headMeta()
                ->appendName('keywords', 'Ultimate, Frisbee, Strasbourg, SUC, Sesquidistus')
                ->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
                ->appendHttpEquiv('Content-Language', 'fr-FR')
                ->appendProperty('og:title', 'Sesquidistus')
                ->appendProperty('og:type', 'sport')
                ->appendProperty('og:image', '/images/minilogo.png')
                ->appendProperty('og:url', 'http://www.frisbee-strasbourg.net')
                ->appendProperty('og:locale', 'fr_FR')
        //->appendProperty('fb:admins', '1018024861')
        ;
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
                ->appendFile('/js/jquery/hoverIE.js', 'text/javascript', array('conditional' => 'IE'));
    }

    protected function _initLink() {
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->headLink()
                ->headLink(array(
                    'rel' => 'shortcut icon',
                    'href' => '/images/favicon.ico',
                    'type' => 'image/x-icon',
                        ), 'PREPEND')
                ->appendStylesheet('/css/style.css')
                ->appendStylesheet('/css/dropmenu_apple.css')
                ->appendStylesheet('/css/dialog.css')
                ->appendStylesheet('/css/accordion.css')
                ->appendStylesheet('/css/accordionIE.css', 'screen', 'IE 6');
    }

    protected function _initNavigation() {
        $this->bootstrap("layout");
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $config = new Zend_Config_Xml(APPLICATION_PATH.'/configs/navigation.xml', 'nav');
        $navigation = new Zend_Navigation($config);
        $view->navigation($navigation);
    }

    protected function _initFooter() {
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->fromYear = 2010;
        $view->nowYear = (int) date("Y");
    }

    protected function _initAcl() {
        $acl = Application_Model_Acl::getInstance();
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl($acl);
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole(self::getCurrentUser()->getRoleId());
        Zend_Registry::set('Zend_Acl', $acl);
        return $acl;
    }

    protected function _initUser() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->user = null;
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $view->user = $auth->getIdentity();
            $userMapper = new Application_Model_UserMapper();
            //$user=$userMapper->findByLogin($auth->getIdentity());
            $view->avatar = '';// $user->profil->avatar_min;
            //self::setCurrentUser($user);
        }
        return self::getCurrentUser();
    }

    protected static $_currentUser;

    public static function setCurrentUser(Application_Model_User $user) {
        self::$_currentUser = $user;
    }

    /**
     * @return App_Model_User
     */
    public static function getCurrentUser() {
        if (null === self::$_currentUser) {
            self::setCurrentUser(new Application_Model_User());
        }
        return self::$_currentUser;
    }

    /**
     * @return App_Model_User
     */
    public static function getCurrentUserId() {
        return self::getCurrentUser()->getId();
    }

}

