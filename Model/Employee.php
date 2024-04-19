<?php

class Employee {
	
	// Properties
	public $name;
	public $email;
	public $salary;
	public $emp_id;

	function __construct($name, $email, $sal, $id) {		
		$this->name 	= $name;
		$this->email 	= $email;
		$this->salary 	= $sal;
		$this->emp_id 	= $id;		
	}
	
	// Methods

	function getName() {
		return $this->name;
	}

	function setSalary($sal) {
		$this->salary = $sal;
	}

	function getSalary() {
		return $this->salary;
	}
	
	function getEmail() {
		return $this->email;
	}	
	
	function getId() {
		return $this->emp_id;
	}		
}

?>