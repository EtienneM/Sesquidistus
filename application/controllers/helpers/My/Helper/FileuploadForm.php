<?php

/**
 * Upload a file via a classic form
 *
 * @author emichon
 */
class My_Helper_Fileupload_Form extends My_Helper_Fileupload_Abstract {

    public function getFileName() {
        return $_FILES['qqfile']['name'];
    }

    public function getSize() {
        return $_FILES['qqfile']['size'];
    }

    public function save($path) {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        return true;
    }

}
