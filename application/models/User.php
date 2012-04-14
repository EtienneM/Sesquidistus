<?php

class Application_Model_User extends My_Model implements Zend_Acl_Role_Interface {
    protected $_id;
    protected $_login;
    protected $_passwd;
    protected $_admin;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getLogin() {
        return $this->_login;
    }

    public function setLogin($login) {
        $this->_login = (string) $login;
        return $this;
    }

    public function getPasswd() {
        return $this->_passwd;
    }

    public function setPasswd($passwd) {
        $this->_passwd = (string) $passwd;
        return $this;
    }

    public function getAdmin() {
        return $this->_admin;
    }

    public function setAdmin($admin) {
        $this->_admin = (int) $admin;
        return $this;
    }

    protected $_aclRoleId = null;

    public function getRoleId() {
        if ($this->_aclRoleId == null) {
            switch($this->getAdmin()) {
                case 0:
                    $this->_aclRoleId = Application_Model_Acl::ROLE_MEMBRE;
                case 1:
                    $this->_aclRoleId = Application_Model_Acl::ROLE_ADMIN;
                default:
                    $this->_aclRoleId = Application_Model_Acl::ROLE_VISITEUR;
            }
        }
        return $this->_aclRoleId;
    }

}

