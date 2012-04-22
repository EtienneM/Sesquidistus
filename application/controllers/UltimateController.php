<?php

class UltimateController extends My_Controller_Action_CustomContent {

    public function init() {
        parent::init();
        $this->_titre = 'L\'utlimate';
        $this->view->headLink()->appendStylesheet('/css/club/club.css');
    }

    public function indexAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        if (!isset($id)) {
            $id = 1;
        }
        $ultimateMapper = new Application_Model_UltimateMapper();
        $this->view->sections = $ultimateMapper->fetchAll();
        foreach ($this->view->sections as $section) {
            if ($id == $section->id) {
                $this->view->ultimate = $section;
                break;
            }
        }
    }
}

