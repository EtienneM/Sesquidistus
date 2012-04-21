<?php

class Application_Form_Password extends Zend_Form {

    public function init() {
        $this->setMethod('post');
        $this->setAction('/user/editPwd');
        $this->addElement(
                'password', 'new_pwd', array(
            'label' => 'Nouveau mot de passe :',
            'required' => true,
            'class' => 'required',
        ));
        $this->addElement(
                'password', 'confirm_pwd', array(
            'label' => 'Confirmation :',
            'required' => true,
            'class' => 'required',
        ));
        $this->getElement('confirm_pwd')->addValidator(new Zend_Validate_Identical('new_pwd'));
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Valider',
            'class' => 'bouton1',
        ));
        $this->getElement('submit')->removeDecorator('DtDdWrapper');
    }

}

