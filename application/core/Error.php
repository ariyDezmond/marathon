<?php

/**
 * Description of Error
 * Singleton class for work with session 
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2015, Markisbek uulu Nursultan
 **/
class Error {
    static private $_instance;
    static private $_text;
    
    private function __construct() {} // close 
    
    private function __clone() {}
    
    static function getInstance()
    {
        if(!self::$_instance instanceof self)
            self::$_instance = new self();
        return self::$_instance;
    }
    
    public function set($value)
    {
        $_SESSION['error'] = $value;
    }
    
    public function get()
    {
        return $_SESSION['error'];
    }
}

