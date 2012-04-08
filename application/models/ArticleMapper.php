<?php

class Application_Model_ArticleMapper {
    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

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
        $entries   = array();
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
}

