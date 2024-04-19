<?php

include_once("Model/Model.php");   
include_once("View/ViewMovieDataJSON.php");  
include_once("View/ViewSuccessMessage.php");  
include_once("View/ViewErrorMessage.php");  

class ControllerMovie 
{  
	public $model;   
	
	public function __construct() 
	{    
		$this->model = new Model();  
	}   
		
	public function executeGET($id = NULL) 
	{  
		$movies = [];
		if($id == NULL)
		{
			//READ ALL
			$movies = $this->model->getMovieList();
		}
		else
		{
			//READ ONE
			$this->validateID($id);
			$movies = $this->model->getMovieByID($id);
		}
		$v = new ViewMovieDataJSON(); 
		echo $v->output($movies);
	}
	
	public function executeCREATE($name, $year, $director)  	
	{   
		$this->validateName($name);
		$this->validateYear($year);

		//CREATE		
		$movies = $this->model->create($name, $year, $director);
		
		$v = new ViewMovieDataJSON(); 
		echo $v->output($movies);
	}

	public function executeUPDATE($id, $name, $year, $director)  	
	{  
		$this->validateID($id);
		$this->validateName($name);
		$this->validateYear($year);

		//UPDATE		
		$movies = $this->model->update($id, $name, $year, $director);
		$v = new ViewMovieDataJSON(); 
		echo $v->output($movies);
	}

	public function executeDELETE($id)  	
	{  	
		$this->validateID($id);
		
		//DELETE		
		$movies = $this->model->delete($id);
		$v = new ViewSuccessMessage();
		echo $v->output("Movie deleted successfully");
	} 	
	
	//additional validation functions
	protected function validateID($id)
	{
		var_dump($id);
		if(!is_numeric($id) || $id <= 0)
		{
			header("HTTP/1.1 400 Bad Request");
			$v = new ViewErrorMessage();
			echo $v->output("Invalid ID");
			exit;
		}
	}

	protected function validateName($name)
	{
		if(strlen($name) <= 0)
		{
			header("HTTP/1.1 400 Bad Request");
			$v = new ViewErrorMessage();
			echo $v->output("Invalid Name");
			exit;
		}
	}

	protected function validateYear($year)
	{
		if(!is_numeric($year) || $year <= 0)
		{
			header("HTTP/1.1 400 Bad Request");
			$v = new ViewErrorMessage();
			echo $v->output("Invalid Year");
			exit;
		}
	}
}  



?>