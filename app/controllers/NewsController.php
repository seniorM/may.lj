<?php

namespace controllers;

use core\AbstractController;
use mysqli;
use core\Route;
use models\NewsModel;

class NewsController {
    public function index() {
        
        $this->view->render('allNews_index_view');
    }
}
