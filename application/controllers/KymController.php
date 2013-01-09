<?php

class KymController extends My_Controller_Action_CustomContent {

    public function init() {
        $this->_title = 'Nos évènements';
        $this->_styleSheets = array('/css/club/club.css', '/css/event/event.css');
        parent::init();
    }

    public function indexAction() {
        $this->view->headTitle()->append('Keep Your Moustache');
        $this->view->headScript()->appendFile('/js/category.js')
                ->appendFile('/js/tinymce/jquery.tinymce.js');
        $this->view->headLink()->appendStylesheet('/css/pagination.css')
                ->appendStylesheet('/css/article.css')
                ->appendStylesheet('/css/facebook.css')
                ->appendStylesheet('/css/club/club.css');
        $this->view->controller = 'kym';

        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $kymMapper = new Application_Model_Mapper_Kym();
        $this->view->sections = $kymMapper->fetchAll();
        // Recherche de la section courante
        foreach ($this->view->sections as $section) {
            if ($id == $section->id) {
                $this->view->kym = $section;
                break;
            }
        }

        switch ($id) {
            case 1: // Nouvelles
                $page = $request->getParam('page', 1);
                Zend_View_Helper_PaginationControl::setDefaultViewPartial('_controls.phtml');
                Zend_Paginator::setDefaultScrollingStyle('Sliding');
                $paginator = null;
                $articleMapper = new Application_Model_Mapper_Article();
                $this->view->articles = $articleMapper->findKym($page, $paginator);
                $this->view->paginator = $paginator;
                $albumMapper = new Application_Model_Mapper_Album();
                if (count($albums = $albumMapper->findKym()) > 0) {
                    $this->view->album = $albums[0];
                    foreach ($albums as $album) {
                        $image = $album->getFirstImage();
                        if (!is_null($image)) {
                            $this->view->album = $album;
                            break;
                        }
                    }
                }
                break;
            case 2: // Infos pratiques
                $this->view->headScript()
                        ->appendFile('http://maps.google.com/maps/api/js?sensor=false')
                        ->appendFile('/js/jquery/gmap3.min.js')
                        ->appendFile('/js/lieux_admin.js');
                $lieuxMapper = new Application_Model_Mapper_LieuUltimate();
                $lieu = $lieuxMapper->fetchKYM();
                if (empty($lieu)) {
                    $this->view->lieu = array();
                } else {
                    $this->view->lieu = array($lieu);
                }
                break;
            default:
        }
    }

    public function ajouterAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $kymMapper = new Application_Model_Mapper_Kym();
        // Enregistrement du nouveau contenu s'il est présent
        if (!is_null($title = $request->getParam('addTitle'))) {
            $kym = new Application_Model_Kym(array(
                'titre' => $title,
                'contenu' => ''));
            $kymMapper->save($kym);
            $this->_helper->flashMessenger('Catégorie ajoutée avec succès');
        }
        $this->_redirect('/kym/index/id/' . $id);
    }

    public function supprimerAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $kymMapper = new Application_Model_Mapper_Kym();
        if (!is_null($idDelCat = $request->getParam('delCat'))) {
            $kymMapper->getDbTable()->delete(array('id = ?' => $idDelCat));
            $this->_helper->flashMessenger('Catégorie supprimée avec succès');
            if ($id == $idDelCat) {
                $id = 1;
            }
        }
        $this->_redirect('/kym/index/id/' . $id);
    }

    public function modifierAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);
        $kymMapper = new Application_Model_Mapper_Kym();
        // Enregistrement du nouveau contenu s'il est présent
        if (!is_null($content = $request->getParam('content')) && !is_null($title = $request->getParam('title'))) {
            $kym = new Application_Model_Kym(array(
                'id' => $id,
                'titre' => $title,
                'contenu' => $content,
                    ));
            $kymMapper->save($kym);
            $this->_helper->flashMessenger('Modification du contenu réussi');
        }
        $this->_redirect('/kym/index/id/' . $id);
    }

}

