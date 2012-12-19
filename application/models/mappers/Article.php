<?php

class Application_Model_Mapper_Article extends My_Model_Mapper {

    /**
     *
     * @return Application_Model_DbTable_Article 
     */
    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Article');
        }
        return $this->_dbTable;
    }

    /**
     *
     * @param Application_Model_Article $article 
     */
    public function save(Application_Model_Article $article) {
        $article->setUpdate(new Zend_Date());
        $data = array(
            'titre' => $article->getTitre(),
            'contenu' => $article->getContenu(),
            'date' => $article->getDate()->get(Zend_Date::ISO_8601),
            'id_event' => $article->getId_event(),
            'id_member' => $article->getId_member(),
            'update' => $article->getUpdate()->get(Zend_Date::ISO_8601),
        );
        if (null === ($id = $article->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            unset($data['date']);
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    /**
     *
     * @param int $id
     * @param Application_Model_Article $article
     * @return null 
     */
    public function find($id, Application_Model_Article $article) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $article->setId($row->id)
                ->setTitre($row->titre)
                ->setContenu($row->contenu)
                ->setDate($row->date);
        $eventRow = $row->findParentRow('Application_Model_DbTable_Evenement');
        if (!empty($eventRow)) {
            $event = new Application_Model_Evenement($row->findParentRow('Application_Model_DbTable_Evenement')->toArray());
            $article->setEvent($event);
        }
        $authorRow = $row->findParentRow('Application_Model_DbTable_User');
        if (!empty($authorRow)) {
            $author = new Application_Model_User($row->findParentRow('Application_Model_DbTable_User')->toArray());
            $article->setAuthor($author);
        }
    }

    /**
     *
     * @param type $limit
     * @return \Application_Model_Article 
     */
    public function fetchAll($limit = null) {
        $resultSet = $this->getDbTable()->fetchAll(null, array('date DESC', 'id DESC'), $limit);
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Article();
            $entry->setId($row->id)
                    ->setTitre($row->titre)
                    ->setContenu($row->contenu)
                    ->setDate($row->date);
            $entries[] = $entry;
        }
        return $entries;
    }

    /**
     * Trouve les articles correspondant à un évènement pour la page spécifier.
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
        $select = $table->select()->order('article.date DESC')->order('article.id DESC');
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
                    ->setDate($row->date);
            $authorRow = $row->findParentRow('Application_Model_DbTable_User');
            if (!empty($authorRow)) {
                $author = new Application_Model_User($row->findParentRow('Application_Model_DbTable_User')->toArray());
                $entry->setAuthor($author);
            }
            $entries[] = $entry;
        }
        return $entries;
    }

    /**
     * Get the articles concerning the KYM.
     * 
     * @param int $page
     * @param Zend_Paginator $paginator
     * @return \Application_Model_Article 
     */
    public function findKym($page = 1, Zend_Paginator &$paginator = null) {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $select = $dbAdapter->select()->from(array('a' => 'article'), array('id', 'titre', 'contenu', 'date', 'id_member'))
                        ->join(array('e' => 'evenement'), 'a.id_event = e.id', array())
                        ->order('a.date DESC')->order('a.id DESC');
        foreach (Application_Model_Evenement::$KYM_OCCURENCES as $occurence) {
            $select->orWhere('a.titre LIKE ?', "%$occurence%")
                    ->orWhere('e.titre LIKE ?', "%$occurence%");
        }

        $paginator = Zend_Paginator::factory($select);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(5);
        $entries = array();
        $userMapper = new Application_Model_Mapper_User();
        $user = new Application_Model_User();
        foreach ($paginator as $row) {
            $article = new Application_Model_Article();
            $article->setId($row['id'])
                    ->setTitre($row['titre'])
                    ->setContenu($row['contenu'])
                    ->setDate($row['date']);
            $userMapper->find($row['id_member'], $user);
            $user_id = $user->getId();
            if (!empty($user_id)) {
                $article->setAuthor($user);
                $user = new Application_Model_User();
            }
            $entries[] = $article;
        }
        return $entries;
    }

    /**
     *
     * @param int $idEvent 
     */
    public function deleteByEvent($idEvent) {
        $this->getDbTable()->delete(array('id_event = ?' => $idEvent));
    }

}

