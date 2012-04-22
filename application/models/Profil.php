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
    protected $_ancien;

    /**
     * 
     * @return string 
     */
    public static function getAvatarPath() {
        return "/images/avatar/";
    }
    
    /**
     * 
     * @return string 
     */
    public static function getAvatarMiniPath() {
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
        $this->_numero = (int) $numero;
        return $this;
    }

    public function getMail() {
        return $this->_mail;
    }

    public function setMail($mail) {
        $this->_mail = (string) $mail;
        return $this;
    }

    public function getAdhesion() {
        return $this->_adhesion;
    }

    public function setAdhesion($adhesion) {
        $this->_adhesion = new Zend_Date($adhesion);
        return $this;
    }
    
    /**
     *
     * @return string
     */
    public function getAvatar() {
        return $this->_avatar;
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

    public function setQuestion($question) {
        $this->_question = (string) $question;
        return $this;
    }

    public function getReponse() {
        return $this->_reponse;
    }

    public function setReponse($reponse) {
        $this->_reponse = (string) $reponse;
        return $this;
    }
    
    public function getAncien() {
        return $this->_ancien;
    }

    public function setAncien($ancien) {
        $this->_ancien = (bool) $ancien;
        return $this;
    }

}

