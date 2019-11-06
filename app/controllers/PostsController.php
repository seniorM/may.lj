<?php

namespace controllers;

use core\AbstractController;
use models\PostsModel;

class PostsController extends AbstractController {

    public function index() {
        $this->view->posts = $this->_getModel()->all();
        $this->view->render('posts_index_view');
    }

    public function authors() {
        $this->view->render('posts_authors_view');
    }

    public function item() {
        $id = filter_input(INPUT_GET, 'id');

        //TODO выбор и отображение новости
        $this->view->post = $this->_getModel()->fullPost($id);
        $this->view->render('fullpost_index_view');
    }

    public function addPost() {
        $this->view->post = $this->_getModel()->addPosts($post);
        $this->view->render('addpost_index_view');
    }

    /**
     * create and return 
     * 
     * @return PostsModel
     */
    protected function _getModel() {
        if (!$this->model) {
            $this->model = new PostsModel();
        }
        return $this->model;
    }

}
