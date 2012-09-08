<?php

class Application_Model_Mapper_User extends My_Model_Mapper {

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_User $user) {
        $data = array(
            'login' => $user->getLogin(),
            'passwd' => $user->getPasswd(),
            'admin' => $user->getAdmin(),
        );

        if (null === ($id = $user->getId())) {
            unset($data['id']);
            unset($data['profil']);
            $id = $this->getDbTable()->insert($data);
            $user->setId($id);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_User $user) {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $profil = new Application_Model_Profil($row->findDependentRowset('Application_Model_DbTable_Profil')->current()->toArray());
        $user->setId($row->id)
                ->setLogin($row->login)
                ->setPasswd($row->passwd)
                ->setAdmin($row->admin)
                ->setProfil($profil);
    }

    /**
     *
     * @param string $login
     * @return \Application_Model_User 
     */
    public function findByLogin($login) {
        $user = new Application_Model_User();
        $select = $this->getDbTable()->select()->where('login = ?', $login);
        $result = $this->getDbTable()->fetchAll($select);
        assert($result->count() <= 1);
        if ($result->count() < 1) {
            return null;
        }
        $row = $result->current();
        $profil = new Application_Model_Profil($row->findDependentRowset('Application_Model_DbTable_Profil')->current()->toArray());
        $user->setId($row->id)
                ->setLogin($row->login)
                ->setPasswd($row->passwd)
                ->setAdmin($row->admin)
                ->setProfil($profil);
        return $user;
    }

}

