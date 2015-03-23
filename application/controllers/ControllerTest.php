<?php

/**
 * Description of ControllerIndex
 * Called, when we just entered to the site!
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

class ControllerTest extends Controller{
    
        public function __construct() {
        parent::__construct();
    }
    
    # this method while is empty, in future may to fill this
    static function ActionIndex($data)
    {
        $model = self::$_factory->getModel("user");
        echo $model->getCountries();
    }
}
