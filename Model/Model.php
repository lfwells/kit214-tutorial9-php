<?php
	include_once("Employee.php");  
	
	
	class Model {  

		public $mysqli = "";
		public $dataConn = true;

		function __construct() {

			$password = trim(file_get_contents("/home/ubuntu/password.txt"));
			$this->mysqli = new mysqli('localhost', 'root', $password, 'lamp_db');

			$this->dataConn = true;
			if (mysqli_connect_errno()) {
				$this->dataConn = false;
			}
		}


		public function searchEmployeebyName($uname)  {			
 
			if($this->dataConn) {

				$sql = "select * from employee where name LIKE '%" . $uname . "%'";
				$result = $this->mysqli->query($sql);

				$arr= array();
			
				if($result) {
					while($row = $result->fetch_array(MYSQLI_ASSOC))	{				
						$arr[$row['id']] = new Employee($row['name'], $row['email'], $row['salary'], $row['id']);
					}
				}

				return $arr;
			}
			else {
				return false;
			}
		}   
		

		public function searchEmployeebyID($id)  {  

			if($this->dataConn) {

				$sql = "select * from employee where id = " . $id;
				$result = $this->mysqli->query($sql);

				$arr= array();
			
				if($result) {
					while($row = $result->fetch_array(MYSQLI_ASSOC))	{				
						$arr[$row['id']] = new Employee($row['name'], $row['email'], $row['salary'], $row['id']);
					}
				}
			
				return $arr;
			}
			else {
				return false;
			}
		} 
		

		public function createNewEmployee($uname, $sal, $id, $email)  	{  

			$sql = "insert into employee values ($id, '$uname', $sal, '$email')";
			$result = $this->mysqli->query($sql);

			if($result) {
				$result = $this->searchEmployeebyID($id);
			}
			else {
				$result = "{ \"error\": \"could not insert\" }";
			}
			
			return $result;
		} 
		

		public function updateEmployee($sal, $id, $email)  	{  
		
			$sql = "select * from employee where id = " . $id;
			$result = $this->mysqli->query($sql);
			
			if($result && $this->mysqli->affected_rows > 0) {
				
				$sql= "update employee set salary = $sal, email = '$email' where id = $id";
				$result=$this->mysqli->query($sql);
				
				if($result) {
					$result = $this->searchEmployeebyID($id);
				}
				else {
					$result = "{ \"error\": \"could not Update\" }";
				}
			
				return $result;
			}
			else
				$result = false;
		}  
		
 
		public function deleteEmployee($id)  {  
			 
			$sql= "delete from employee where id = '$id'";
			$result=$this->mysqli->query($sql);

			if($result && $this->mysqli->affected_rows > 0) {
				$result = "{ \"success\": \"Deleted $id\" }";
			}
			else {
				$result = "{ \"error\": \"could not Delete\" }";
			}
			
			return $result;
		}
		

		public function generateToken($user, $password)  {  

			// Generate Token here
			
			return 1; //$result;
		}   		
	} 
?>