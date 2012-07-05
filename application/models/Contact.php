<?php

class Application_Model_Contact extends My_Model {
    protected $_id;
    protected $_prenom;
    protected $_nom;
    protected $_telephone;
    protected $_email;

    /**
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     *
     * @param int $id
     * @return \Application_Model_Contact 
     */
    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPrenom() {
        return $this->_prenom;
    }

    /**
     *
     * @param string $prenom
     * @return \Application_Model_Contact 
     */
    public function setPrenom($prenom) {
        $this->_prenom = (string) $prenom;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getNom() {
        return $this->_nom;
    }

    /**
     *
     * @param string $nom
     * @return \Application_Model_Contact 
     */
    public function setNom($nom) {
        $this->_nom = (string) $nom;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTelephone() {
        return $this->_telephone;
    }

    /**
     *
     * @param string $telephone
     * @return \Application_Model_Contact 
     */
    public function setTelephone($telephone) {
        $this->_telephone = (string) $telephone;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getEmail() {
        return $this->_email;
    }

    /**
     *
     * @param string $email
     * @return \Application_Model_Contact 
     */
    public function setEmail($email) {
        $this->_email = (string) $email;
        return $this;
    }

}

