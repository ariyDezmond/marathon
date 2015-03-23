<?php

/**
 * Description of Pagination
 * Singleton class, which divides pages
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/
class Pagination {
    static private $_instance;
    private $_factory;
    private $_startEnd = array();
    private $_step = 3;
    private $_dealUsers;
    private $_dealPages;
    private $_basis;
    
    private function __construct() 
    {
        $this->_factory = Factory::getInstance();
    }
    
    private function __clone() {}
    
    static public function getInstance()
    {
        if(!self::$_instance instanceof self)
            self::$_instance = new self();
        return self::$_instance;
    }
    
    public function setStep($step)
    {
        $this->_step = $step;
    }
    
    public function count($page,$deal=true)
    {
        //var_dump("wtf");die;
        $model = $this->_factory->getModel('user');
        $this->_startEnd['current'] = $page;
        $this->_dealUsers = $deal==true ? $model->getDeal() : $deal; // number of all users
        $this->_startEnd['dealPages'] = (int) ceil($this->_dealUsers / STEP); // number of pages
        if ($this->_startEnd['step'] > $this->_dealUsers)
            $this->_startEnd['step'] = $this->_dealUsers;
        $this->_startEnd['start'] = ($page-1) * STEP;
        $this->_startEnd['end'] = $this->_start + STEP;
        if ($this->_startEnd['end'] > $this->_dealUsers)
            $this->_startEnd['end'] = $this->_dealUsers;
        return $this->_startEnd;
    }
}
