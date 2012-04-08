<?php

class Application_Model_Article {
    protected $_id;
    protected $_titre;
    protected $_contenu;
    protected $_date_article;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid article property');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid article property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

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

