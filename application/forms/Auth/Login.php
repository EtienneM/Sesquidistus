<?php

class Application_Form_Auth_Login extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        $this->addElement(
                'text', 'login', array(
            'label' => 'Identifiant :',
            'required' => true,
            'filters' => array('StringTrim'),
            'class' => 'txtBox1',
        ));
        $this->addElement('password', 'passwd', array(
            'label' => 'Mot de passe :',
            'required' => true,
            'class' => 'txtBox1',
        ));
        // $this->addElement('submit', 'submit', array(
        $this->addElement('button', 'submit', array(
            'ignore' => true,
            'label' => 'Se connecter',
            'class' => 'bouton1',
        ));
        $this->addElement('reset', 'reset', array(
            'ignore' => true,
            'label' => 'Remettre à zéro',
            'class' => 'bouton1',
        ));
    }

}

