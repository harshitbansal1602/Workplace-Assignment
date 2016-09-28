<?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name  = "workspace";

try{
	$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_password);
	$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	//error in connection
}

Class user {
	private $db;

	function __construct($db_data){
		$this->db = $db_data;
	}

	public function login($username,$userpass){
		$query = $this->db->prepare("SELECT * FROM `login` WHERE `username` = :userid");
		$query->bindparam(":userid",$username);
		$query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC);
		if($query->rowCount() > 0){
			if($row['password'] == $userpass){
				$_SESSION['userid'] = $row['id'];
				return True;
			}
		}
		else { 
			return False;
		}
	}

	public function isLoggedIn() {
		if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){
			return true;
		}
		else { 
			return False;
		}
	}

	public function logout() {
		session_destroy();
		return true;
	}

	public function getRole() {
		if($this->isLoggedIn()){
			$query = $this->db->prepare("SELECT * FROM `login` WHERE `id` = ".$_SESSION['userid']."");
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row['role'];
		}
	}
}

//First login the user then according to the role make it subhead or head.Both extends user.

Class subhead extends user {
	private $id;

	function __construct($db_data,$userid){
		$this->id = $userid;
	}
}


Class head extends user {
	private $id;

	function __construct($db_data,$userid){
		$this->id = $userid;
	}
}

$user = new user($db_con);



?>