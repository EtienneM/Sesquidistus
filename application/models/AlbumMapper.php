<?php

class Application_Model_AlbumMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Album');
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
        $imagesRows = $row->findDependentRowset('Application_Model_DbTable_Image');
        $images = array();
        foreach ($imagesRows as $imageRow) {
            $image = new Application_Model_Image($imageRow->toArray());
            $image->setAlbum($album);
            $images[] = $image;
        }
        $album->setId($row->id)
                ->setNom($row->nom)
                ->setImages($images);
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

}

