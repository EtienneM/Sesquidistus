<?php

class Application_Model_Evenement extends My_Model {
    protected $_id;
    protected $_titre;
    protected $_description;
    protected $_date;
    protected $_duree;
    protected $_horaire_debut;
    protected $_horaire_fin;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getTitre() {
        return $this->_titre;
    }

    public function setTitre($titre) {
        $this->_titre = (string) $titre;
        return $this;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function setDescription($description) {
        $this->_description = (string) $description;
        return $this;
    }

    public function getDate() {
        return $this->_date;
    }

    public function setDate($date) {
        $this->_date = new Zend_Date($date);
        return $this;
    }

    public function getDuree() {
        return $this->_duree;
    }

    public function setDuree($duree) {
        $this->_duree = (int) $duree;
        return $this;
    }

    public function getHoraire_debut() {
        return $this->_horaire_debut;
    }

    public function setHoraire_debut($horaireDebut) {
        // TODO Transformer de string en Zend_Date
        $this->_horaire_debut = (string) $horaireDebut;
        return $this;
    }

    public function getHoraire_fin() {
        return $this->_horaire_fin;
    }

    public function setHoraire_fin($horaireFin) {
        $this->_horaire_fin = (string) $horaireFin;
        return $this;
    }

}

