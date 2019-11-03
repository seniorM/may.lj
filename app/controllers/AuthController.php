<?php

namespace controllers;

use core\AbstractController;
use mysqli;
use core\Route;
use models\AuthModel;

class AuthController extends AbstractController {

    public function index() {
        $this->view->render('auth_index_view');
    }

    public function registration() {
        $this->view->render('auth_register_view');
    }

    public function regproc() {
        $this->_checkMethod('POST');
        $user = filter_input_array(INPUT_POST);
        //TODO все проверки

        $errors = Route::userValidate($user);

        if (!$errors) {
            $model = $this->_getModel();
            $model->addUser($user);
            Route::redirect(url('/auth'));
        } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['login'] = $user['login'];
            $_SESSION['email'] = $user['email'];
            Route::redirect(url('/auth/registration'));
        }
    }

    public function login() {
        $this->_checkMethod('POST');
        $user = filter_input(INPUT_POST);
        if(!$this->_getModel()->authenticationUser($user)){
            //TODO send error to login
            Route::redirect(url('/auth/index'));
        }
        Route::redirect(url('/'));
    }
    /**
     * 
     * @return type
     */
    protected function _getModel() {
        if (!$this->model) {
            $this->model = new AuthModel();
        }
        return $this->model;
    }

    protected function _checkMethod($method) {
        $method = strtoupper($method);
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('not available request method');
        }
    }

}
