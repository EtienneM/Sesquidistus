<?php

/**
 *
 * @author emichon
 */
class Zend_View_Helper_IsAdmin {
    public function isAdmin() {
        $auth = Zend_Auth::getInstance();
        return $auth->hasIdentity() && $auth->getIdentity()->getRoleId() == Application_Model_Acl::ROLE_ADMIN;
    }
}
