<?php

class Application_Model_User extends My_Model implements Zend_Acl_Role_Interface {
    protected $_id;
    protected $_login;
    protected $_passwd;
    protected $_profil;
    // Par défaut, les droits sont à -1 (=visiteur). Sinon, c'est à null et il y a confusion 
    // avec la valeur 0 des membres. C'est obligatoire!!
    protected $_admin = -1;
    // N'est pas un champ de la BDD. Ce déduit du champ admin.
    protected $_aclRoleId;

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
    
    public static function hashPasswd($password) {
        $saltArray = array("%SUC%", "*UDS*");
        return md5($saltArray[0].md5($password).$saltArray[1]);
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
        $this->_setRoleId($this->_admin);
        return $this;
    }

    private function _setRoleId($admin) {
        switch($admin) {
            case 0:
                $this->_aclRoleId = Application_Model_Acl::ROLE_MEMBRE;
                break;
            case 1:
                $this->_aclRoleId = Application_Model_Acl::ROLE_ADMIN;
                break;
            default:
                $this->_aclRoleId = Application_Model_Acl::ROLE_VISITEUR;
        }
    }

    /**
     *
     * @return string 
     */
    public function getRoleId() {
        // aclRoleId est null pour les visiteurs
        if (is_null($this->_aclRoleId)) {
            $this->_setRoleId($this->_admin);
        }
        return $this->_aclRoleId;
    }
    
}

