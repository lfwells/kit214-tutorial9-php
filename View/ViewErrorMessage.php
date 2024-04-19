<?php  
 
	class ViewErrorMessage
	{
		public function output($message)
		{
			header("Content-Type: application/json");
			echo json_encode(["error" => $message]);
		}		
	}
	
?>