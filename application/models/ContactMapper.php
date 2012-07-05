<?php

class Application_Model_ContactMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Contact');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Contact $contact) {
        $data = array(
            'prenom' => $contact->getPrenom(),
            'nom' => $contact->getNom(),
            'telephone' => $contact->getTelephone(),
            'email' => $contact->getEmail(),
        );

        if (null === ($id = $contact->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Contact $contact) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $contact->setOptions($row->toArray());
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = new Application_Model_Contact($row->toArray());
        }
        return $entries;
    }

}

