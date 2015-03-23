<?php

/**
 * Description of ModelFactory
 * Singleton class, which execute Factory pattern functions
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

class Factory
{
    static private $_instance;

    private function __construct(){}

    static function getInstance()
    {
        if(!self::$_instance instanceof self)
            self::$_instance = new self;
        return self::$_instance;
    }

    public function getModel($model)
    {
        $model = 'Model'.ucfirst($model);
        return new $model();
    }
}
