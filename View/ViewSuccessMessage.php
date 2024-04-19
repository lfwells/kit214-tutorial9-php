<?php  
 
	class ViewSuccessMessage
	{
		public function output($message)
		{
			header("Content-Type: application/json");
			echo json_encode(["success" => $message]);
		}		
	}
	
?>