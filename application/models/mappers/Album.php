<?php

class Application_Model_Mapper_Album extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Album');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Album $album) {
        $data = array(
            'nom' => $album->getNom(),
            'date' => $album->getDate()->get(Zend_Date::ISO_8601),
        );
        if (null === ($id = $album->getId())) {
            unset($data['id']);
            $id = $this->getDbTable()->insert($data);
            $album->setId($id);
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
        $videoRows = $row->findDependentRowset('Application_Model_DbTable_Video');
        $videos = array();
        foreach ($videoRows as $videoRow) {
            $video = new Application_Model_Video($videoRow->toArray());
            $video->setAlbum($album);
            $videos[] = $video;
        }
        $album->setId($row->id)
                ->setNom($row->nom)
                ->setImages($images)
                ->setVideos($videos);
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
     * @return \Application_Model_Album 
     */
    public function findKym() {
        $table = $this->getDbTable();
        $select = $table->select();
        foreach (Application_Model_Evenement::$KYM_OCCURENCES as $occurence) {
            $select->orWhere('nom LIKE ?', "%$occurence%");
        }

        $entries = array();
        foreach ($table->fetchAll($select) as $row) {
            $entries[] = new Application_Model_Album($row->toArray());
        }
        return $entries;
    }

}

