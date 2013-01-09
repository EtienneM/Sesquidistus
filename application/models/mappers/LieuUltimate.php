<?php

class Application_Model_Mapper_LieuUltimate extends My_Model_Mapper {

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

        if (null === ($id = $lieu->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
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
    
    /**
     * Récupère tous les lieux d'entraînement
     * 
     * @return \Application_Model_LieuUltimate
     */
    public function fetchEntrainements() {
        $table = $this->getDbTable();
        $select = $table->select()
                ->distinct()
                ->from(array('e' => 'evenement'), array())
                ->join(array('l'=>'lieu_ultimate'), 'e.id_lieu = l.id')
                ->where('e.type = 1');
        $entries = array();
        foreach ($table->fetchAll($select) as $row) {
            $entry = new Application_Model_LieuUltimate($row->toArray());
            $entries[] = $entry;
        }
        return $entries;
    }
    
    
    /**
     * Retourne le lieu du KYM le plus récent
     * @return \Application_Model_LieuUltimate
     */
    public function fetchKYM() {
        $table = $this->getDbTable();
        $select = $table->select()
                ->distinct()
                ->from(array('e' => 'evenement'), array())
                ->join(array('l'=>'lieu_ultimate'), 'e.id_lieu = l.id')
                ->where('e.type = 5')
                ->order('e.date DESC');
        $where = '';
        foreach (Application_Model_Evenement::$KYM_OCCURENCES as $occurence) {
            if (!empty($where)) {
                $where .= ' OR ';
            }
            $where .= "e.titre LIKE '%$occurence%'";
        }
        $select->where($where);
        $entries = array();
        foreach ($table->fetchAll($select) as $row) {
            $entry = new Application_Model_LieuUltimate($row->toArray());
            $entries[] = $entry;
        }
        if (isset($entries[0])) {
            return $entries[0];
        }
        return null;
    }

}

