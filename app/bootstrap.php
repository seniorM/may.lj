<?php

/**
 * 
 * @return string app path from server root
 */
function getAppPath() {
    return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR;
}

/**
 * возвращает указанный путь на текущем сайте
 * 
 * @param string $path допольнительный путь сайта
 */
function url(string $path = null) {
    if ($_SERVER['SERVER_PORT'] === '80') {
	$sheme = 'http';
    } else if ($_SERVER['SERVER_PORT'] === '443') {
	$sheme = 'https';
    }
    return $sheme . '://' . $_SERVER['HTTP_HOST'] . $path;
}

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $classPath = getAppPath() . $class . '.php';
    if (file_exists($classPath)) {
	include_once $classPath;
	return true;
    }
    return false;
});
include_once 'config.php';

\core\Route::init();
