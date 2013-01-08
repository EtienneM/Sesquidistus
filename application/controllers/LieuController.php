<?php

class LieuController extends Zend_Controller_Action {

    public function init() {
        $this->view->headTitle()->append("Lieux d'entraînement");
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('modifier', 'html')->initContext();
    }

    /**
     * Modifier ou créer un lieu 
     */
    public function modifierAction() {
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $this->_helper->layout->disableLayout();
        }
        $id = $request->getParam('idLieu');
        $lieuMapper = new Application_Model_Mapper_LieuUltimate();
        $nom = $request->getParam('nom');
        $adresse = $request->getParam('adresse');
        $lieu = new Application_Model_LieuUltimate();
        if (!empty($adresse) && !empty($nom)) {
            if (empty($id)) $id = null;
            $lieu->setOptions(array(
                'id' => $id,
                'nom' => $nom,
                'adresse' => $adresse,
            ));
            $lieuMapper->save($lieu);
            $this->_helper->flashMessenger('Modification du lieu réussi');
            $this->_redirect('/');
        }
        $lieuMapper->find($id, $lieu);
        $this->view->lieu = $lieu;
    }
    
    public function supprimerAction() {
        $request = $this->getRequest();
        $lieuMapper = new Application_Model_Mapper_LieuUltimate();
        if (!is_null($id = $request->getParam('idLieu'))) {
            $lieuMapper->getDbTable()->delete(array('id = ?' => $id));
            $this->_helper->flashMessenger('Lieu supprimé avec succès');
        }
        $this->_redirect('/club/index/id/5');
    }
}

