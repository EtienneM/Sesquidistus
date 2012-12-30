<?php

class Application_Model_Kym extends My_Model {
    protected $_id;
    protected $_titre;
    protected $_contenu;

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

    public function getContenu() {
        return $this->_contenu;
    }

    public function setContenu($contenu) {
        $this->_contenu = (string) $contenu;
        return $this;
    }

}

