<?php

class Application_Model_DbTable_Image extends Zend_Db_Table_Abstract {
    protected $_name = 'images';   // Nom de la table
    protected $_primary = 'id';   // Facultatif car Zend la trouve tout seule
    protected $_sequence = true;  // Clé primaire auto-incrémentée. Facultatif
    protected $_referenceMap = array(
        'Album' => array(
            'columns' => 'id_album',
            'refTableClass' => 'Application_Model_DbTable_Album',
            'refColumns' => 'id',
        ),
    );

}

