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
        ));
        $this->addElement(
                'text', 'prenom', array(
            'label' => 'Prénom :',
            'required' => true,
            'filters' => array('StringTrim'),
        ));
        $this->addElement(
                'text', 'mail', array(
            'label' => 'E-mail :',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('EmailAddress'),
        ));
        $year = array();
        for ($i = 1995; $i <= date('Y'); $i++) {
            $year[$i] = $i;
        }
        $this->addElement(
                'select', 'adhesion', array(
            'multiOptions' => $year,
            'label' => 'Membre depuis :',
            'required' => true,
            'filters' => array('StringTrim'),
        ));
        $this->addElement(
                'text', 'numero', array(
            'label' => 'Numéro :',
            'filters' => array('StringTrim'),
        ));
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Modifier',
            'class' => 'bouton1',
        ));
        $this->getElement('submit')->removeDecorator('DtDdWrapper');
    }

}

