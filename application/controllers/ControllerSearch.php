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

    static function ActionIndex($data)
    {
        // empty
    }
    
    # this method while is empty, in future may to fill this
    static function ActionList($data)
    {
        $session = self::$_session;
        if(!empty($_POST))
        {
            $session->set('search',$_POST['search']);
        } 
        $page = $data['page']==null ? 1 : (int) $data['page'];
        $direction = $data['direction']==null ? 'up' : $data['direction'];
        $sort = $data['sort']==null ? 'ID' : $data['sort'];
        $search = $session->get('search');

        // redeterm some variables, which contain reference to some class
        $model = self::$_factory->getModel('user');
        $view = self::$_view;
        $paginator = self::$_pagination;
        
        // data for paginator
        
        $pagesDeal = $model->getDealSearch($search);
        $pages = $paginator->count($page,$pagesDeal);
        $pages['sort'] = $sort;
        $pages['direction'] = $direction;
        
        $view->module = 'search';

        // getting runners
        $users = $model->getSearch($search,$pages['start'],$pages['end'],$sort,$direction);
        $pagesDeal = count($users);
        
        //var_dump($pages);
        if(count($users)==0)
        {
            $session->set('status_id',2);
            $session->set('status_text','По такому запросу ничего не найдено!');
            $body = $view->generate('msg');
            $view->body = $body; 
        }
        elseif($users == false)
        {
            $session->set('status_id',3);
            $session->set('status_text','Ошибка!');
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
