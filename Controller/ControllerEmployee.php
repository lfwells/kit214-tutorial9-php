<?php

	include_once("../Model/Model.php");   
	include_once("../View/ViewSearchOutput.php");  
 
	class Controller {  

		public $model;   
	  
		public function __construct()        {    
			$this->model = new Model();  
		}   
		  
		public function executeGET($type, $u)  	{  //READ	
			$employees = "";
			if($type == 0)
				$employees = $this->model->searchEmployeebyID($u);
			else
				$employees = $this->model->searchEmployeebyName($u);
			
			$v = new ViewSearchOutput(); 
			echo $v->outputGET($employees);
		}  
		
		public function executeCREATE($uname, $sal, $id, $email)  	{   //CREATE		
			$employees = $this->model->createNewEmployee($uname, $sal, $id, $email);
			$v = new ViewSearchOutput(); 
			echo $v->outputCREATE($employees);
		} 

		public function executeUPDATE($sal, $id, $email)  	{  // Update		
			$employees = $this->model->updateEmployee($sal, $id, $email);
			$v = new ViewSearchOutput(); 
			echo $v->outputUPDATE($employees);
		}

		public function executeDELETE($id)  	{  			//DELETE	
			$employees = $this->model->deleteEmployee($id);
			$v = new ViewSearchOutput(); 
			echo $v->outputDELETE($employees);
		} 		
	}  






	$c = new Controller();

	$action = -1;

	if (isset($_GET['action']) && $_GET['action'] != "") {
		$action = $_GET['action'];
	}
	else if (isset($_POST['action']) && $_POST['action'] != "") {
		$action = $_POST['action'];
	}

	//echo $_SERVER['REQUEST_METHOD'] . "j " . $action;

	if($action == -1) {
		header("HTTP/1.1 503 Service Unavailable");
	}
	else {

	  if ($_SERVER['REQUEST_METHOD'] === 'GET' && $action == "read") {
		 // The request is using the GET method
		if(isset($_GET['id']) && $_GET['id'] != "")
			$c->executeGET(0, $_GET['id']);
		else if(isset($_GET['name']) && $_GET['name'] != "")
			$c->executeGET(1, $_GET['name']);
		else
			header("HTTP/1.1 400 Bad Request");		
	  }
	  else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action == "create") {
		
		 // The request is using the POST method		 
		if(isset($_POST['id']) && $_POST['id'] != "" &&
		   isset($_POST['name']) && $_POST['name'] != "" &&
		   isset($_POST['salary']) && $_POST['salary'] != "" &&
		   isset($_POST['email']) && $_POST['email'] != ""    )
			
			$c->executeCREATE($_POST['name'], $_POST['salary'], $_POST['id'], $_POST['email']);
		else
			header("HTTP/1.1 400 Bad Request");			 
	  }
	  else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action == "update") {
		
		if(isset($_POST['id']) && $_POST['id'] != "" &&
		   isset($_POST['salary']) && $_POST['salary'] != "" &&
		   isset($_POST['email']) && $_POST['email'] != ""    )
			
			$c->executeUPDATE($_POST['salary'], $_POST['id'], $_POST['email']);			
		else
			header("HTTP/1.1 400 Bad Request");				 
	  }
	  else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action == "delete") {
		
		if(isset($_POST['id']) && $_POST['id'] != "")			
			$c->executeDELETE($_POST['id']);			
		else
			header("HTTP/1.1 400 Bad Request");				 
	  }
	  else		
		header("HTTP/1.1 400 Bad Request");
	}

?>