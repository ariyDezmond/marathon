<?php

/**
 * Description of View
 * This class generate pages
 * 
 * #########################################################
 * @author Markisbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 */

class View {
    private static $_instance;
    private $_body;
    private $_title;
    private $_session;
    
    private function __construct() 
    {
        $this->_session = Session::getInstance();
    }
    
    private function __clone() {}
    
    //(singleton)
    static function getInstance()
    {
        if(!self::$_instance instanceof self)
            self::$_instance = new self;
        
        return self::$_instance;
    }

    public function generate($file){
        ob_start();
        include VIEW.$file.'.html';
        return ob_get_clean();
    }

    public function setBody($body)
    {
        $this->_body = $body;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function getBody()
    {
        return $this->_body;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function add($file)
    {
        include VIEW.$file.'.html';
    }
}
