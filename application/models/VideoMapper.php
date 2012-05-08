<?php

class Application_Model_VideoMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Video');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Video $video) {
        $data = array(
            'type' => $video->getType(),
            'id_site' => $video->getId_site(),
            'titre' => $video->getTitre(),
            'description' => $video->getDescription(),
        );

        if (null === ($id = $video->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Video $video) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $video->setOptions($row->toArray());
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
        $video = new Application_Model_Video($row->toArray());
        $entry = new Application_Model_Image();
        $entry->setAlbum($album)->setIsVideo(true)->setNom($video->getImage());
        return $entry;
    }

}
