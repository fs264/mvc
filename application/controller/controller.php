<?php

class Controller {

	public $load;
	public $model;

	function __construct($pageURI = null, $get_value = null){
		$this->load = new Load();
		$this->model = new Model();

		if($get_value != null)
			$this->$pageURI($get_value);
		else
			$this->$pageURI();
	}

	function home(){
		$data = $this->model->dbGetImgPath();
		$this->load->view('home', $data);
	}


	function dbTableDefine(){
		$data = $this->model->dbCreateTable();
		echo $data;
	}
	
	function dbInsertDataForm(){

		$data = null;

		foreach ($_POST as $key => $value)
			$data[$i++] = $value;

		$this->model->dbInsertDataForm($data);

		header('Location: /');
	}

	function dbShowData(){
		$this->load->view('dbList');
	}


	function readJSON($get_value){
		$data = $this->model->dbGetJsonData($get_value);	
		echo $data;
	}

}

?>