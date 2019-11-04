<?php

namespace models;

use core\AbstractModel;
use mysqli;

class NewsModel extends AbstractModel {

    public function addPosts($post) {
        $query = "insert into posts values (null, '{$post['title']}','{$post['text']}','{$post['user_id']}')";
        $this->db->query($query);
        if ($this->db->errno) {
            die($this->db->error);
        }
    }

}
