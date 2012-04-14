<?php

/**
 * Description of Auth
 *
 * @author emichon
 */
class My_Auth extends Zend_Controller_Plugin_Abstract {
    /**
     *
     * @var Application_Model_User
     */
    private $_identity;

    /**
     * The acl object
     * 
     * @var \Zend_Acl
     */
    private $_acl;

    /**
     * The page to direct to if there is a current
     * user but they do not have permission to access
     * the resource.
     *
     * @var array
     */
    private $_noacl = array('controller' => 'error',
        'action' => 'no-auth');

    /**
     * the page to direct to if there is not current user
     *
     * @var array
     */
    private $_noauth = array('controller' => 'auth',
        'action' => 'login');

    /**
     * validate the current user's request
     * 
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $this->_identity = Bootstrap::getCurrentUser();
        $this->_acl = Application_Model_Acl::getInstance();

        if (!empty($this->_identity)) {
            $role = $this->_identity->getRoleId();
        } else {
            $role = null;
        }

        $controller = $request->controller;
        $module = $request->module;
        $action = $request->action;
        // TODO vérifier ici les autorisations
        //go from more specific to less specific
        /*$moduleLevel = 'mvc:'.$module;
        $controllerLevel = $moduleLevel.'.'.$controller;
        $privelege = $action;


        if ($this->_acl->has($controllerLevel)) {
            $resource = $controllerLevel;
        } else {
            $resource = $moduleLevel;
        }

        if ($module != 'default' && $controller != 'index') {
            if ($this->_acl->has($resource) && !$this->_acl->isAllowed($role, $resource, $privelege)) {
                if (!$this->_identity) {
                    $request->setModuleName($this->_noauth['module']);
                    $request->setControllerName($this->_noauth['controller']);
                    $request->setActionName($this->_noauth['action']);
                    //$request->setParam('authPage', 'login');
                } else {
                    $request->setModuleName($this->_noacl['module']);
                    $request->setControllerName($this->_noacl['controller']);
                    $request->setActionName($this->_noacl['action']);
                    //$request->setParam('authPage', 'noauth');
                }
                throw new Exception('Access denied. '.$resource.'::'.$role);
            }
        }*/
    }

}
