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
		if($id == NULL)
		{
			//READ ALL
			$movies = $this->model->getMovieList();
		}
		else
		{
			//READ ONE
			$movies = $this->model->getMovieByID($id);
		}
		$v = new ViewMovieDataJSON(); 
		echo $v->output($movies);
	}
	
	public function executeCREATE($name, $year, $director)  	
	{   
		//CREATE		
		$movies = $this->model->create($name, $year, $director);
		
		$v = new ViewMovieDataJSON(); 
		echo $v->output($movies);
	}

	public function executeUPDATE($id, $name, $year, $director)  	
	{  
		//UPDATE		
		$movies = $this->model->update($id, $name, $year, $director);
		$v = new ViewMovieDataJSON(); 
		echo $v->output($movies);
	}

	public function executeDELETE($id)  	
	{  	
		//DELETE		
		$movies = $this->model->delete($id);
		$v = new ViewSuccessMessage();
		echo $v->output("Movie deleted successfully");
	} 		
}  



?>