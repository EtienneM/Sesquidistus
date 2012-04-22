<?php

class ClubController extends My_Controller_Action_CustomContent {

    public function init() {
        parent::init();
        $this->_titre = 'Le club';
        $this->view->headLink()->appendStylesheet('/css/club/club.css');
    }

    public function indexAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        if (!isset($id)) {
            $id = 1;
        } else if ($id == 5) {
            $this->view->headScript()
                    ->appendFile('http://maps.google.com/maps/api/js?sensor=false')
                    ->appendFile('/js/entrainement.js');
        }
        $clubMapper = new Application_Model_ClubMapper();
        $this->view->sections = $clubMapper->fetchAll();
        foreach ($this->view->sections as $section) {
            if ($id == $section->id) {
                $this->view->club = $section;
                break;
            }
        }
    }

}

