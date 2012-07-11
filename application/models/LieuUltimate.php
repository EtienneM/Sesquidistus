<?php

class Application_Model_LieuUltimate extends My_Model {
    protected $_id;
    protected $_nom;
    protected $_adresse;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getNom() {
        return $this->_nom;
    }

    public function setNom($nom) {
        $this->_nom = (string) $nom;
        return $this;
    }

    public function getAdresse() {
        return $this->_adresse;
    }

    public function setAdresse($adresse) {
        $this->_adresse = (string) $adresse;
        return $this;
    }

}

