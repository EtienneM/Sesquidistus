<?php

class KymController extends My_Controller_Action_CustomContent {

    public function init() {
        $this->_title = 'Keep Your Moustache';
        $this->_styleSheets = array('/css/club/club.css', '/css/event/event.css');
        parent::init();
    }

    public function indexAction() {
        $this->view->headScript()->appendFile('/js/category.js')
                ->appendFile('/js/tinymce/jquery.tinymce.min.js')
                ->appendFile('/js/jquery/jquery.TimeCircles.js');
        $this->view->headLink()->appendStylesheet('/css/pagination.css')
                ->appendStylesheet('/css/article.css')
                ->appendStylesheet('/css/social.css')
                ->appendStylesheet('/css/jquery.TimeCircles.css');
        $this->view->controller = 'kym';
        $this->view->ad = '/images/anniversaire/bandeau-KYM.png';

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

    public function diaporamaAction() {
        $request = $this->getRequest();
        $kymMapper = new Application_Model_Mapper_Kym();
        $this->view->sections = $kymMapper->fetchAll();
        if (!is_null($url = $request->getParam('url'))) {
            $proxy = new My_Helper_Slideshow_Proxy();
            $this->view->embeddedCode = $proxy->getEmbeddedCode($url, $request->getParam('height'), $request->getParam('width'));
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

    public function addpickupAction() {
        $request = $this->getRequest();
        $id = $request->getParam('id', 1);

        $body = '';
        $first_name = $request->getParam('txtFirstName');
        if (empty($first_name)) {
            throw new Zend_Exception("First name must be set");
        }
        $body .= "First Name: $first_name\n";
        $last_name = $request->getParam('txtLastName');
        if (empty($last_name)) {
            throw new Zend_Exception("Last name must be set");
        }
        $body .= "Last Name: $last_name\n";
        $email = $request->getParam('txtEmail');
        if (empty($email)) {
            throw new Zend_Exception("E-mail must be set");
        }
        $body .= "E-mail: $email\n";
        $gender = $request->getParam('sltGender');
        if (empty($gender)) {
            throw new Zend_Exception("Gender must be set");
        }
        if ($gender !== 'Male' && $gender !== 'Female') {
            throw new Zend_Exception("Invalid value for the gender. Must be Male or Female.");
        }
        $body .= "Gender: $gender\n";
        $level = $request->getParam('rdLevel');
        if ($level !== 'beginner' && $level !== 'intermediate' && $level !== 'advanced' && $level !== 'pro') {
            throw new Zend_Exception("Invalid value for the level.");
        }
        $body .= "Level: $level\n";


        /*
         * Send an e-mail 
         */
        $mail = new Zend_Mail();
        $mail->setBodyText($body)
            ->setFrom('webmaster@frisbee-strasbourg.net', 'Site web Sesquidistus')
            ->addTo('titizebioutifoul@free.fr', 'Pickup administrator')
            ->setSubject("Nouveau joueur pickup: $first_name $last_name")
            ->send();

        $this->_redirect('/kym/index/id/' . $id);
    }

}

