<?php 
/**
 * Classe utilisé pour les pages avec un menu à gauche qui définit des sections
 * et un corps contenu dans la BDD. C'est le cas par exemple des pages Club et Ultimate.
 *
 * Il faut penser dans les classes qui hérite de celle-ci à définir dans la méthode init
 * les trois paramètres de la classe.
 */
abstract class My_Controller_Action_CustomContent extends Zend_Controller_Action {
    protected $_title = '';
    protected $_styleSheets = array();
    protected $_sections = array();

    public function init() {
        $this->view->headTitle()->append($this->_title);
        foreach($this->_styleSheets as $stylesheet) {
            $this->view->headLink()->appendStylesheet($stylesheet);
        }
        $this->view->sections = $this->_sections;
        $this->view->controller = $this->getRequest()->getControllerName();
    }
}

