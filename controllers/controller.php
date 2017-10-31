<?php
class Controller {
	protected $view;
	protected $model;
	protected $view_name;
	public function __construct() {
		$this->view_name = "";
		$this->view = new View();
	}

	public function index(){
		$this->Assign('content', 'This is index class index method, Method is not set yet.');
	}

	function Assign($variable, $value) {
		$this->view->Assign($variable, $value);
	}

	function Load_Model($name){
		$modelName = $name . '_Model';
		$this->model = new $modelName();
	}

	function Load_View($name){
		if(file_exists( ROOT . DS . 'views' . DS . strtolower($name) . '.php')){
			$this->view_name = $name;
		}
	}

	public function __destruct() {
		if(!empty($this->view_name)){
			$this->view->Render($this->view_name);
		}
	}

}