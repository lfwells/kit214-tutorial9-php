<?php  
 
	class ViewSearchOutput
	{
		public function outputGET($employees) {
			
			if(count($employees) > 0) {
				
				header("Content-Type: application/json");
				$output = "";
				foreach ($employees as $id => $employee)  
				{  
						$output .= "{\r\n";
						$output .= "\"employee_ID\": \"" 	. $employee->emp_id	. "\",";
						$output .= "\"employee_Name\": \"" 	. $employee->name 	. "\",";
						$output .= "\"employee_Salary\": \"" 	. $employee->salary 	. "\",";
						$output .= "\"employee_Email\": \"" 	. $employee->email 	. "\"";
						$output .= "\r\n},";
				}  					
				
				return str_replace(",]", "]", "[" . $output . "]");
			}
			else
				header("HTTP/1.1 404 Not Found");		
			
		}
		
		public function outputCREATE($employees) { // created a new user
			
			header("Content-Type: application/json");
			$output = "";
			
			foreach ($employees as $id => $employee)  
			{  
						$output .= "{\r\n";
						$output .= "\"employee_ID\": \"" 	. $employee->emp_id	. "\",";
						$output .= "\"employee_Name\": \"" 	. $employee->name 	. "\",";
						$output .= "\"employee_Salary\": \"" 	. $employee->salary 	. "\",";
						$output .= "\"employee_Email\": \"" 	. $employee->email 	. "\"";
						$output .= "\r\n},";
			}  		
			
			return str_replace(",]", "]", "[" . $output . "]");
		}

		public function outputUPDATE($employees) { // updated a old user
			
			if($employees == false) {
				header("HTTP/1.1 404 Not Found");
			}
			else {
				header("Content-Type: application/json");	
				$output = "";
				
				foreach ($employees as $id => $employee)  				{  
						$output .= "{\r\n";
						$output .= "\"employee_ID\": \"" 	. $employee->emp_id	. "\",";
						$output .= "\"employee_Name\": \"" 	. $employee->name 	. "\",";
						$output .= "\"employee_Salary\": \"" 	. $employee->salary 	. "\",";
						$output .= "\"employee_Email\": \"" 	. $employee->email 	. "\"";
						$output .= "\r\n},";
				}  		
				
				return str_replace(",]", "]", "[" . $output . "]");
			}
		}

		public function outputDELETE($employees) { // deleted a old user
			header("Content-Type: application/json");			
			return "[" . $employees . "]";
		}

		public function outputToken($t) {
			header("Content-Type: application/json");			
			return "{ \"token\" : \""  . $t . "\", \"expiry\" : \"" . (time() + 1000) . "\"}";
		}			
	}
	
?>  
  