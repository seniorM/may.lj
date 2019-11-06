<?php

namespace models;

use core\AbstractModel;

class PostsModel extends AbstractModel {

    public function all() {
        $query = "select posts.id as id, posts.title as title, posts.text as text, users.login as author from users inner join posts on posts.user_id = users.id order by id desc;";
        $result = $this->db->query($query);
        if (!$result) {
            die($this->db->error);
        }
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        array_walk($posts, function (&$post) {
            $maxLength = 100;
            if (mb_strlen($post['text'], "UTF-8") > $maxLength) {
                $textCut = mb_substr($post['text'], 0, $maxLength, "UTF-8");
                $words = explode(" ", $textCut);
                unset($words[count($words) - 1]);
                $shorttext = implode(" ", $words);
                $post['text'] = $shorttext . "...";
            }
        });

        //	$posts = [];
        //	while ($post = $result->fetch_object()) {
        //	    $posts[] = $post;
        //	}
        return $posts;
    }

    public function fullPost($id) {
        $query = "select * from posts inner join users on users.id = posts.user_id WHERE posts.id = '{$id}'";
        $result = $this->db->query($query);
        if (!$result) {
            die($this->db->error);
        }
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        //	$posts = [];
        //	while ($post = $result->fetch_object()) {
        //	    $posts[] = $post;
        //	}
        return $posts;
    }
    /**
     * add post to db
     * 
     * @param array $post
     */
    public function addPosts($post) {
        $query = "insert into posts values (null, '{$post['title']}','{$post['text']}','{$post['user_id']}')";
        $this->db->query($query);
        if ($this->db->errno) {
            die($this->db->error);
        }
    }

}
