<?php

namespace models;

use core\AbstractModel;
use mysqli;

class AuthModel extends AbstractModel {

    /**
     *
     * @var mysqli
     */
    protected $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_erno) {
            die('failed connect to db');
        }
    }

    /**
     * add user to db
     * 
     * @param array $user
     */
    public function addUser($user) {
        $hash = password_hash($user['pass'], PASSWORD_BCRYPT);
        $query = "insert into users values (null, '{$user['login']}','$hash','{$user['email']}')";
        $this->db->query($query);
        if ($this->db->errno) {
            die($this->db->error);
        }
    }

    public function authenticationUser(array$user) {
        $query = "select * from users where login = '{$user['login']}';";
        $result = $this->db->query($query);
        if($result){
            $user=$result->fetch_object();
            $_SESSION['user']=$user;
            return true;
        }else{
            return false;
        }
    }

}
