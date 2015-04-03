<?php

/**
 * Description of ControllerUser
 * Called, when we pass authorization
 * contain adding, deleting, showing info, showing all users functions
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2015, Markisbek uulu Nursultan
 **/

class ControllerRunner extends Controller{

    static $direction;
    static $sortName;
    
    public function __construct() {
        parent::__construct();
    }
    
    # this method while is empty, in future may to fill this
    static function ActionIndex()
    {
        // empty
    }
    
    # showing info about user
    static function ActionCountry($data)
    {
        $model = self::$_factory->getModel("user");
        echo $model->getCountries();
    }

    static function ActionDistance($data)
    {
        $model = self::$_factory->getModel("user");
        echo $model->getDistances();
    }
    
    // action of editing
    static function ActionEdit($data)
    {
        //
    }
    # showing all users
    static function ActionList($data)
    {
        // default values
        $page = $data['page']==null ? 1 : (int) $data['page'];
        $direction = $data['direction']==null ? 'up' : $data['direction'];
        $sort = $data['sort']==null ? 'ID' : $data['sort'];

        // redeterm some variables, which contain reference to some class
        $model = self::$_factory->getModel('user');
        $view = self::$_view;
        $paginator = self::$_pagination;
        $session = self::$_session;
        
        // data for paginator
        $pages = $paginator->count($page);
        $pages['sort'] = $sort;
        $pages['direction'] = $direction;

        $view->module = 'runner';
        
        // getting runners
        $users = $model->getUsers($pages['start'],$pages['end'],$sort,$direction);
        /*var_dump($users);*/
        if(count($users)==0)
        {
            $session->set('status_id',2);
            $session->set('status_title','Внимание!');
            $session->set('status_text','Пустой список участноков!');
            $body = $view->generate('msg');
            $view->body = $body; 
        }
        elseif(!$users)
        {
            $session->set('status_id',3);
            $session->set('status_title','Ошибка!');
            $session->set('status_text',self::$_error->get());
            $body = $view->generate('msg');
            $view->body = $body; 
        }
        else
        {
            $view->direction = $model->getDirection($sort,$direction);
            $view->list = $users;
            $view->pages = $pages;
            $body = $view->generate('users');
            $view->body = $body;
            $view->header = 'List';
        }

        
        $view->setTitle("List of runners");
        $page = $view->generate('page');
        $view->setBody($page);
    }
}
