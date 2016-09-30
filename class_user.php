<?php

Class user {
	private $db;

	function __construct($db_data){
		$this->db = $db_data;
	}

	public function login($username,$userpass){
		try{
			$query = $this->db->prepare("SELECT * FROM `login` WHERE `username` = :userid");
			$query->bindparam(":userid",$username);
			$query->execute();
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if($query->rowCount() > 0){
				if($row['password'] == $userpass){
					$_SESSION['userid'] = $row['id'];
					$_SESSION['role'] = $row['role'];
					return True;
				}
			}
			else { 
				return False;
			}
		}
		catch(PDOException $e){
			//error in login
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
			return $_SESSION['role'];
		}
	}

	public function alterTask($t_id,$action,$subhead,$sum,$des){

		if($t_id > 0){
			//Deleting previous enteries
			$query = $this->db->prepare("DELETE FROM `task` WHERE `t_id` = :t_id");
			$query->bindparam(":t_id",$t_id);
			$query->execute();
		}else;

		//Entering new entry
		if($action === 'delete'){
			return "SUCCESS1";
		}else if($action === 'update' || $action === 'create'){
			$h_id = $_SESSION['userid'];
			
			$query2 = $this->db->prepare("SELECT COUNT(`t_id`) FROM `task`");
			$t_id = $query2 +  1;

			$query3 = $this->db->prepare("INSERT INTO `task` (`t_id`, `topic`, `des`, `sub_id`, `head_id`) VALUES (:t_id, :sum, :des, :s_id, :h_id) ");
			$query3->bindparam(":t_id",$t_id);
			$query3->bindparam(":sum",$sum);
			$query3->bindparam(":des",$des);
			$query3->bindparam(":h_id",$h_id);
			foreach ($subhead as $s_id) {
				$query3->bindparam(":s_id",$s_id);
				$query3->execute();
			}
			unset($s_id);
			return "SUCCESS2";
			
		}else{
			return "FAILED2";
		}
	}


	public function fetchSubTask() {
		$i=0;
		$num;
		try{
			$query = $this->db->prepare("SELECT * FROM `task` WHERE `sub_id` = :userid");
			$query->bindparam(":userid",$_SESSION['userid']);
			$num = $query->rowCount();
			$rows = $query->fetchAll();
			foreach($rows as $row){
				echo '
				<li id="task_'.$row['t_id'].'">
					<div class="collapsible-header">
						<div class="row">
							<div class="col s5">'.$row['topic'].'</div>
							<div class="col s3">'.$row['head_id'].'</div>
							<div class="col s2">'.$row['updated'].'</div>
							<div class="col s2">'.$row['completed'].'</div>
						</div>
					</div>
					<div class="collapsible-body">
						<div class="row">
							<div class="col s12">'.$row['des'].'</div>
						</div>
						<div class="row">
							<div class="col s12">
								<a class="btn-flat trigger ft" href="#!">Mark task Finished</a>
							</div>
						</div>
					</div>
				</li>
				';
			}
		}
		catch(PDOException $e){
			// error in task fetching
		}
	}
}

/*//First login the user then according to the role make it subhead or head.Both extends user.

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
}*/

?>

