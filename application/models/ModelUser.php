<?php

/**
 * Description of ModelAddUser
 * Contain methods for work with users
 * 
 * ########################################################
 * @author Marksbek uulu Nursultan <ariy.markson@gmail.com>
 * @copyright (c) 2014, Markisbek uulu Nursultan
 **/

class ModelUser extends Model{
    
    public function __construct() {
        parent::__construct();
    }

    public function getDistanceID($id)
    {
        $sql = "SELECT counter FROM distance WHERE ID={$id}";
        $this->_db->query($sql);
        $data = $this->_db->toArray();
        return ++$data['counter'];
    }

    public function incrDistID($id,$counter)
    {
        $sql = "UPDATE distance SET counter={$counter} WHERE ID={$id}";
        $this->_db->query($sql);
    }
    
    # This method is adding new competitors to marathon
    public function add($user)
    {
        $user = $this->checkInput($user);
        $id = ($this->getDistanceID($user['distance']));
        $text="";
        $user['runner_id'] = (int)$user['distance']*1000+$id;
        /*var_dump($user);*/
        foreach($user as $key=>$runner)
        { 
            if($key == 'country')      $text.=$this->getCountryById($runner['country']).",";
            elseif($key == 'distance') $text.=$this->getDistanceById($runner['distance']).",";
            elseif($key == 'gender')   $text.=$this->getGenderById($runner['gender']).",";
            elseif($key == 'search')   continue;
            else                       $text.=$runner.",";
        }
        $user['tag'] = $text;
        $this->incrDistID($user['distance'],$id);
        $sql = "INSERT INTO users(name,surname,bDate,email,tel,country,distance,gender,runner_id,tag) "
                ."VALUES(?,?,?,?,?,?,?,?,?,?)";
        if($this->_db->prepare($sql,'ssssssiiis',$user))
            return true;
        else
        {
            $this->_error->set("Ошибка с предпроверкой перед добавлением в базу!");
            return false;
        }
    }

    public function edit($user)
    {
        $user = $this->checkInput($user);
        $field = $user['field'];
        $sql = "SELECT tag FROM users WHERE ID={$user['id']}";
        $data = $this->_db->getArray($sql);
        $tag = $data['tag'];
        /*var_dump($tag);
        var_dump("New: ".$user['value']);*/
        if($tag == "") $tag.=$user['value'].",";
        else $tag = str_ireplace($user['old'],$user['value'],$tag);
        /*var_dump($tag);*/
        switch($user['field'])
        {
            case 'dValue': 
                $sql = "UPDATE users,distance SET users.distance=distance.ID,users.tag='{$tag}' WHERE users.ID={$user['id']} and distance.dValue='{$user['value']}'";
                break;
            case 'gValue':
                $sql = "UPDATE users,gender SET users.gender=gender.ID,users.tag='{$tag}' WHERE users.ID={$user['id']} and gender.gValue='{$user['value']}'";
                break;
            case 'cValue':
                $sql = "UPDATE users,country SET users.country=country.ID,users.tag='{$tag}' WHERE users.ID={$user['id']} and country.CValue='{$user['value']}'";
                break;
            default:
                $sql = "UPDATE users SET users.{$user['field']}='{$user['value']}',users.tag='{$tag}' WHERE users.ID={$user['id']}";
        }
        /*var_dump($sql);*/
        if($this->_db->query($sql))
            return true;
        else
            return false;
    }
    
    public function getUsers($start,$end,$sort,$curDirection="ASC")
    {
        if($curDirection=="down")
            $curDirection="DESC";
        else 
            $curDirection="ASC";
        $pattern = '/^[a-zA-Z_]+$/';
        /*var_dump($sort);die;*/
        if(!preg_match($pattern,$sort))
                return false;
        // 1st realization of query - it's true
        $sql = "SELECT a.ID,a.name,a.surname,a.bDate,a.email,b.dValue,d.cValue,a.tel,c.gValue,a.runner_id FROM users AS a LEFT JOIN distance AS b ON a.distance=b.ID LEFT JOIN gender as c ON a.gender=c.ID LEFT JOIN country AS d ON a.country=d.ID ORDER BY {$sort} {$curDirection} LIMIT {$start},{$end}";
        /*var_dump($sql);*/
        // 2nd realization of query - it's true too
        //$sql = "SELECT a.ID,a.name,a.surname,a.bDate,a.email,b.dValue,a.country,a.tel,c.gValue FROM users AS a,distance AS b,gender AS c WHERE a.distance_id=b.ID AND a.gender_id=c.ID";
        //var_dump($sql);
        return $this->_db->getArray($sql,1);
    }

    public function getSearch($search,$start,$end,$sort,$curDirection="ASC")
    {
        $search = $this->checkInput($search);
        if($curDirection=="down")
            $curDirection="DESC";
        else 
            $curDirection="ASC";
        $pattern = '/^[a-zA-Z_]+$/';
        $pattern1 = '/^[а-яА-Яa-zA-Z_]+$/';
        $search = str_replace("'","",$search);
        $start = $start==null ? 0 : $start;
        $end = $end == null ? STEP : $end;
        
        if(!preg_match($pattern,$sort))
            return false;
        // 1st realization of query - it's true
        $sql = "SELECT a.ID,a.name,a.surname,a.bDate,a.email,b.dValue,d.cValue,a.tel,c.gValue,a.runner_id FROM users AS a LEFT JOIN distance AS b ON a.distance=b.ID LEFT JOIN gender as c ON a.gender=c.ID LEFT JOIN country AS d ON a.country=d.ID WHERE tag LIKE '%{$search}%' ORDER BY {$sort} {$curDirection} LIMIT {$start},{$end}";
            
        /*var_dump($sql);*/
        // 2nd realization of query - it's true too
        //$sql = "SELECT a.ID,a.name,a.surname,a.bDate,a.email,b.dValue,a.country,a.tel,c.gValue FROM users AS a,distance AS b,gender AS c WHERE a.distance_id=b.ID AND a.gender_id=c.ID";
        //var_dump($sql);
        //return 
        return ($this->_db->getArray($sql,1));
    }
    public function getDealSearch($search)
    {
        $sql = "SELECT a.ID,a.name,a.surname,a.bDate,a.email,b.dValue,d.cValue,a.tel,c.gValue,a.runner_id FROM users AS a LEFT JOIN distance AS b ON a.distance=b.ID LEFT JOIN gender as c ON a.gender=c.ID LEFT JOIN country AS d ON a.country=d.ID WHERE tag LIKE '%{$search}%'";

        return count($this->_db->getArray($sql,1));
    }

    public function getCountries()
    {
        $sql = "SELECT ID,cValue FROM country";
        $data = $this->_db->getArray($sql,1);
        return (json_encode($data));
    }

    public function getCountryById($id)
    {
        $id = (int)$id;
        $sql = "SELECT cValue FROM country WHERE ID={$id}";
        $data = $this->_db->getArray($sql);
        return($data['cValue']);
    }

    public function getDistances()
    {
        $sql = "SELECT ID,dValue FROM distance";
        $data = $this->_db->getArray($sql,1);
        return (json_encode($data));
    }

    public function getDistanceById($id)
    {
        $id = (int)$id;
        $sql = "SELECT dValue FROM distance WHERE ID={$id}";
        $data = $this->_db->getArray($sql);
        return($data['dValue']);
    }

    public function getGenderById($id)
    {
        $id = (int)$id;
        $sql = "SELECT gValue FROM gender WHERE ID={$id}";
        $data = $this->_db->getArray($sql);
        return($data['gValue']);
    }

    public function getDirection($sort,$curDirection)
    {
        $direction['ID']       = $direction['name']    = $direction['surname'] = $direction['bDate']  = $direction['email']  = 'up';
        $direction['distance'] = $direction['country'] = $direction['tel']     = $direction['gender'] = $direction['runner'] = 'up';
        switch($sort)
        {
            case 'ID':
                if($curDirection=='up')
                    $direction['ID'] = 'down';
                else
                    $direction['ID'] = 'up';
                break;
            case 'name':
                if($curDirection=='up')
                    $direction['name'] = 'down';
                else
                    $direction['name'] = 'up';
                break;
            case 'surname':
                if($curDirection=='up')
                    $direction['surname'] = 'down';
                else
                    $direction['surname'] = 'up';
                break;
            case 'bDate':
                if($curDirection=='up')
                    $direction['bDate'] = 'down';
                else
                    $direction['bDate'] = 'up';
                break;
            case 'email':
                if($curDirection=='up')
                    $direction['email'] = 'down';
                else
                    $direction['email'] = 'up';
                break;
            case 'distance':
                if($curDirection=='up')
                    $direction['distance'] = 'down';
                else
                    $direction['distance'] = 'up';
                break;
            case 'country':
                if($curDirection=='up')
                    $direction['country'] = 'down';
                else
                    $direction['country'] = 'up';
                break;
            case 'tel':
                if($curDirection=='up')
                    $direction['tel'] = 'down';
                else
                    $direction['tel'] = 'up';
                break;
            case 'gender':
                if($curDirection=='up')
                    $direction['gender'] = 'down';
                else
                    $direction['gender'] = 'up';
                break;
            case 'runner_id':
                if($curDirection=='up')
                    $direction['runner'] = 'down';
                else
                    $direction['runner'] = 'up';
                break;
        }
        return $direction;
    }

    public function getDeal()
    {
        $sql = "SELECT* FROM users";
        $deal = $this->_db->query($sql);
        return mysqli_num_rows($deal);
    }

    public function query($sql)
    {
        $this->_db->query($sql);
    }
}

