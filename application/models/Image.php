<?php

class Application_Model_Image extends My_Model {
    protected $_id;
    protected $_nom;
    protected $_height;
    protected $_width;
    protected $_description;
    protected $_id_album;
    protected $_album;

    /**
     * 
     * @return string 
     */
    protected static function _getImagesPath() {
        return "/images/gallery/";
    }

    /**
     * 
     * @return string 
     */
    protected static function _getImagesMiniPath() {
        return "/images/gallery/mini/";
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

    public function getNomWithPath() {
        return ($this->getNom() == '') ? '/images/gallery/small_noImage.gif' : self::_getImagesPath().$this->getAlbum()->getId().'/'.$this->getNom();
    }

    public function getNomWithMiniPath() {
        return ($this->getNom() == '') ? '/images/gallery/small_noImage.gif' : self::_getImagesMiniPath().$this->getAlbum()->getId().'/'.$this->getNom();
    }

    public function getHeight() {
        return $this->_height;
    }

    public function setHeight($height) {
        $this->_height = (int) $height;
        return $this;
    }

    public function getWidth() {
        return $this->_width;
    }

    public function setWidth($width) {
        $this->_width = (int) $width;
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
    
    /**
     *
     * @return Application_Model_Album 
     */
    public function getAlbum() {
        return $this->_album;
    }

    public function setAlbum(Application_Model_Album $album) {
        $this->_album = $album;
        return $this;
    }



}

