<?php

class Application_Model_DbTable_Album extends Zend_Db_Table_Abstract {
    protected $_name = 'albums';   // Nom de la table
    protected $_primary = 'id';   // Facultatif car Zend la trouve tout seule
    protected $_sequence = true;  // Clé primaire auto-incrémentée. Facultatif

}

