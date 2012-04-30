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
                ->addResource('calendrier')
                ->addResource('club')
                ->addResource('ultimate')
                ->addResource('galerie')
                ->addResource('evenements')
                ->addResource('auth')
                ->addResource('user');

        $this->allow(self::ROLE_VISITEUR, array('index'), array('index', 'contact', 'apropos', 'mentions'))
                ->allow(self::ROLE_VISITEUR, array('calendrier'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('club'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('ultimate'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('galerie'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('evenements'), array('index'))
                ->allow(self::ROLE_VISITEUR, array('user'), array('list', 'view'))
                ->allow(self::ROLE_VISITEUR, array('auth'), array('login', 'forget'))
                ->allow(self::ROLE_MEMBRE, array('user'), array('index', 'editProfil', 'editPwd'))
                ->allow(self::ROLE_MEMBRE, array('auth'), array('logout'))
                ->allow(self::ROLE_ADMIN, array('club'), array('modifier', 'ajouter', 'supprimer'))
                ->allow(self::ROLE_ADMIN, array('ultimate'), array('modifier', 'ajouter', 'supprimer'));
    }

    protected static $_user = null;

    public static function setUser(Application_Model_User $user = null) {
        if (null === $user) {
            throw new InvalidArgumentException('$user is null');
        }

        self::$_user = $user;
    }

}
