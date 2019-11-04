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
	    if (mb_strlen($post['text'], "UTF-8") > $maxLengh) {
		$textCut = mb_substr($post['text'], 0, $maxLengh, "UTF-8");
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

}
