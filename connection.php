<?php
	class Database {
		private $host = "127.0.0.1";
		private $port = '5432';
		private $database_name = "tabalho";
		private $username = "postgres";
		private $password = "123";

		public $conn;

		public function getConnection(){
			$this->conn = null;
			try{
				$this->conn = new PDO("pgsql:host=this->host;database_name=this->database_name;username=this->username;password=this->password;");
			
				$this->conn->exec("set names uft-8");
			}
			catch(PDOException $exception){
				echo "Unable to connect to database: " .exception->getMessage();
			}

			return $this->conn;
		}

	}
?>
