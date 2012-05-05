<?php

class Application_Model_Album extends My_Model {
    protected $_id;
    protected $_nom;
    protected $_date;
    protected $_images;

    public function getMiniPath() {
        return Application_Model_Image::_getImagesMiniPath().$this->getId().'/';
    }

    public function getPath() {
        return Application_Model_Image::_getImagesPath().$this->getId().'/';
    }

    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId() {
        return $this->_id;
    }

    public function setNom($nom) {
        $this->_nom = (string) $nom;
        return $this;
    }

    public function getNom() {
        return $this->_nom;
    }

    public function getDate() {
        return $this->_date;
    }

    public function setDate(Zend_Date $date) {
        $this->_date = new Zend_Date($date);
    }

    public function getImages() {
        return $this->_images;
    }

    public function setImages(array $images) {
        $this->_images = $images;
        return $this;
    }

}

