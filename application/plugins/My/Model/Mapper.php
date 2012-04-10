<?php

/**
 * Some method are common to all my *Mapper
 *
 * @author emichon
 */
abstract class My_Model_Mapper {
    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    abstract public function getDbTable();
}

