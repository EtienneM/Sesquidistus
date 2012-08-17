<?php

/**
 * http://stackoverflow.com/a/2047320
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
        try {
            $this->_preDispatch($request);
        } catch(Exception $e) {
            // Repoint the request to the default error handler
            $request->setModuleName('default');
            $request->setControllerName('error');
            $request->setActionName('error');
            $error = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
            switch(get_class($e)) {
                case 'Exception_NoResource':
                    $error->type = My_Exception::EXCEPTION_NO_RESOURCE;
                    break;
                case 'Exception_NoAcl':
                    $error->type = My_Exception::EXCEPTION_NO_ACL;
                    break;
                default:
                    $error->type = Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER;
                    break;
            }
            // Set up the error handler
            $error->request = clone($request);
            $error->exception = $e;
            $request->setParam('error_handler', $error);
        }
    }

    private function _preDispatch(Zend_Controller_Request_Abstract $request) {
        $this->_identity = $auth = Zend_Auth::getInstance()->getIdentity();
        $this->_acl = Application_Model_Acl::getInstance();

        if (!empty($this->_identity)) {
            $role = $this->_identity->getRoleId();
        } else {
            $role = null;
        }

        $controller = $request->controller;
        //$module = $request->module;
        $action = $request->action;
        //go from more specific to less specific
        //$moduleLevel = 'mvc:'.$module;
        $controllerLevel = $controller;
        $privelege = $action;

        $resource = $controllerLevel;
        if (!$this->_acl->has($resource)) {
            throw new Exception_NoResource('Aucun accès à cette ressource.');
        }

        if (!$this->_acl->isAllowed($role, $resource, $privelege)) {
            // S'il s'agit d'un simple visiteur, on l'envoie sur la page de login
            if (!$this->_identity
                    || $role == Application_Model_Acl::ROLE_VISITEUR) {
                //$request->setModuleName($this->_noauth['module']);
                $request->setControllerName($this->_noauth['controller']);
                $request->setActionName($this->_noauth['action']);
                return;
            }
            // Sinon, l'utilisateur loggé n'a pas les droits => erreur
            throw new Exception_NoAcl("Votre niveau de droit : '$role'");
        }
    }

}

class Exception_NoResource extends Exception {
    
}

class Exception_NoAcl extends Exception {
    
}
