<?php

/**
 * Description of ControllerIndex
 * Called, when we just entered to the site!
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2015, Markisbek uulu Nursultan
 **/

class ControllerIndex extends Controller{
    
        public function __construct() {
        parent::__construct();
    }
    
    # this method while is empty, in future may to fill this
    static function ActionIndex($data)
    {
        $view = self::$_view;
        $model = self::$_factory->getModel('user');
        $sql = "DROP TABLE IF EXISTS `country`; CREATE TABLE IF NOT EXISTS `country` (`ID` int(11) NOT NULL AUTO_INCREMENT,`cValue` varchar(255) NOT NULL,PRIMARY KEY (`ID`) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;";
        $model->query($sql);
        $view->title = "Welcome to Marathon";
        $body = $view->generate('index');
        $view->body = $body;
        $view->header = 'Registration';
        $page = $view->generate('page');
        $view->setBody($page);
    }
}
