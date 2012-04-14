<?php

class Application_Model_ProfilMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Evenement');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Profil $profil) {
        // TODO Faire une fonction My_Model->toArray pour éviter la ligne suivante...
        $data = array(
            'prenom' => $profil->getPrenom(),
            'numero' => $profil->getNumero(),
            'mail' => $profil->getMail(),
            'adhesion' => $profil->getAdhesion(),
            'question' => $profil->getQuestion(),
            'reponse' => $profil->getReponse(),
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

}

