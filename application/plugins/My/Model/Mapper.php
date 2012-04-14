<?php

/**
 * Some method are common to all my *Mapper
 *
 * @author emichon
 */
abstract class My_Model_Mapper {
    protected $_dbTable;

    /**
     *
     * @return My_Model_Mapper
     */
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

    /**
     *
     * @return Zend_Db_Table_Abstract
     */
    abstract public function getDbTable();
}

