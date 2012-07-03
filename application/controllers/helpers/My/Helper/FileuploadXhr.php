<?php

/**
 * Upload a file via an XML http request
 *
 * @author emichon
 */
class My_Helper_FileuploadXhr extends My_Helper_FileuploadAbstract {

    public function getFileName() {
        return $this->getRequest()->getParam('qqfile');
    }

    public function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

    public function save($path) {
        $input = fopen('php://input', 'r');
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, 'w');
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);

        return true;
    }

}
