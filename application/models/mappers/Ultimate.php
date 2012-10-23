<?php

class Application_Model_Mapper_Ultimate extends My_Model_Mapper {
    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Ultimate');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Ultimate $ultimate) {
        $data = array(
            'titre' => $ultimate->getTitre(),
            'contenu' => $ultimate->getContenu(),
        );

        if (null === ($id = $ultimate->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            unset($data['titre']);
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Ultimate $ultimate) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $ultimate->setOptions($row->toArray());
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = new Application_Model_Ultimate($row->toArray());
        }
        return $entries;
    }
}

