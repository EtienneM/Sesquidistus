<?php

class Application_Model_Article extends My_Model {
    protected $_id;
    protected $_titre;
    protected $_contenu;
    protected $_date_article;

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

    public function setDate_article($dateArticle) {
        $this->_date_article = new Zend_Date($dateArticle);
        return $this;
    }

    public function getDate_article() {
        return $this->_date_article;
    }

}
