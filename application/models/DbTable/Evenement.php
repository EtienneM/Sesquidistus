<?php

class Application_Model_DbTable_Evenement extends Zend_Db_Table_Abstract {
    protected $_name = 'evenement';
    protected $_primary = 'id';
    protected $_sequence = true;
    protected $_referenceMap = array(
        'TypeEvenement' => array(
            'columns' => 'type',
            'refTableClass' => 'Application_Model_DbTable_TypeEvent',
            'refColumns' => 'numero',
        ),
        'LieuUltimate' => array(
            'columns' => 'id_lieu',
            'refTableClass' => 'Application_Model_DbTable_LieuUltimate',
            'refColumns' => 'numero',
        ),
    );

}

