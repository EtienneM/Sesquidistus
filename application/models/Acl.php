<?php

/**
 * Description of Acl
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
        //$acl->addResource('');
    }

    protected static $_user = null;

    public static function setUser(Application_Model_User $user = null) {
        if (null === $user) {
            throw new InvalidArgumentException('$user is null');
        }

        self::$_user = $user;
    }

}
