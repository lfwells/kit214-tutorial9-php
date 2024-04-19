<?php  
include_once("View/ViewErrorMessage.php");
 
class ViewMovieDataJSON
{
	public function output($movies) {
		
		if(count($movies) > 0) 
		{	
			header("Content-Type: application/json");
			echo json_encode($movies);
		}
		else
		{
			header("HTTP/1.1 404 Not Found");	
			$error = new ViewErrorMessage();
			echo $error->output("No movies found");
		}
	}			
}
	
?>