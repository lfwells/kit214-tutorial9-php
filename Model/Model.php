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

		//note the use of bindings now
		$stmt = $mysqli->prepare("SELECT * FROM movie WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows == 0)
			return [];

        $row = $result->fetch_array(MYSQLI_ASSOC);

        return [ new Movie($row['id'], $row['name'],$row['year'],$row['director']) ];
    }       
	
	public function create($name, $year, $director)  
	{  
		global $mysqli;
		
		//note the use of bindings now
		$stmt = $mysqli->prepare("INSERT INTO movie (name, year, director) VALUES (?, ?, ?)");
		$stmt->bind_param("sis", $name, $year, $director);
		$stmt->execute();
		
		return $this->getMovieList();
	}

	public function update($id, $name, $year, $director)  
	{  
		global $mysqli;
		
		//note the use of bindings now
		$stmt = $mysqli->prepare("UPDATE movie SET name = ?, year = ?, director = ? WHERE id = ?");
		$stmt->bind_param("sisi", $name, $year, $director, $id);
		$stmt->execute();
		
		return $this->getMovieList();
	}

	public function delete($id)  
	{  
		global $mysqli;
		
		//note the use of bindings now
		$stmt = $mysqli->prepare("DELETE FROM movie WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		
		return $this->getMovieList();
	}
} 
?>