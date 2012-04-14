<?php

class Application_Model_User extends My_Model implements Zend_Acl_Role_Interface {
    protected $_id;
    protected $_login;
    protected $_passwd;
    protected $_admin;
    protected $_profil;

    /**
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     *
     * @param type $id
     * @return \Application_Model_User 
     */
    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getLogin() {
        return $this->_login;
    }

    /**
     *
     * @param type $login
     * @return \Application_Model_User 
     */
    public function setLogin($login) {
        $this->_login = (string) $login;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPasswd() {
        return $this->_passwd;
    }

    /**
     *
     * @param type $passwd
     * @return \Application_Model_User 
     */
    public function setPasswd($passwd) {
        $this->_passwd = (string) $passwd;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getAdmin() {
        return $this->_admin;
    }

    /**
     *
     * @param type $admin
     * @return \Application_Model_User 
     */
    public function setAdmin($admin) {
        $this->_admin = (int) $admin;
        return $this;
    }
    
    /**
     *
     * @return Application_Model_Profil 
     */
    public function getProfil() {
        return $this->_profil;
    }

    /**
     *
     * @param Application_Model_Profil $profil
     * @return \Application_Model_User 
     */
    public function setProfil(Application_Model_Profil $profil) {
        $this->_profil = $profil;
        return $this;
    }

    
    protected $_aclRoleId = null;

    /**
     *
     * @return string 
     */
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

