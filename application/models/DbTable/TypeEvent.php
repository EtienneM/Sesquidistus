<?php

class Application_Model_DbTable_TypeEvent extends Zend_Db_Table_Abstract {
    protected $_name = 'type_event';
    protected $_primary = 'id';
    protected $_sequence = true;
    protected $_dependentTables = array('Evenement');

}

