<?php

class Application_Model_EvenementMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Evenement');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Evenement $evenement) {
        // TODO Faire une fonction My_Model->toArray pour éviter la ligne suivante...
        $data = array(
            'titre' => $evenement->getTitre(),
            'description' => $evenement->getDescription(),
            'date' => $evenement->getDate(),
            'duree' => $evenement->getDuree(),
            'horaire_debut' => $evenement->getHoraireDebut(),
            'horaire_fin' => $evenement->getHoraireFin(),
            'type' => $evenement->getType(),
            'lieu' => $evenement->getLieu(),
        );

        if (null === ($id = $evenement->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Evenement $evenement) {
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
            $entries[] = new Application_Model_Evenement($row->toArray());
        }
        return $entries;
    }

    /**
     * Get every event between $date and $date + 1 month.
     * 
     * @param Zend_Date $date 
     * @return array Array of Evenement
     */
    public function getFromMonth(Zend_Date $date) {
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('evenement.date >= ?', $date->get(Zend_Date::ISO_8601))
                ->where('evenement.date < ?', $date->addMonth(1)->get(Zend_Date::ISO_8601))
                ->order('evenement.date ASC');
        $entries = array();
        foreach ($table->fetchAll($select) as $row) {
            // TODO Modifier la requête pour faire une jointure ?
            $type = new Application_Model_TypeEvent($row->findParentRow('Application_Model_DbTable_TypeEvent')->toArray());
            $entry = new Application_Model_Evenement($row->toArray());
            $entry->setType($type);
            if ($row['id_lieu'] == 0) {
                $entry->setLieu($row->lieu);
            } else {
                $entry->setLieu(new Application_Model_LieuUltimate($row->findParentRow('Application_Model_DbTable_LieuUltimate')->toArray()));
            }
            $entries[] = $entry;
        }
        return $entries;
    }

}

