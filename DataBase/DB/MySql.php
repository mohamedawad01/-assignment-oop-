<?php 

require_once "DataBase.php";

	class MySql implements DataBase{

		private $conn;
		private $query;
		// setup Connection
		public function __construct($host,$userName,$password,$dbName)
		{
	
			$this->conn = mysqli_connect($host,$userName,$password,$dbName);
		}

		public function select(string $table):array{
			$this->query = "SELECT * FROM $table";
			$result = mysqli_query($this->conn, $this->query);
			return mysqli_fetch_all($result, MYSQLI_ASSOC);
		}
		public function selectOne(string $table, $col, $condition):array{
			$this->query = "SELECT * FROM $table WHERE $col = $condition";
			$result = mysqli_query($this->conn, $this->query);
			return mysqli_fetch_assoc($result);
		}
		public function insert(string $query):bool{
			return mysqli_query($this->conn, $query);		
		}
		public function update(string $query):bool{
			return mysqli_query($this->conn, $query);	
		}
		public function delete(string $query):bool{
			return mysqli_query($this->conn, $query);	
		}
	
	}


?>