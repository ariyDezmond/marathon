<?php

/**
 * Description of ModelDB
 * Singleton class, which makes functions connected with dataBase
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

class DB {
    public $host;
    public $user;
    public $password;
    public $db;
    public $link;
    public $resource;
    private static $_instance;
    
    private function __construct() 
    {
        $this->connect();
        $this->query("SET NAMES utf8");
    }
    
    public static function getInstance()
    {
        if(!self::$_instance instanceof self)
            self::$_instance = new self();
        return self::$_instance;
    }
    
    private function connect()
    {
        $this->link = mysqli_connect(HOST,USER,PASSWORD,DBase) or die("Can't connect to DB");
    }
    
    public function query($query)
    {
        $this->resource = mysqli_query($this->link,$query);
        return $this->resource;
    }
    
    public function toArray($res='',$deal=0,$type=MYSQLI_ASSOC)
    {
        $resource = $res=='' ? $this->resource : $res;
        $i=0;
        if($deal!=0)
            while($result = mysqli_fetch_array($resource,$type))
            {
                $finRes[$i] = $result;
                $i++;
            }
        else
            $finRes = mysqli_fetch_array($resource,$type);
        return $finRes;
    }
    
    public function getArray($query,$deal=0)
    {
        $res = $this->query($query);
        return $res==false ? $res : $this->toArray($res,$deal);
    }
    /*public function prepare($sql,$string,$user)
    {
        var_dump($user);
        if(!$stmt = mysqli_prepare($this->link,$sql))
            return false;
        if(!mysqli_stmt_bind_param($stmt,$string,$user['login'],$user['password'],$user['name'],$user['surname'],$user['gender'],$user['birthday']))
            return false;
        if(!mysqli_stmt_execute($stmt))
            return false;
        if(mysqli_stmt_affected_rows($stmt)==1)
            return true;
        else
            return false;
        mysqli_stmt_close($stmt);
    }*/
    
    #other implementation of function prepare
    public function prepare($sql,$string,$user)
    {
        if(!$stmt = mysqli_prepare($this->link,$sql))
            return false;
        if(!mysqli_stmt_bind_param($stmt,$string,$user['name'],
                                                 $user['surname'],
                                                 $user['bDate'],
                                                 $user['email'],
                                                 $user['tel'],
                                                 $user['country'],
                                                 $user['distance'],
                                                 $user['gender'],
                                                 $user['runner_id'],
                                                 $user['tag']
                                    )
            )
            return false;
        if(!mysqli_stmt_execute($stmt))
            return false;
        if(mysqli_stmt_affected_rows($stmt)==1)
            return true;
        else
            return false;
        mysqli_stmt_close($stmt);
    }

}
