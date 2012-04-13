<?php

class Application_Model_TypeEvent extends My_Model {
    protected $_numero;
    protected $_nom;
    protected $_color;

    public function getNumero() {
        return $this->_numero;
    }

    public function setNumero($numero) {
        $this->_numero = (int) $numero;
        return $this;
    }

    public function getNom() {
        return $this->_nom;
    }

    public function setNom($nom) {
        $this->_nom = (string) $nom;
        return $this;
    }

    public function getColor() {
        return $this->_color;
    }

    public function setColor($color) {
        $this->_color = (string) $color;
        return $this;
    }

}
