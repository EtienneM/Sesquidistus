<?php

class Application_Model_UserMapper extends My_Model_Mapper {

    /**
     *
     * @return Zend_Db_Table_Abstract
     */
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
            $this->getDbTable()->insert($data);
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
        $user->setId($row->id)
                ->setLogin($row->login)
                ->setPasswd($row->passwd)
                ->setAdmin($row->admin);
    }
    
    public function findByLogin($login) {
        /*$user = new Application_Model_User();
        $this->getDbTable()->fetchAll('');
        return $user;*/
    }

}

