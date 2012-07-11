<?php

class Application_Model_Article extends My_Model {
    protected $_id;
    protected $_titre;
    protected $_contenu;
    protected $_date;
    protected $_id_event;
    protected $_event;
    protected $_id_member; // Correspond à une colonne de la BDD
    protected $_author; // Correspond à l'objet User mais à aucune colonne

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId() {
        return $this->_id;
    }

    public function setTitre($titre) {
        $this->_titre = (string) $titre;
        return $this;
    }

    public function getTitre() {
        return $this->_titre;
    }

    public function setContenu($texte) {
        $this->_contenu = (string) $texte;
        return $this;
    }

    public function getContenu() {
        return $this->_contenu;
    }

    public function setDate($date) {
        $this->_date = new Zend_Date($date);
        return $this;
    }

    public function getDate() {
        return $this->_date;
    }

    public function getId_event() {
        return $this->_id_event;
    }

    public function setId_event($id_event) {
        $this->_id_event = (int) $id_event;
        return $this;
    }
    
    public function getEvent() {
        return $this->_event;
    }

    public function setEvent(Application_Model_Evenement $event=null) {
        $this->_event = $event;
        return $this;
    }

    public function getId_member() {
        return $this->_id_member;
    }

    public function setId_member($id_member) {
        $this->_id_member = (int) $id_member;
        return $this;
    }

    public function getAuthor() {
        return $this->_author;
    }

    public function setAuthor(Application_Model_User $author=null) {
        $this->_author = $author;
        return $this;
    }

}

