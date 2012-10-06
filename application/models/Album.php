<?php

class Application_Model_Album extends My_Model {
    /**
     *
     * @var int
     */
    protected $_id;

    /**
     *
     * @var string
     */
    protected $_nom;

    /**
     *
     * @var Zend_Date
     */
    protected $_date;

    /**
     *
     * @var \Application_Model_Image
     */
    protected $_images;

    /**
     *
     * @var \Application_Model_Video 
     */
    protected $_videos;

    /**
     *
     * @var Application_Model_Image
     */
    protected $_firstImage;

    /**
     *
     * @var Application_Model_Mapper_Image
     */
    private static $_imageMapper = null;

    /**
     * 
     * @var Application_Model_Mapper_Video
     */
    private static $_videoMapper = null;

    /**
     *
     * @return string
     */
    public function getMiniPath() {
        return Application_Model_Image::_getImagesMiniPath().$this->getId().'/';
    }

    /**
     *
     * @return string
     */
    public function getPath() {
        return Application_Model_Image::_getImagesPath().$this->getId().'/';
    }

    /**
     *
     * @param int $id
     * @return \Application_Model_Album 
     */
    public function setId($id) {
        $this->_id = (int) $id;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getId() {
        return $this->_id;
    }

    /**
     *
     * @param string $nom
     * @return \Application_Model_Album 
     */
    public function setNom($nom) {
        $this->_nom = (string) $nom;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getNom() {
        return $this->_nom;
    }

    /**
     *
     * @return Zend_Date
     */
    public function getDate() {
        return $this->_date;
    }

    /**
     *
     * @param Zend_Date | string $date 
     * @return \Application_Model_Album 
     */
    public function setDate($date) {
        $this->_date = new Zend_Date($date);
        return $this;
    }

    /**
     *
     * @return \Application_Model_Image
     */
    public function getImages() {
        return $this->_images;
    }

    /**
     *
     * @param array $images
     * @return \Application_Model_Album 
     */
    public function setImages(array $images) {
        $this->_images = $images;
        return $this;
    }

    /**
     *
     * @return \Application_Model_Video
     */
    public function getVideos() {
        return $this->_videos;
    }

    /**
     *
     * @param array $videos
     * @return \Application_Model_Album 
     */
    public function setVideos(array $videos) {
        $this->_videos = $videos;
        return $this;
    }

    /**
     *
     * @return Application_Model_Image | null
     */
    public function getFirstImage() {
        if (is_null($this->_firstImage)) {
            if (is_null(self::$_imageMapper)) {
                self::$_imageMapper = new Application_Model_Mapper_Image();
            }
            $image = self::$_imageMapper->findFirstImage($this);
            // S'il n'y a pas de première image, on peut trouver du côté des vidéos
            if (empty($image)) {
                if (is_null(self::$_videoMapper)) {
                    self::$_videoMapper = new Application_Model_Mapper_Video();
                }
                $image = self::$_videoMapper->findFirstImage($this);
            }
            $this->_firstImage = $image;
        }
        return $this->_firstImage;
    }

}

