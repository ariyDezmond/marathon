<?php

/**
 * Description of Session
 * Singleton class for work with session 
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2015, Markisbek uulu Nursultan
 **/
class Session {
    static private $_instance;
    
    private function __construct() {} // close 
    
    private function __clone() {}
    
    static function getInstance()
    {
        if(!self::$_instance instanceof self)
            self::$_instance = new self();
        return self::$_instance;
    }
    
    public function check($key)
    {
        return $_SESSION[$key] == null ? false : true;
    }
    
    public function set($key,$value)
    {
        if($this->check($key))
            unset($_SESSION[$key]);
        $_SESSION[$key] = $value;
    }
    
    public function get($key)
    {
        return $_SESSION[$key];
    }
}

