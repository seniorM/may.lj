<?php

namespace controllers;

use core\AbstractController;

class PostController extends AbstractController {

    public function index() {
	$this->view->render('post_index_view');
    }

}
