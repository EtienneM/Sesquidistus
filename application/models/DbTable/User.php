<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract {
    protected $_name = 'membre';
    protected $_primary = 'id';
    protected $_sequence = true;
    protected $_dependentTables = array('Profil');

}

