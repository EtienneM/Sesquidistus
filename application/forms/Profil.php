<?php

class Application_Form_Profil extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        $this->addElement(
                'text', 'login', array(
            'label' => 'Identifiant :',
            'required' => true,
            'readonly' => true,
            'filters' => array('StringTrim'),
            'class' => 'required',
        ));
        $this->addElement(
                'text', 'prenom', array(
            'label' => 'Prénom :',
            'required' => true,
            'filters' => array('StringTrim'),
            'class' => 'required',
        ));
        $this->addElement(
                'text', 'mail', array(
            'label' => 'E-mail :',
            'required' => false,
            'filters' => array('StringTrim'),
            'validators' => array('EmailAddress'),
            'class' => 'email',
        ));
        $year = array();
        // Les années de 1995 à cette année
        for ($i = 1995; $i <= date('Y'); $i++) {
            $year[$i] = $i;
        }
        $this->addElement(
                'select', 'adhesion', array(
            'multiOptions' => $year,
            'label' => 'Joueur depuis :',
            'required' => true,
            'filters' => array('StringTrim'),
            'class' => 'required',
        ));
        $this->addElement(
                'text', 'numero', array(
            'label' => 'Numéro :',
            'filters' => array('StringTrim'),
        ));
        $this->addElement(
                'checkbox', 'ancien', array(
            'label' => 'Ancien joueur :',
            //'filters' => array('StringTrim'),
        ));
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Modifier',
            'class' => 'bouton1',
        ));
        $this->getElement('submit')->removeDecorator('DtDdWrapper');
    }

}

