<?php
include_once("DBConn.php");  
include_once("Movie.php");  
  
//TODO: this needs to use bindings to prevent SQL injection
class Model 
{  
    public function getMovieList()  
    {  
        global $mysqli;

        $sql = "SELECT * FROM movie";

        $result = $mysqli->query($sql);

        $arr = array();
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $arr[] = new Movie($row['id'], $row['name'],$row['year'],$row['director']);
        }
        return $arr;

    }        
  
    public function getMovieByID($id)  
    { 
        global $mysqli;

        $sql = "SELECT * FROM movie WHERE id = $id";

        $result = $mysqli->query($sql);

        $row = $result->fetch_array(MYSQLI_ASSOC);

        return [ new Movie($row['id'], $row['name'],$row['year'],$row['director']) ];
    }       
	
	public function create($name, $year, $director)  
	{  
		global $mysqli;
		
		$sql = "INSERT INTO movie (name, year, director) VALUES ('$name', $year, '$director')";
		
		$mysqli->query($sql);
		
		return $this->getMovieList();
	}

	public function update($id, $name, $year, $director)  
	{  
		global $mysqli;
		
		$sql = "UPDATE movie SET name = '$name', year = $year, director = '$director' WHERE id = $id";
		
		$mysqli->query($sql);
		
		return $this->getMovieList();
	}

	public function delete($id)  
	{  
		global $mysqli;
		
		$sql = "DELETE FROM movie WHERE id = $id";
		
		$mysqli->query($sql);
		
		return $this->getMovieList();
	}
} 
?>