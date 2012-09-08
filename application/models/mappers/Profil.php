<?php

class Application_Model_Mapper_Profil extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Profil');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Profil $profil) {
        // TODO Faire une fonction My_Model->toArray pour éviter la ligne suivante...
        $data = array(
            'id_membre' => $profil->getId_membre(),
            'prenom' => $profil->getPrenom(),
            'numero' => $profil->getNumero(),
            'mail' => $profil->getMail(),
            'avatar' => $profil->getAvatar(),
            'question' => $profil->getQuestion(),
            'reponse' => $profil->getReponse(),
            'ancien' => $profil->getAncien(),
        );
        $adhesion = $profil->getAdhesion();
        if (!empty($adhesion)) {
            $data['adhesion'] = $profil->getAdhesion()->get(Zend_Date::ISO_8601);
        }

        if (null === ($id = $profil->getId())) {
            unset($data['id']);
            $id = $this->getDbTable()->insert($data);
            $profil->setId($id);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Profil $profil) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $profil->setOptions($row->toArray());
    }

    /**
     * Trouve tous les anciens (ou non ancien) de la base de données
     * 
     * @param boolean $ancien
     * @return Array
     */
    public function findAncien($ancien = true) {
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

