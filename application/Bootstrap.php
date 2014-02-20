<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initHelper() {
        Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH . '/controllers/helpers/My/Helper/', 'My_Helper');
    }

    /**
     * Initialize a cache for the Zend_Locale class called by Zend_Date.
     * This is mandatory for the OVH website 
     */
    protected function _initCache() {
        $cacheDir = APPLICATION_PATH . '/../data/cache/';
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir);
        }
        $aFrontendConf = array(
            'lifetime' => 345600, // 3 jours
            'automatic_serialization' => true,
        );
        $aBackendConf = array('cache_dir' => $cacheDir);
        $oCache = Zend_Cache::factory('Core', 'File', $aFrontendConf, $aBackendConf);
        $oCache->setOption('automatic_serialization', true);
        Zend_Locale::setCache($oCache);
        Zend_Date::setOptions(array('cache' => $oCache));
//         Zend_Translate::setCache($oCache);
    }

    protected function _initMeta() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype(Zend_View_Helper_Doctype::HTML5);
        $view->headMeta()
                ->appendName('keywords', 'Ultimate, Frisbee, Strasbourg, SUC, Sesquidistus')
                ->appendName('description', 'Informations sur les entraînements et les tournois du club d\'Ultimate frisbee de Strasbourg : Les Sesquidistus')
                ->appendName('robots', 'index,follow')
                ->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
        if ($view->doctype()->isRdfa()) {
            $view->appendProperty('og:title', 'Sesquidistus')
                ->appendProperty('og:type', 'sport')
                ->appendProperty('og:image', '/images/minilogo.png')
                ->appendProperty('og:url', 'http://www.frisbee-strasbourg.net')
                ->appendProperty('og:locale', 'fr_FR');
                //->appendProperty('fb:admins', '1018024861')
        }
        $view->headTitle('Sesquidistus')->setSeparator(' - ');
    }

    protected function _initScripts() {
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->headScript()
                ->appendFile('/js/jquery/jquery.min.js')
                ->appendFile('/js/jquery/jquery-migrate-1.2.1.js')
                ->appendFile('/js/jquery/jquery-ui.min.js')
                ->appendFile('/js/jquery/jquery.dropmenu.js')
                ->appendFile('/js/jquery/jquery.ba-resize.min.js', 'text/javascript', array('conditional' => 'IE')) // For the hoverIE script
                ->appendFile('/js/jquery/hoverIE.js', 'text/javascript', array('conditional' => 'IE'))
                ->appendFile('/js/layout.js')
                ->appendFile('/js/jquery/jquery.jgrowl.min.js');
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
                ->headLink(array(
                    'rel' => 'alternate',
                    'type' => 'application/rss+xml',
                    'title' => 'Flux de syndication RSS',
                    'href' => '/feeds',
                ))
                ->appendStylesheet('/css/style.css')
                ->appendStylesheet('/css/jquery.jgrowl.min.css')
                ->appendStylesheet('/css/dropmenu_apple.css')
                ->appendStylesheet('/css/dialog.css')
                ->appendStylesheet('/css/accordion.css')
                ->appendStylesheet('/css/accordionIE.css', 'screen', 'IE 6');
    }
    
    protected function _initTranslation() {
        $this->bootstrap(array('layout', 'view'));
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $translate = new Zend_Session_Namespace('translate');
        if (!isset($translate->Zend_Translate)) {
            $translate->Zend_Translate = new Zend_Translate(array(
                'adapter' => 'array',
                'content' => APPLICATION_PATH.'/../languages/',
                'locale' => 'auto',
                'scan' => Zend_Translate::LOCALE_FILENAME,
                'disableNotices' => false,
                'route'   => array('en' => 'fr',),
            ));
        }
        $view->translate = $translate->Zend_Translate;
    }

    protected function _initNavigation() {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
        $navigation = new Zend_Navigation($config);
        $view->navigation($navigation);
    }

    protected function _initFlashMessenger() {
        $this->bootstrap(array('layout', 'view'));
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getMessages();
        $currentMessages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getCurrentMessages();
        $view->flashMessages = array_merge($messages, $currentMessages);
        Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->clearCurrentMessages();
    }

    protected function _initBandeau() {
        $this->bootstrap(array('layout', 'db'));
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $imageMapper = new Application_Model_Mapper_Image();
        $view->imagesBandeau = array();
        foreach ($imageMapper->fetchBandeau() as $image) {
            $view->imagesBandeau[] = $image->getNomWithPath();
        }
        $view->ad = '/images/anniversaire/bandeau.png';
    }

    protected function _initFooter() {
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->fromYear = 2010;
        date_default_timezone_set('Europe/Paris');
        $view->nowYear = (int) date('Y');
    }

    protected function _initAcl() {
        $acl = Application_Model_Acl::getInstance();
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultAcl($acl);
        Zend_View_Helper_Navigation_HelperAbstract::setDefaultRole(self::_getCurrentUserRoleId());
        Zend_Registry::set('Zend_Acl', $acl);
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new My_Auth());
    }

    protected function _initUser() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->user = null;
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()
                && $auth->getIdentity()->getRoleId() != Application_Model_Acl::ROLE_VISITEUR) {
            $view->user = $auth->getIdentity();
        }
    }

    protected function _initAnalytics() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        if (! @include_once('/homez.63/frisbees/owa/owa_php.php')) {
            trigger_error('Impossible to load OWA');
            return;
        }
        $owa = new owa_php();
        $owa->setSiteId('64fb68a9ba2c4c1d191744ffbcf6580b');
        $owa->setPageTitle($view->headTitle());
        $owa->trackPageView();
    }

    private static function _getCurrentUserRoleId() {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $auth->getStorage()->write(new Application_Model_User());
        }
        return $auth->getIdentity()->getRoleId();
    }

}

