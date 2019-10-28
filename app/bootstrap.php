<?php

/**
 * 
 * @return string app path from server root
 */
function getAppPath() {
    return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR;
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
