<?php

class Application_Model_DbTable_Article extends Zend_Db_Table_Abstract {
    protected $_name = 'article'; // Nom de la table
    protected $_primary = 'id';   // Facultatif car Zend la trouve tout seule
    protected $_sequence = true;  // Clé primaire auto-incrémentée. Facultatif
    protected $_referenceMap = array(
        'Evenement' => array(
            'columns' => 'id_event',
            'refTableClass' => 'Application_Model_DbTable_Evenement',
            'refColumns' => 'id',
        ),
    );

}

