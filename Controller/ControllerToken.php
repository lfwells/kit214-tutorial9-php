<?php

	include_once("../Model/Model.php");   
	include_once("../View/ViewSearchOutput.php");  
 
	class ControllerToken {  

		public $model;   
	  
		public function __construct()        {    
			$this->model = new Model();  
		}   
		  
		public function executeTokenGen($user, $password)  	{  	
			$token = $this->model->generateToken($user, $password);
			$v = new ViewSearchOutput(); 
			echo $v->outputToken($token);
		}   		
	}  






	$c = new ControllerToken();


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		 // The request is using the POST method		 
		if( isset($_POST['user']) && $_POST['user'] != "" && isset($_POST['password']) && $_POST['password'] != "" )			
			$c->executeTokenGen($_POST['user'], $_POST['password']);
		else
			header("HTTP/1.1 400 Bad Request");			 
	}
	else {
			header("HTTP/1.1 400 Bad Request");				 
	}

?>