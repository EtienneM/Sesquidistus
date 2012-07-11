<?php

class Application_Model_DbTable_LieuUltimate extends Zend_Db_Table_Abstract {
    protected $_name = 'lieu_ultimate';
    protected $_primary = 'id';
    protected $_sequence = true;
    protected $_dependentTables = array('Evenement');

}

