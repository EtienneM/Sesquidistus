<?php

class Application_Model_LieuUltimateMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_LieuUltimate');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_LieuUltimate $lieu) {
        $data = array(
            'nom' => $lieu->getNom(),
            'adresse' => $lieu->getAdresse(),
        );

        if (null === ($id = $lieu->getNumero())) {
            unset($data['numero']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('numero = ?' => $id));
        }
    }

    public function find($id, Application_Model_LieuUltimate $evenement) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $evenement->setOptions($row->toArray());
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = new Application_Model_LieuUltimate($row->toArray());
        }
        return $entries;
    }

}

