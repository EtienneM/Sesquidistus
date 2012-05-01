<?php

class Application_Model_LieuUltimate extends My_Model {
    protected $_numero;
    protected $_nom;
    protected $_adresse;

    public function getNumero() {
        return $this->_numero;
    }

    public function setNumero($numero) {
        $this->_numero = $numero;
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

