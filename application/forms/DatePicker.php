<?php

/**
 * Description of Application_Form_DatePicker
 *
 * @author emichon
 */
class Application_Form_DatePicker extends Zend_Form {

    public function init() {
        $this->setMethod('get');
        $months = array();
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = $i;
        }
        $this->addElement('select', 'mois', array(
            'multiOptions' => $months,
            'required' => true,
        ));
        $years = array();
        $currentYear = date('Y');
        for ($i = $currentYear - 2; $i <= $currentYear + 1; $i++) {
            $years[$i] = $i;
        }
        $this->addElement('select', 'annee', array(
            'multiOptions' => $years,
            'required' => true,
        ));
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Valider',
        ));

        foreach ($this->getElements() as $element) {
            $decorator = $element->getDecorator('label');
            if (is_object($decorator)) {
                $decorator->setOption('tag', null);
            }
            $decorator = $element->getDecorator('HtmlTag');
            if (is_object($decorator)) {
                $decorator->setOption('tag', null);
            }
        }
        //$this->getElement('submit')->setName('');
    }

}
