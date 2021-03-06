<?php

class ErrorController extends Zend_Controller_Action {
    public function init() {
        parent::init();
        $this->_titre = 'Erreur';
    }

    public function errorAction() {
        $errors = $this->_getParam('error_handler');

        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = 'Vous êtes sur la page d\'erreur';
            return;
        }

        switch($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            case My_Exception::EXCEPTION_NO_RESOURCE:
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $priority = Zend_Log::NOTICE;
                $this->view->message = 'Cette page n\'existe pas';
                break;
            case My_Exception::EXCEPTION_NO_ACL:
                $this->getResponse()->setHttpResponseCode(403);
                $priority = Zend_Log::NOTICE;
                $this->view->message = 'Vous n\'avez pas les droits pour accéder à cette page';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $priority = Zend_Log::CRIT;
                $this->view->message = 'Erreur de l\'application';
                break;
        }

        // Log exception, if logger available
        if (($log = $this->getLog())) {
            $log->log($this->view->message, $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }

        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        $this->view->request = $errors->request;
    }

    public function getLog() {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

}

