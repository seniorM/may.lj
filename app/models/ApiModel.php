<?php

namespace models;

use core\AbstractModel;

class ApiModel extends AbstractModel {

    public function getAuthors() {
	$query = " select * from users;";
	$result = $this->db->query($query);
	if (!$result) {
	    die($this->db->error);
	}
	$authors = $result->fetch_all(MYSQLI_ASSOC);
	return $authors;
    }

}
