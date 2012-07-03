<?php

/**
 * To upload a file in Ajax with the fileupload.js plugin.
 *
 * @author emichon
 */
abstract class My_Helper_FileuploadAbstract extends Zend_Controller_Action_Helper_Abstract {
    protected $_allowedExtensions;
    protected $_sizeLimit;
    protected $_file;

    /**
     * Save the file in the given path 
     * 
     * @param string $path
     * @return bool True if the file was correctly saved. False otherwise.
     */
    abstract public function save($path);

    /**
     * @return string Name of the file 
     */
    abstract public function getFileName();

    /**
     * @return int Size of the file in bytes 
     */
    abstract public function getSize();
    
}
