<?php

class Application_Model_DbTable_Video extends Zend_Db_Table_Abstract {
    protected $_name = 'videos';
    protected $_primary = 'id';
    protected $_sequence = true;
    protected $_referenceMap = array(
        'Album' => array(
            'columns' => 'id_album',
            'refTableClass' => 'Application_Model_DbTable_Album',
            'refColumns' => 'id',
        ),
    );

}

