<?php

/**
 * This filter remove every accentuated letter and space in a string
 *
 * @author emichon
 */
class My_Filter_Accent implements Zend_Filter_Interface {
    protected static $_table = array(
        'a' => 'grave|acute|circ|tilde|uml|ring',
        'ae' => 'lig',
        'c' => 'cedil',
        'e' => 'grave|acute|circ|uml',
        'i' => 'grave|acute|circ|uml',
        'n' => 'tilde',
        'o' => 'grave|acute|circ|tilde|uml|slash',
        's' => 'zlig', // maybe szlig=>ss would be more accurate?
        'u' => 'grave|acute|circ|uml',
        'y' => 'acute'
    );

    /**
     * 
     * @var \Zend_Filter_PregReplace
     */
    protected $_pregreplaceFilters = array();

    public function __construct() {
        foreach (self::$_table as $k => $v) {
            $this->_pregreplaceFilters[] = new Zend_Filter_PregReplace(array(
                        'match' => "/&($k)($v);/i",
                        'replace' => '\1',
                    ));
        }
        $this->_pregreplaceFilters[] = new Zend_Filter_PregReplace(array(
                    'match' => '@[ ]@i',
                    'replace' => '-',
                ));
    }

    public function filter($value) {
        // This is mandatory as preg_replace doesn't handle well with UTF-8 accentuated char
        $res = htmlentities($value, ENT_NOQUOTES, 'utf-8');
        foreach ($this->_pregreplaceFilters as $filter) {
            $res = $filter->filter($res);
        }
        return $res;
    }

}
