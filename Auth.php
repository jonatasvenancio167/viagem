<?php

	include_once ('connection.php');

	class Auth {

		// connection with database
		private $conn;

		private $db_table = 'Auth';

		public $id;
		public $user;
		public $password;

		public function _construct($db){
			$this->conn = $db;
		} 

		// function with method get

		public function setId(int $id) :void {
			$this->id = $id;
		}

		public function getId() :int {
			return $this->id = $id;
		}

		public function setLogin(string $user) :string {
			$this->user = $user;
		}

		public function getLogin() :string {
			return $this->user;
		}

		public function setPassword(string $password) :string {
			$this->password = $password;
		}

		public function getPassword() :string {
			return $this->password;
		}

		public function create(){
			$connection = new Database();

			$stmt =	$connection->prepare("INSERT INTO auth VALUES ($user, $password)");
			$stmt->execute();

			if($tmt){
				$this->setId($connection->lastInsertId(resource));
				return $this->read();
			}
			return[];
		}

		public function read() :array{
			$connection = new Database();

			$stmt =	$connection->prepare("SELECT * FROM auth");

			if($stmt){
				return $stmt->fetchAll();				
			}
			return [];
		}

		public function update() :array{
			$connection = new Database();

			$stmt = $connection->prepare("UPDATE person SET name =  $user WHERE id = $id" );

			if($stmt){
				return $stmt->read();				
			}
			return [];	
		}

		public function delete() :array{
			$connection = new Database();

			$userDelete = $this->read();
			$stmt = $connection->prepare("DELETE FROM person WHERE id = $id" );

			if($stmt){
				return $userDelete;				
			}
			return [];	
		}

 		public function getAuth(){
			$sqlQuery = "SELECT login, pwd FROM " .this->db_table ."";
			$stmt = $this->prepare($sqlQuery);
			$stmt->execute();

			return $stmt;
		}

		// Creating the user login

		public function createAuth(){
			$sqlQuery = "INSERT INTO ". this->db_table . " SET user= :user, password= :password";

			$stmt = $this->conn->prepare($sqlQuery);

			$this->user = htmlspecialchars(strip_tags($this->user));
			$this->password = htmlspecialchars(strip_tags($this->password));

			$this->bindParams(":user", $this->user);
			$this->bindParams(":password", $this->password);

			if($stmt->execute()){
				return true;
			} 
			return false;
		}
	}
?>
