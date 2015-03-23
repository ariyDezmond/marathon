<?php

/**
 * Description of ControllerIndex
 * 
 * 
 * 
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

class Route {
    static function start()
    {
        $url = $_SERVER["REQUEST_URI"]; 
        
        $arrayUrl = explode("/", $url); 
        // 
        $controller = !empty($arrayUrl[1]) ? strtolower($arrayUrl[1]) : "Index"; 
        // 
        $action = !empty($arrayUrl[2]) ? strtolower($arrayUrl[2]) : "Index";
        
        //
        if(!empty($arrayUrl[3]))
        {
            $params=$keys=$values=array();
            for($i=3;$i<count($arrayUrl);$i++)
            {
                if($i%2!=0)
                    $keys[]=$arrayUrl[$i];
                else
                    $values[]=$arrayUrl[$i];
            }
            $params=  array_combine($keys, $values);
        }
        
        /*
         * 
         */
        $controller="Controller".ucfirst($controller);
        $action="Action".ucfirst($action);
        
        /*
         * 
         * 
         * 
         */
        if(file_exists(CONTROLLER.$controller.".php"))
            if(method_exists ($controller, $action))
            {
                new $controller();
                $controller::$action($params);
            }
            else
                header("Location: 404");
        else
            header("Location: 404");
           
    }
}