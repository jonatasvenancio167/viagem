<?php
	class Connection {
		private $host = "localhost";
		private $port = '3306';
		private $database_name = "trabalho";
		private $username = "root";
		private $password = "mysql";

		public $conn;

		public function getConnection(){
			try{
				$this->conn = new mysqli($this->host, $this->username, $this->password, $this->database_name);
			}catch(Throwable $e){
				echo "Error: " . $e->getMessage;
				throw new $e;
			}

			return $this->conn;
		}
	}
?>
