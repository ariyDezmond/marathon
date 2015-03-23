<?php

/**
 * Description of ControllerSearch
 * Called, when we just entered to the site!
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2015, Markisbek uulu Nursultan
 **/

class ControllerSearch extends Controller{
    
        public function __construct() {
        parent::__construct();
    }
    
    # this method while is empty, in future may to fill this
    static function ActionIndex($data)
    {
        if(empty($_POST)) header("Location: ".SITE."/runner/list");
        $page = $data['page']==null ? 1 : (int) $data['page'];
        $direction = $data['direction']==null ? 'up' : $data['direction'];
        $sort = $data['sort']==null ? 'ID' : $data['sort'];

        // redeterm some variables, which contain reference to some class
        $model = self::$_factory->getModel('user');
        $view = self::$_view;
        $paginator = self::$_pagination;
        
        // data for paginator
        
        $pages['sort'] = $sort;
        $pages['direction'] = $direction;
        
        // getting runners
        $users = $model->getSearch($_POST['search'],$pages['start'],$pages['end'],$sort,$direction);
        /*var_dump($users);*/
        //$pagesDeal = count($users);
        $pages = $paginator->count($page,$pagesDeal);
        //var_dump($pages);
        if(count($users)==0)
        {
            $view->text = "По такому запросу ничего не найдено!";
            $body = $view->generate('msg');
            $view->body = $body; 
        }
        elseif($users == false)
        {
            $view->text = "Ошибка! Проверь БД!";
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
