<?php

class Application_Model_Video extends My_Model {
    protected $_id;
    protected $_type;
    protected $_id_site;
    protected $_titre;
    protected $_description;
    protected $_id_album = 1;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getType() {
        return $this->_type;
    }

    public function setType($type) {
        $this->_type = (string) $type;
        return $this;
    }

    public function getId_site() {
        return $this->_id_site;
    }

    public function setId_site($id_site) {
        $this->_id_site = (string) $id_site;
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

    public function getId_album() {
        return $this->_id_album;
    }

    public function setId_album($id_album) {
        $this->_id_album = (int) $id_album;
        return $this;
    }

}

