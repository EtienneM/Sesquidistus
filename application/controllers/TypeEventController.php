<?php

class TypeEventController extends Zend_Controller_Action {

    public function preDispatch() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function supprimerAction() {
        $id = $this->getRequest()->getParam('id');
        if (empty($id)) {
            return;
        }
        $typeEventMapper = new Application_Model_Mapper_TypeEvent();
        $typeEvent = new Application_Model_TypeEvent();
        $typeEventMapper->find($id, $typeEvent);
        $typeEventMapper->delete($typeEvent);
        $this->_helper->flashMessenger('Suppression du type d\'évènement réussi');
        $this->_redirect('/calendrier/editer');
    }

    public function updateAction() {
        $request = $this->getRequest();
        $id = $request->getParam('idType_event');
        $typeEventMapper = new Application_Model_Mapper_TypeEvent();
        if (empty($id)) {
            // Add 
            $typeEvent = new Application_Model_TypeEvent();
        } else {
            // Update
            $typeEvent = new Application_Model_TypeEvent(array(
                'id' => $id,
            ));
        }
        $nom = $request->getParam('type_nom');
        $couleur = $request->getParam('color');
        $typeEvent->setColor($couleur)->setNom($nom);
        $typeEventMapper->save($typeEvent);
        $this->_helper->flashMessenger('Ajout du type d\'évènement réussi');
        $this->_redirect('/calendrier/editer');
    }

}

