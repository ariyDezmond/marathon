<?php

/**
 * Description of Model
 * The basis class, which is inherited by all Models
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

abstract class Model {
    protected $_db;
    
    protected function __construct()
    {
        $this->_db = DB::getInstance();
    }
    
    public function hashCode($password)
    {
	for($i=0;$i<10;$i++)
            $password = sha1($password);
	return $password;
    }
    
    protected  function checkInput($array)
    {
        if(is_array($array))
            foreach($array as &$value)
                $value = mysqli_real_escape_string($this->_db->link, trim(strip_tags($value)));
        else
            $array = mysqli_real_escape_string($this->_db->link, trim(strip_tags($array)));
        return $array;
    }
}