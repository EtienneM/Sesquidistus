<?php

class Application_Model_Evenement extends My_Model {
    /**
     *
     * @var int
     */
    protected $_id;

    /**
     *
     * @var string
     */
    protected $_titre;

    /**
     *
     * @var string
     */
    protected $_description;

    /**
     *
     * @var Zend_Date
     */
    protected $_date;

    /**
     *
     * @var int
     */
    protected $_duree;

    /**
     *
     * @var string
     */
    protected $_horaire_debut;

    /**
     *
     * @var string
     */
    protected $_horaire_fin;

    /**
     *
     * @var Application_Model_TypeEvent | int
     */
    protected $_type;

    /**
     * @var Application_Model_LieuUltimate | int | string
     */
    protected $_lieu;

    /**
     *
     * @var int
     */
    protected $_id_lieu;

    /**
     * What string to look for in order to identify the KYM event 
     */
    public static $KYM_OCCURENCES = array('KYM', 'Keep Your Moustache', 'Keep Your Mustache');

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
     * @return \Application_Model_Evenement 
     */
    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTitre() {
        return $this->_titre;
    }

    /**
     *
     * @param string $titre
     * @return \Application_Model_Evenement 
     */
    public function setTitre($titre) {
        $this->_titre = (string) $titre;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getDescription() {
        return $this->_description;
    }

    /**
     *
     * @param string $description
     * @return \Application_Model_Evenement 
     */
    public function setDescription($description) {
        $this->_description = (string) $description;
        return $this;
    }

    /**
     *
     * @return Zend_Date 
     */
    public function getDate() {
        return $this->_date;
    }

    /**
     *
     * @param Zend_Date | string $date
     * @return \Application_Model_Evenement 
     */
    public function setDate($date) {
        $this->_date = new Zend_Date($date, Zend_Date::YEAR.'-'.Zend_Date::MONTH.'-'.Zend_Date::DAY);
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getDuree() {
        return $this->_duree;
    }

    /**
     *
     * @param int $duree
     * @return \Application_Model_Evenement 
     */
    public function setDuree($duree) {
        $this->_duree = (int) $duree;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getHoraire_debut() {
        return $this->_horaire_debut;
    }

    /**
     *
     * @param string $horaireDebut
     * @return \Application_Model_Evenement 
     */
    public function setHoraire_debut($horaireDebut) {
        $this->_horaire_debut = (string) $horaireDebut;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getHoraire_fin() {
        return $this->_horaire_fin;
    }

    /**
     *
     * @param string $horaireFin
     * @return \Application_Model_Evenement 
     */
    public function setHoraire_fin($horaireFin) {
        $this->_horaire_fin = (string) $horaireFin;
        return $this;
    }

    /**
     *
     * @return Application_Model_TypeEvent
     */
    public function getType() {
        return $this->_type;
    }

    /**
     *
     * @param Application_Model_TypeEvent | int $type
     * @return \Application_Model_Evenement 
     */
    public function setType($type) {
        // TODO Vérifie si type est un int ou un Application_Model_TypeEvent
        $this->_type = $type;
        return $this;
    }

    /**
     *
     * @return Application_Model_LieuUltimate
     */
    public function getLieu() {
        return $this->_lieu;
    }

    /**
     *
     * @param Application_Model_LieuUltimate | string | int $lieu
     * @return \Application_Model_Evenement 
     */
    public function setLieu($lieu) {
        // TODO Vérifie si type est un int (pour id_lieu), un string (pour lieu) 
        // ou un Application_Model_LieuUltimate
        $this->_lieu = $lieu;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getId_lieu() {
        return $this->_id_lieu;
    }

    /**
     *
     * @param int $id_lieu
     * @return \Application_Model_Evenement 
     */
    public function setId_lieu($id_lieu) {
        $this->_id_lieu = (int) $id_lieu;
        return $this;
    }

}

