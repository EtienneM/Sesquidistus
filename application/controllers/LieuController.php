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
        $lieuMapper = new Application_Model_LieuUltimateMapper();
        $nom = $request->getParam('nom');
        $adresse = $request->getParam('adresse');
        $lieu = new Application_Model_LieuUltimate();
        if (!empty($adresse) && !empty($nom)) {
            if (empty($id)) $id = null;
            $lieu->setOptions(array(
                'numero' => $id,
                'nom' => $nom,
                'adresse' => $adresse,
            ));
            $lieuMapper->save($lieu);
            $this->getResponse()->setRedirect('/club/index/id/5');
        }
        $lieuMapper->find($id, $lieu);
        $this->view->lieu = $lieu;
    }
    
    public function supprimerAction() {
        $request = $this->getRequest();
        $lieuMapper = new Application_Model_LieuUltimateMapper();
        if (!is_null($id = $request->getParam('idLieu'))) {
            $lieuMapper->getDbTable()->delete(array('numero = ?' => $id));
            $this->_helper->flashMessenger('Lieu supprimé avec succès');
        }
        $this->getResponse()->setRedirect('/club/index/id/5');
    }
}

