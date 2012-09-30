<?php

class Application_Model_Mapper_TypeEvent extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_TypeEvent');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_TypeEvent $typeEvent) {
        $data = array(
            'nom' => $typeEvent->getNom(),
            'color' => $typeEvent->getColor(),
        );

        if (null === ($id = $typeEvent->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_TypeEvent $typeEvent) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $typeEvent->setId($row->id)
                ->setColor($row->color)
                ->setNom($row->nom);
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_TypeEvent();
            $entry->setId($row->id)
                    ->setColor($row->color)
                    ->setNom($row->nom);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    /**
     * Supprime un type d'événement.
     * 
     * @param Application_Model_TypeEvent $typeEvent
     */
    public function delete(Application_Model_TypeEvent $typeEvent) {
        if (null === ($id = $typeEvent->getId())) {
            throw new Exception('Impossible de supprimer cet utilisateur');
        }
        $this->getDbTable()->delete(array('id = ?' => $id));
    }

}

