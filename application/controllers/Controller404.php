<?php

/**
 * Description of Controller404
 * Generates, when page not found!
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

class Controller404 extends Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    static function ActionIndex()
    {
        $view = self::$_view;
        $body = $view->generate('404');
        $view->body = $body;
        $view->header = '404';
        $page = $view->generate('page');
        $view->setBody($page);
    }
}
