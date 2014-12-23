<?php

class Application_Model_Article extends My_Model {
    /**
     *
     * @var int
     */
    protected $_id;
    /**
     * 
     * @var string
     */
    protected $_titre;
    /**
     *
     * @var string
     */
    protected $_contenu;
    /**
     * Date of creation of this article
     * @var Zend_Date
     */
    protected $_date;
    /**
     * Update date
     * @var Zend_Date
     */
    protected $_update;
    /**
     *
     * @var int
     */
    protected $_id_event;
    /**
     *
     * @var Application_Model_Evenement
     */
    protected $_event;
    /**
     *
     * @var int
     */
    protected $_id_member; // Correspond à une colonne de la BDD
    /**
     *
     * @var Application_Model_User
     */
    protected $_author; // Correspond à l'objet User mais à aucune colonne

    /**
     *
     * @param int $id
     * @return \Application_Model_Article 
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
     * @param string $titre
     * @return \Application_Model_Article 
     */
    public function setTitre($titre) {
        $this->_titre = (string) $titre;
        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getTitre() {
        return $this->_titre;
    }

    /**
     *
     * @param string $texte
     * @return \Application_Model_Article 
     */
    public function setContenu($texte) {
        $this->_contenu = (string) $texte;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getContenu() {
        return $this->_contenu;
    }

    /**
     *
     * @param string|integer|Zend_Date|array $date
     * @return \Application_Model_Article 
     */
    public function setDate($date) {
        $this->_date = new Zend_Date($date, Zend_Date::YEAR.'-'.Zend_Date::MONTH.'-'.Zend_Date::DAY);
        return $this;
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
     * @param string|integer|Zend_Date|array $date
     * @return \Application_Model_Article 
     */
    public function setUpdate($date) {
        $this->_update = new Zend_Date($date);
        return $this;
    }
    
    /**
     *
     * @return Zend_Date
     */
    public function getUpdate() {
        return $this->_update;
    }

    /**
     *
     * @return int
     */
    public function getId_event() {
        return $this->_id_event;
    }

    /**
     *
     * @param int $id_event
     * @return \Application_Model_Article 
     */
    public function setId_event($id_event) {
        $this->_id_event = (int) $id_event;
        return $this;
    }
    
    /**
     *
     * @return Application_Model_Evenement
     */
    public function getEvent() {
        return $this->_event;
    }

    /**
     *
     * @param Application_Model_Evenement $event
     * @return \Application_Model_Article 
     */
    public function setEvent(Application_Model_Evenement $event=null) {
        $this->_event = $event;
        return $this;
    }

    /**
     *
     * @return int
     */
    public function getId_member() {
        return $this->_id_member;
    }

    /**
     *
     * @param int $id_member
     * @return \Application_Model_Article 
     */
    public function setId_member($id_member) {
        $this->_id_member = (int) $id_member;
        return $this;
    }

    /**
     *
     * @return Application_Model_User
     */
    public function getAuthor() {
        return $this->_author;
    }

    /**
     *
     * @param Application_Model_User $author
     * @return \Application_Model_Article 
     */
    public function setAuthor(Application_Model_User $author=null) {
        $this->_author = $author;
        return $this;
    }

}

