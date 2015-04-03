<?php

/**
 * Description of Controller
 * Parent class, which is inherited by all controllers
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

abstract class Controller {
    protected  static $_factory;
    protected static $_view;
    protected static $_pagination;
    protected static $_data;
    protected static $_session;
    protected static $_error;
    
    protected function __construct() {
        self::$_factory = Factory::getInstance();
        self::$_view = View::getInstance();
        self::$_pagination = Pagination::getInstance();
        self::$_data = DataStore::getInstance();
        self::$_session = Session::getInstance();
        self::$_error = Error::getInstance();
    }
    
    static function Action404()
    {
        echo "This is 404!";
    }
}
