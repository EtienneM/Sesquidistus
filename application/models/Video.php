<?php

class Application_Model_Video extends My_Model {
    protected $_id;
    protected $_type;
    protected $_id_site;
    protected $_titre;
    protected $_description;
    protected $_id_album = 1;
    protected $_album;
    private $_image;
    private $_embedded;

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

    /**
     *
     * @return string 
     */
    public function getEmbeddedCode() {
        if (!empty($this->_embedded)) {
            return $this->_embedded;
        }
        switch($this->getType()) {
            case 'youtube':
                $this->_embedded = '<object class="video" width="700" height="500">
                    <param name="movie" value="http://www.youtube.com/v/'.$this->getId_site().'&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded"></param>
                    <param name="allowFullScreen" value="true"></param>
                    <param name="allowScriptAccess" value="always"></param>
                    <embed class="video" src="http://www.youtube.com/v/'.$this->getId_site().'&hl=fr_FR&feature=player_embedded&version=3?border=1&color1=0xb1b1b1&color2=0xcfcfcf&fs=1&hd=1&iv_load_policy=3&feature=player_embedded" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="700" height="500"></embed>
                </object>';
                break;
            case 'dailymotion':
                $this->_embedded = '<object class="video" width="700" height="500">
                    <param name="movie" value="http://www.dailymotion.com/swf/video/'.$this->getId_site().'?background=493D27&foreground=E8D9AC&highlight=FFFFF0"></param><param name="allowFullScreen" value="true"></param>
                    <param name="allowScriptAccess" value="always"></param>
                    <embed class="video" type="application/x-shockwave-flash" src="http://www.dailymotion.com/swf/video/'.$this->getId_site().'?background=493D27&foreground=E8D9AC&highlight=FFFFF0" width="700" height="500" allowfullscreen="true" allowscriptaccess="always"></embed>
                </object>';
                break;
            case 'vimeo':
                $this->_embedded = '<div class="video_element_viewer">
                    <iframe src="http://player.vimeo.com/video/'.$this->getId_site().'?title=0&byline=0&portrait=0&color=ff9933" width="650" height="272" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                </div>
                    ';
                break;
            default:
                break;
        }
        return $this->_embedded;
    }

    /**
     *
     * @return string
     */
    public function getImage() {
        if (!empty($this->_image)) {
            return $this->_image;
        }
        switch($this->getType()) {
            case 'youtube':
                $this->_image = 'http://img.youtube.com/vi/'.$this->getId_site().'/1.jpg';
                break;
            case 'dailymotion':
                $this->_image = 'http://www.dailymotion.com/thumbnail/120x90/video/'.$this->getId_site();
                break;
            case 'vimeo':
                $hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$this->getId_site().'.php'));
                $this->_embedded = '';
                $this->_image = $hash[0]['thumbnail_small'];
            default:
                break;
        }
        return $this->_image;
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

