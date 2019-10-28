<?php

namespace core;

abstract class AbstractController {

    /**
     *
     * @var AbstractModel 
     */
    public $model;

    /**
     *
     * @var View
     */
    public $view;

    public function __constract() {
	$this->view = new View();
    }

    abstract public function index();
}
