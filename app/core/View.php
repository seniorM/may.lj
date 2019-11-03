<?php

namespace core;

use core\Route;

class View {

    public function render($page, $template = VIEW_DEFAULT_TEMPLATE) {
        include_once getAppPath() . 'views' . DIRECTORY_SEPARATOR . $template . '.php';
    }

}
