<?php

class Application_Model_ArticleMapper extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Article');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Article $article) {
        $data = array(
            'titre' => $article->getTitre(),
            'contenu' => $article->getContenu(),
            'date_article' => $article->getDate_article(),
        );
        if (null === ($id = $article->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Article $article) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $article->setId($row->id)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setDate_article($row->date_article);
    }

    public function fetchAll() {
        $resultSet = $this->getDbTable()->fetchAll(null, 'date_article DESC');
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Article();
            $entry->setId($row->id)
                    ->setTitre($row->titre)
                    ->setContenu($row->contenu)
                    ->setDate_article($row->date_article);
            $entries[] = $entry;
        }
        return $entries;
    }

    /**
     * Trouve les articles correspondant à un évènement pour la page sépcifier.
     * Cette méthode retourne un tableau d'articles et un Zend_Paginator 
     * au niveau du troisième argument.
     * 
     * @param int $idEvent 
     * @param int $page
     * @param Zend_Paginator $paginator
     * @return \Application_Model_Article 
     */
    public function findByEvent($idEvent = null, $page = 1, Zend_Paginator &$paginator = null) {
        $table = $this->getDbTable();
        $select = $table->select()->order('article.date_article DESC');
        if (!is_null($idEvent)) {
            $select->where('article.id_event = ?', $idEvent);
        }
        $entries = array();
        $paginator = Zend_Paginator::factory($select);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(5);
        foreach ($paginator as $row) {
            $entry = new Application_Model_Article();
            $entry->setId($row->id)
                    ->setTitre($row->titre)
                    ->setContenu($row->contenu)
                    ->setDate_article($row->date_article);
            $entries[] = $entry;
        }
        return $entries;
    }

}

