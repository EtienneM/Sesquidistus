<?php

/**
 * To upload a file in Ajax with the fileupload.js plugin.
 *
 * @author emichon
 */
class My_Helper_Fileupload extends Zend_Controller_Action_Helper_Abstract {
    protected $_allowedExtensions = array('image/jpeg');
    protected $_sizeLimit = 5242880; // Max = 5Mo
    protected $_file;
    
    /**
     * Constructor: initialize plugin loader
     *
     * @return void
     */
    public function __construct() {
        $this->_checkServerSettings();
        $request = $this->getRequest();
        if (!is_null($request->getParam('qqfile'))) {
            $this->_file = Zend_Controller_Action_HelperBroker::getStaticHelper('Fileupload_Xhr');
        } elseif (isset($_FILES['qqfile'])) {
            $this->_file = $this->getActionController()->getHelper('My_Helper_Fileupload_Form');
        } else {
            $this->_file = false;
        }
    }

    protected function _checkServerSettings() {
        $postSize = $this->_toBytes(ini_get('post_max_size'));
        $uploadSize = $this->_toBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->_sizeLimit || $uploadSize < $this->_sizeLimit) {
            $size = max(1, $this->_sizeLimit / 1024 / 1024).'Mo';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    protected function _toBytes($str) {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    public function handleUpload($uploadDirectory, $replaceOldFile = false) {
        if (!is_writable($uploadDirectory)) {
            return array('error' => "Server error. Upload directory isn't writable.");
        }

        if (!$this->_file) {
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->_file->getSize();

        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->_sizeLimit) {
            return array('error' => 'File is too large');
        }

        $pathinfo = pathinfo($this->_file->getName());
        $filename = $pathinfo['filename'];
//$filename = md5(uniqid());
        $ext = $pathinfo['extension'];

        if ($this->_allowedExtensions && !in_array(strtolower($ext), $this->_allowedExtensions)) {
            $these = implode(', ', $this->_allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '.$these.'.');
        }

        if (!$replaceOldFile) {
            // don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory.$filename.'.'.$ext)) {
                $filename .= rand(10, 99);
            }
        }

        if ($this->_file->save($uploadDirectory.$filename.'.'.$ext)) {
            return array('success' => true);
        } else {
            return array('error' => 'Could not save uploaded file.'.
                'The upload was cancelled, or server error encountered');
        }
    }
    
    public function direct($uploadDirectory, $replaceOldFile = false) {
        $this->handleUpload($uploadDirectory, $replaceOldFile);
    }

}
