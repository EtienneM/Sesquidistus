<?php

class UltimateController extends Zend_Controller_Action
{

    public function init() {
        $this->view->headTitle()->append('L\'utlimate');
        $this->view->headLink()->appendStylesheet('/css/club/club.css');
        $this->view->sections = array('toto', 'tmp');
    }

    public function indexAction() {
    }
}

