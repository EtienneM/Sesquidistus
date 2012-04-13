<?php

/**
 * This class represent an element of a table
 *
 * @author emichon
 */
abstract class My_Model implements ArrayAccess {

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set'.$name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid property');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get'.$name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    //TODO Faire une méthode toArray() cf Application_Model_EvenementMapper l. 14
    
    
    public function offsetSet($offset, $value) {
        throw new BadMethodCallException("Not supported yet.");
    }
    public function offsetExists($offset) {
        
        throw new BadMethodCallException("Not supported yet.");
    }
    public function offsetUnset($offset) {
        throw new BadMethodCallException("Not supported yet.");
    }
    public function offsetGet($offset) {
        throw new BadMethodCallException("Not supported yet.");
    }

}
