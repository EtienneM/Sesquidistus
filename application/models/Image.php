<?php

class Application_Model_Image extends My_Model {
    protected $_id;
    protected $_nom;
    protected $_height;
    protected $_width;
    protected $_description;
    protected $_slideshow = false;
    protected $_id_album = 1;
    protected $_album;
    /**
     * Vrai si cette image ne correspond pas à un champs de la base mais à une image de vidéo
     * @var bool 
     */
    protected $_isVideo; 

    /**
     * 
     * @return string 
     */
    public static function _getImagesPath() {
        return '/images/gallery/photos/';
    }

    /**
     * 
     * @return string 
     */
    public static function _getImagesMiniPath() {
        return '/images/gallery/photos/mini/';
    }

    /**
     * 
     * @return string 
     */
    public static function _getBandeauPath() {
        return '/images/bandeau/';
    }

    /**
     * 
     * @return string 
     */
    public static function _getBandeauUploadedPath() {
        return self::_getBandeauPath().'uploaded/';
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
        if ($this->getSlideshow()) {
            return self::_getBandeauPath().$this->getNom();
        }
        if ($this->getNom() == '') {
            return '/images/gallery/small_noImage.gif';
        }
        return $this->getAlbum()->getPath().'/'.$this->getNom();
    }

    public function getNomWithMiniPath() {
        if ($this->getSlideshow()) {
            throw new BadMethodCallException("Bandeau n'a pas de mini-image");
        }
        if ($this->isVideo()) {
            return $this->getNom();
        }
        return ($this->getNom() == '') ? '/images/gallery/small_noImage.gif' : $this->getAlbum()->getMiniPath().'/'.$this->getNom();
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
        $this->_id_album = $album->id;
        $this->_album = $album;
        return $this;
    }

    public function getSlideshow() {
        return $this->_slideshow;
    }

    public function setSlideshow($slideshow) {
        $this->_slideshow = (bool) $slideshow;
        return $this;
    }

    public function isVideo() {
        return $this->_isVideo;
    }

    public function setIsVideo($isVideo) {
        $this->_isVideo = (bool) $isVideo;
        return $this;
    }


}

