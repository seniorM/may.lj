<?php

namespace controllers;

use core\AbstractController;

class MainController extends AbstractController {

    public function index() {
	$this->view->render('');
    }

}
