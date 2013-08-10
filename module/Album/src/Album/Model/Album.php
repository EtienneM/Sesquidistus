<?php
namespace Album\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Album implements InputFilterAwareInterface {
	public $id;
	public $nom;
	public $date;

	protected $inputFilter;

	public function exchangeArray($data) {
		foreach (array('id', 'nom', 'date') as $value) {
			$this->$value = (!empty($data[$value])) ? $data[$value] : null;;
		}
	}
	public function getArrayCopy() {
		return get_object_vars($this);
	}

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();
			$inputFilter->add($factory->createInput(array(
					'name' => 'id',
					'required' => true,
					'filters' => array(
							array('name' => 'Int'),
					),
			)));
			$inputFilter->add($factory->createInput(array(
					'name' => 'nom',
					'required' => true,
					'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name' => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 30,
									),
							),
					),
			)));
			

			$this->inputFilter = $inputFilter;
		}
		return $this->inputFilter;
	}
}
