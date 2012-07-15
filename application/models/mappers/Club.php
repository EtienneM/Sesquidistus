<?php

class Application_Model_Mapper_Club extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Club');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Club $club) {
        $data = array(
            'titre' => $club->getTitre(),
            'contenu' => $club->getContenu(),
        );

        if (null === ($id = $club->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Club $club) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $club->setOptions($row->toArray());
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = new Application_Model_Club($row->toArray());
        }
        return $entries;
    }

}

