<?php 
/**
*
*
* @description of ControllerSave
* @author Markisbek uulu Nursultan
* @copyright (c) 2015, Markisbek uulu Nursultan
**/

# This name of class is part of url afer name of site, e.g. http://mysite/controller
class ControllerSave extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    # This method is part of url after controller, e.g. http://mysite/controller/action
    static function ActionIndex($data)
    {
        sleep(2);
        if(empty($_POST)) echo "No data recieved!";
        $model=self::$_factory->getModel("user");
        $result = $model->add($_POST);
        if($result) echo 1;
        else  echo 0;
    }

    static function ActionEdit($data)
    {
        sleep(1);
        if(empty($_POST)) echo "No data recieved!";
        $model=self::$_factory->getModel("user");
        $result = $model->edit($_POST);
        echo $result;
    }
}