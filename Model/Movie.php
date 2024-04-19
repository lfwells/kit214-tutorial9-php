<?php

class Movie 
{
	public $id;
	public $name;
	public $year;
	public $director;

	function __construct($id, $name, $year, $director) 
	{		
		$this->id 		= $id;
		$this->name 	= $name;
		$this->year 	= $year;
		$this->director = $director;	
	}	
}

?>