<?php

class Application_Model_Profil extends My_Model {
    protected $_id;
    protected $_id_membre;
    protected $_prenom;
    protected $_numero;
    protected $_mail;
    protected $_adhesion;
    protected $_avatar;
    protected $_question;
    protected $_reponse;
    protected $_ancien = 0;

    /**
     * 
     * @return string 
     */
    public static function _getAvatarPath() {
        return "/images/avatar/";
    }

    /**
     * 
     * @return string 
     */
    public static function _getAvatarMiniPath() {
        return "/images/avatar/mini/";
    }

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId_membre() {
        return $this->_id_membre;
    }

    public function setId_membre($id_membre) {
        $this->_id_membre = (int) $id_membre;
        return $this;
    }

    public function getPrenom() {
        return $this->_prenom;
    }

    public function setPrenom($prenom) {
        $this->_prenom = (string) $prenom;
        return $this;
    }

    public function getNumero() {
        return $this->_numero;
    }

    public function setNumero($numero) {
        if (!is_null($numero)) {
            $this->_numero = (int) $numero;
        }
        return $this;
    }

    public function getMail() {
        return $this->_mail;
    }

    public function setMail($mail) {
        if (!empty($mail)) {
            $this->_mail = (string) $mail;
        }
        return $this;
    }

    public function getAdhesion() {
        return $this->_adhesion;
    }

    public function setAdhesion($adhesion) {
        if (!empty($adhesion)) {
            $this->_adhesion = new Zend_Date($adhesion);
        }
        return $this;
    }

    /**
     * Get the content of the avatar field of the DB
     * 
     * @return string
     */
    public function getAvatar() {
        return $this->_avatar;
    }

    /**
     * Get the path to the avatar
     * 
     * @return string
     */
    public function getAvatarPath() {
        return ($this->getAvatar() == '') ? '/images/membres/no_avatar.png' : self::_getAvatarPath().$this->getAvatar();
    }

    /**
     * Get the path to the thumbnail of the avatar
     * 
     * @return string
     */
    public function getAvatarMiniPath() {
        return ($this->getAvatar() == '') ? '/images/membres/mini_no_avatar.png' : self::_getAvatarMiniPath().$this->getAvatar();
    }

    /**
     *
     * @param type $avatar
     * @return \Application_Model_Profil 
     */
    public function setAvatar($avatar) {
        $this->_avatar = (string) $avatar;
        return $this;
    }

    public function getQuestion() {
        return $this->_question;
    }

    /**
     *
     * @param string $question
     * @return \Application_Model_Profil 
     */
    public function setQuestion($question) {
        $this->_question = (string) $question;
        return $this;
    }

    public function getReponse() {
        return $this->_reponse;
    }

    /**
     *
     * @param string $reponse
     * @return \Application_Model_Profil 
     */
    public function setReponse($reponse) {
        $this->_reponse = (string) $reponse;
        return $this;
    }

    public function getAncien() {
        return $this->_ancien;
    }

    /**
     *
     * @param bool $ancien
     * @return \Application_Model_Profil 
     */
    public function setAncien($ancien) {
        if (!empty($ancien)) {
            $this->_ancien = (bool) $ancien;
        }
        return $this;
    }

}

