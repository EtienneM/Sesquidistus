<?php

class Application_Model_ProfilMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Profil');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Profil $profil) {
        // TODO Faire une fonction My_Model->toArray pour éviter la ligne suivante...
        $data = array(
            'prenom' => $profil->getPrenom(),
            'numero' => $profil->getNumero(),
            'mail' => $profil->getMail(),
            'adhesion' => $profil->getAdhesion()->get(Zend_Date::ISO_8601),
            'question' => $profil->getQuestion(),
            'reponse' => $profil->getReponse(),
            'ancien' => $profil->getAncien(),
        );

        if (null === ($id = $profil->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Profil $evenement) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $evenement->setOptions($row->toArray());
    }
    
    /**
     * Trouve tous les anciens (ou non ancien) de la base de données
     * 
     * @param boolean $ancien
     * @return Array
     */
    public function findAncien($ancien=true) {
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('ancien = ?', $ancien)
                ->order('prenom ASC');
        $entries = array();
        foreach ($table->fetchAll($select) as $row) {
            $entries[] = new Application_Model_Profil($row->toArray());
        }
        return $entries;
    }

}

