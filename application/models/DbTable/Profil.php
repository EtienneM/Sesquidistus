<?php

class Application_Model_DbTable_Profil extends Zend_Db_Table_Abstract {
    protected $_name = 'profil';
    protected $_primary = 'id';
    protected $_sequence = true;
    protected $_referenceMap = array(
        'Profil' => array(
            'columns' => 'id_membre',
            'refTableClass' => 'Application_Model_DbTable_User',
            'refColumns' => 'id',
        ),
    );

}

