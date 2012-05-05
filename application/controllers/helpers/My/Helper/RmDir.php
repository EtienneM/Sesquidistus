<?php

/**
 * Helper to delete a directory and its files
 *
 * @author emichon
 */
class My_Helper_RmDir extends Zend_Controller_Action_Helper_Abstract {

    protected function rm($file) {
        if (file_exists($file)) {
            if (is_dir($file)) {
                $idDir = opendir($file);
                while ($element = readdir($idDir)) {
                    if ($element != "." && $element != "..") {
                        $this->rm($file."/".$element);
                    }
                }
                closedir($idDir);
                rmdir($file);
            } else {
                unlink($file);
            }
        }
    }

    public function direct($file) {
        return $this->rm($file);
    }

}
