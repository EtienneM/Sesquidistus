<?php

class Application_Model_EvenementMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Evenement');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Evenement $evenement) {
        $data = array(
            'titre' => $evenement->getTitre(),
            'description' => $evenement->getDescription(),
            'date' => $evenement->getDate()->get(Zend_Date::ISO_8601),
            'duree' => $evenement->getDuree(),
            'horaire_debut' => $evenement->getHoraire_debut(),
            'horaire_fin' => $evenement->getHoraire_fin(),
            'type' => $evenement->getType(),
            'lieu' => $evenement->getLieu(),
            'id_lieu' => $evenement->getId_lieu(),
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
    public function findByMonth(Zend_Date $date) {
        $dateEnd = new Zend_Date($date);
        $dateEnd->addMonth(1);
        return $this->findBetweenInterval($date, $dateEnd);
    }

    /**
     * Get every event of a season. i.e. between $dateBegin and 
     * $dateBegin + 1 year - 1 day. For example, from the 1st september 2010 and 
     * the 31st august 2011.
     * 
     * @param Zend_Date $dateBegin 
     * @param int $typeEventId Id of the type of event you want to get
     * @param string $order Order to sort the request. Default is 'DESC'.
     * @return array Array of Evenement
     */
    public function findBySeason(Zend_Date $dateBegin, $typeEventId = null, $order = 'DESC') {
        $dateEnd = new Zend_Date($dateBegin);
        $dateEnd->addYear(1)->subDay(1);
        return $this->findBetweenInterval($dateBegin, $dateEnd, $typeEventId, $order);
    }

    private function findBetweenInterval(Zend_Date $date1, Zend_Date $date2, $typeEventId = null, $order = 'ASC') {
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('evenement.date >= ?', $date1->get(Zend_Date::ISO_8601))
                ->where('evenement.date < ?', $date2->get(Zend_Date::ISO_8601))
                ->order('evenement.date '.$order);
        if (!is_null($typeEventId)) {
            $select->where('evenement.type = ?', $typeEventId);
        }
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

    public function findNext($typeEvent) {
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('date >= CURDATE()')
                ->order('date')
                ->limit(1);
        if (is_array($typeEvent)) {
            $select->where('type IN (?)', $typeEvent);
        } else {
            $select->where('type = ?', $typeEvent);
        }
        
        $row = $table->fetchRow($select);
        if (is_null($row)) return null;
        $type = new Application_Model_TypeEvent($row->findParentRow('Application_Model_DbTable_TypeEvent')->toArray());
        $entry = new Application_Model_Evenement($row->toArray());
        $entry->setType($type);
        if ($row['id_lieu'] == 0) {
            $entry->setLieu($row->lieu);
        } else {
            $entry->setLieu(new Application_Model_LieuUltimate($row->findParentRow('Application_Model_DbTable_LieuUltimate')->toArray()));
        }
        return $entry;
    }
    
    public function findByWord($begining) {
        $table = $this->getDbTable();
        $begining = '%'.$begining.'%';
        $select = $table->select()
                ->where('evenement.titre LIKE ?', $begining)
                ->orWhere('evenement.description LIKE ?', $begining)
                ->orWhere('evenement.lieu LIKE ?', $begining)
                ->order('evenement.date DESC');
        $entries = array();
        foreach ($table->fetchAll($select) as $row) {
            $entry = new Application_Model_Evenement($row->toArray());
            $entries[] = $entry;
        }
        return $entries;
    }

}

