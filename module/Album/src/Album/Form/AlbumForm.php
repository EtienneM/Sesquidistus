<?php
namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form {
	public function __construct($name = null) {
		parent::__construct('album');
		$this->setAttribute('method', 'post');
		$this->add(array(
			'name' => 'id',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'nom',
			'type' => 'Text',
			'options' => array(
				'label' => 'Nom',
			),
		));
		$this->add(array(
			'name' => 'date',
			'type' => 'Date',
			'options' => array(
				'label' => 'Date',
			),
		));
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Go',
				'id' => 'submitbutton'
			),
		));
	}
}

