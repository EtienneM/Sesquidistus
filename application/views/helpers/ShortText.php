<?php

/**
 * ShortText permet de limiter la taille d'un text en ajoutant '...' à la fin.
 * 
 * @author emichon
 */
class Zend_View_Helper_ShortText {
    /**
     * 
     * 
     * @param string $text
     * @param int $length
     * @return string
     */
    public function shortText($text, $length) {
        if (strlen($text) > $length) {
            return substr($text, 0, $length).'...';
        }
        return $text;
    }
}
