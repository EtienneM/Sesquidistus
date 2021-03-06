<?php

/**
 * Défini les rôles et les droits de chacun de ces rôles.
 * Par défaut, tout est interdit et nous autorisons explicitement.
 *
 * @author emichon
 */
class Application_Model_Acl extends Zend_Acl {
    const ROLE_VISITEUR = 'visiteur';
    const ROLE_MEMBRE = 'membre';
    const ROLE_ADMIN = 'admin';

    protected static $_instance = null;

    protected function __clone() {
        
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function resetInstance() {
        self::$_instance = null;
        self::getInstance();
    }

    protected function __construct() {
        $this->addRole(self::ROLE_VISITEUR);
        $this->addRole(self::ROLE_MEMBRE, self::ROLE_VISITEUR);
        $this->addRole(self::ROLE_ADMIN, self::ROLE_MEMBRE);

        // Admin is God
        $this->allow(self::ROLE_ADMIN);

        // Dans notre cas, les ressources sont les controleurs et les privilèges 
        // sont les actions.
        $this->addResource('index')
        		->addResource('autre')
                ->addResource('calendrier')
                ->addResource('club')
                ->addResource('lieu')
                ->addResource('ultimate')
                ->addResource('galerie')
                ->addResource('evenements')
                ->addResource('auth')
                ->addResource('user')
                ->addResource('article')
                ->addResource('feeds')
                ->addResource('sitemap')
                ->addResource('type-event')
                ->addResource('kym');

        $this->allow(self::ROLE_VISITEUR, array('index'), array('index', 'contact', 'apropos', 'mentions', 'nouveaux'))
        		->allow(self::ROLE_VISITEUR, array('autre'), array('contact', 'apropos', 'mentions', 'changelang'))
                ->allow(self::ROLE_VISITEUR, array('calendrier'), array('index', 'ical'))
                ->allow(self::ROLE_VISITEUR, array('club'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('ultimate'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('galerie'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('evenements'), array('index', 'kym'))
                ->allow(self::ROLE_VISITEUR, array('user'), array('list', 'view', 'create', 'checkLogin'))
                ->allow(self::ROLE_VISITEUR, array('auth'), array('login', 'forget', 'persona'))
                ->allow(self::ROLE_VISITEUR, array('article'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('feeds'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('sitemap'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('kym'), array('index', 'addPickup'))
                ->allow(self::ROLE_MEMBRE, array('user'), array('index', 'editProfil', 'editPwd', 'editAvatar'))
                ->allow(self::ROLE_MEMBRE, array('auth'), array('logout'))
                ->allow(self::ROLE_MEMBRE, array('galerie'), array('soumettre'));
    }

    protected static $_user = null;

    public static function setUser(Application_Model_User $user = null) {
        if (null === $user) {
            throw new InvalidArgumentException('$user is null');
        }

        self::$_user = $user;
    }

}
