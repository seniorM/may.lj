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
    
    protected $_modelClass;
    

    public function __construct() {
	$this->view = new View();
    }
    /**
     * 
     * @return type
     */
    protected function _getModel() {
        if (!$this->model) {
            $this->model = new $this->_modelClass();
        }
        return $this->model;
    }

    abstract public function index();
}
