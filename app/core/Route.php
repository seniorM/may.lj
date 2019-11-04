<?php

namespace core;

use models\AuthModel;

class Route {

    /**
     * routing /controller/action
     */
    static public function init() {
        //TODO create base routing
        //######################################################################
        //получить дополнительный путь и разбить его на элементы по / если есть 
        //лишние элементы, то выдать 404. Если нет лишних, то первая часть - имя
        //контроллера(класса), вторая часть - имя экшна(метода). Если элементов 
        //меньше 2х, то экшн - index, контроллер main.Если указанного класса 
        //контроллера не существует, или метода экшн, то 404. сделать метод 
        //статический для ошибки 404
        //######################################################################
        //это значение останется в переменной, если не произойдёт перезапись
        $controllerName = 'main';
        //это значение останется в переменной, если не произойдёт перезапись
        $actionName = 'index';
        //забираем дополнительный путь документа в домене и разделяем его на список

        $routeItems = explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]);
        //0-й элемент всегда содержит пустую строку, поэтому удаляем его 
        array_shift($routeItems);
        //проверяем последний элемент массива на пустое значение
        //при необходимости удаляем его
        if (empty($routeItems[count($routeItems) - 1])) {
            array_pop($routeItems);
        }
        //если в массиве больше 2-х элементов, то 404
        if (count($routeItems) > 2) {
            self::error404();
        }
        if (!empty($routeItems[0])) {
            //для кириллицы
            //$controllerName = mb_strtolower(urldecode($routeItems[0]));
            $controllerName = strtolower($routeItems[0]);
        }
        if (!empty($routeItems[1])) {
            //для кириллицы
            //$actionName = mb_strtolower(urldecode($routeItems[1]));д
            $actionName = strtolower($routeItems[1]);
        }
        // для кириллицы
        //$controllerClassName= mb_convert_case($controllerName, MB_CASE_TITLE);
        $controllerClassName = 'controllers\\' . ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClassName)) {
            self::error404();
        }
        $controller = new $controllerClassName();
        if (!method_exists($controller, $actionName)) {
            self::error404();
        }
        if ($controllerName !== 'auth' && !AuthModel::haveAuthUser()) {
            Route::redirect(url('/auth'));
        }
        $controller->$actionName();
    }

    /**
     * create http status 404
     */
    static public function error404() {
        http_response_code(404);
        $view = new View();
        $view->render('error_404_view');
        exit();
    }

    /**
     * redirect to specified url
     * 
     * @param string $url
     */
    static public function redirect(string $url) {
        header('Location:' . $url);
    }

    /**
     * 
     * @return errors
     */
    static public function getErrors() {
        //$errors=empty($_SESSION['errors']) ? [] : $_SESSION['errors'];
        if (empty($_SESSION['errors'])) {
            $errors = [];
        } else {
            $errors = $_SESSION['errors'];
        }
        return $errors;
    }

    /**
     * 
     * user checking 
     * @return string
     */
    static public function userValidate($user) {
        $errors = [];
        if (strlen($user['login']) < 6) {
            $errors[] = 'Too short login value';
        }
        if ($user['pass'] !== $user['pass_conf']) {
            $errors[] = 'Password do not match';
        } else if (strlen($user['pass']) < 6) {
            $errors[] = 'Too short password value';
        }
        if (empty($user['email'])) {
            $errors[] = 'Email is required field';
        }
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Incorrect email value';
        }
        return $errors;
    }

    /**
     * clear session
     */
    static public function clearSession() {
        //чтобы не сохранились к следующему запуску
        $_SESSION['errors'] = null;
        $_SESSION['login'] = null;
        $_SESSION['email'] = null;
    }

}
