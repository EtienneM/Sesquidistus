<?php

class Application_Model_ImageMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Image');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Album $album) {
        $data = array(
            'nom' => $album->getNom(),
            'date' => $album->getDate(),
        );
        if (null === ($id = $album->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Album $album) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $album->setId($row->id)
                ->setNom($row->nom);
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll(null, 'date DESC');
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Album();
            $entry->setId($row->id)
                    ->setNom($row->nom);
            $entries[] = $entry;
        }
        return $entries;
    }
    
    /**
     *
     * @param Application_Model_Album $album
     * @return \Application_Model_Image 
     */
    public function findFirstImage(Application_Model_Album $album) {
        $table = $this->getDbTable();
        $select = $table->select()
                ->where('id_album = ?', $album->getId())
                ->limit(1);
        
        $row = $table->fetchRow($select);
        if (is_null($row)) return new Application_Model_Image();
        $entry = new Application_Model_Image($row->toArray());
        $entry->setAlbum($album);
        return $entry;
    }

}

