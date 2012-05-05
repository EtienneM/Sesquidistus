<?php

/**
 * This helper test if the current user belong to the given role.
 * 
 * @author emichon
 */
class Zend_View_Helper_IsRole {
    public function isRole($role) {
        $auth = Zend_Auth::getInstance();
        return $auth->hasIdentity() && $auth->getIdentity()->getRoleId() == $role;
    }
}
