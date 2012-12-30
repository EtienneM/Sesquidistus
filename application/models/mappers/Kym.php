<?php

class Application_Model_Mapper_Kym extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Kym');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Kym $kym) {
        $data = array(
            'titre' => $kym->getTitre(),
            'contenu' => $kym->getContenu(),
        );

        if (null === ($id = $kym->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            unset($data['titre']);
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Kym $kym) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $kym->setOptions($row->toArray());
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = new Application_Model_Kym($row->toArray());
        }
        return $entries;
    }

}

