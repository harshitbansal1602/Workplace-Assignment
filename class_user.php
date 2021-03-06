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
			return false;
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

			$query5 = $this->db->prepare("UPDATE `login` SET `free` = 0 WHERE `free` = :t_id");
			$query5->bindparam(":t_id",$t_id);
			$query5->execute();
			
		}else;

		//Entering new entry
		if($action === 'delete'){
			return "SUCCESS1";
		}else if($action === 'update' || $action === 'create'){
			if($action == 'create'){
				$query2 = $this->db->prepare("SELECT `t_id` FROM `task` ORDER BY `t_id` DESC LIMIT 1");
				$query2->execute();
				$row = $query2->fetch(PDO::FETCH_ASSOC);
				$t_id = $row['t_id'] +  1;
			}else;
			$h_id = $_SESSION['userid'];			
			date_default_timezone_set("Asia/Kolkata");
			$time = date("y/m/d h:ia");
			$query3 = $this->db->prepare("INSERT INTO `task` (`t_id`, `topic`, `des`, `sub_id`, `head_id`, `updated`) VALUES (:t_id, :sum, :des, :s_id, :h_id, :updated) ");
			$query3->bindparam(":t_id",$t_id);
			$query3->bindparam(":sum",$sum);
			$query3->bindparam(":des",$des);
			$query3->bindparam(":h_id",$h_id);
			$query3->bindparam(":updated",$time);
			
			foreach ($subhead as $s_id) {
				$query3->bindparam(":s_id",$s_id);
				$query3->execute();
			}
			unset($s_id);

			$query4 = $this->db->prepare("UPDATE `login` SET `free`=:t_id WHERE `id` = :s_id");
			$query4->bindparam(":t_id",$t_id);
			foreach ($subhead as $s_id) {
				$query4->bindparam(":s_id",$s_id);
				$query4->execute();
			}
			unset($s_id);
			
			return "SUCCESS2";
			
		}else{
			return "FAILED2";
		}
	}


	public function fetchSubTask() {
		try{
			$query = $this->db->prepare("SELECT `id`,`name` FROM `login`");
			$query->execute();
			$names = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($names as $n){
				$names2[$n['id']]=$n['name'];
			}
			unset($n);
			
			$query = $this->db->prepare("SELECT * FROM `task` WHERE `sub_id` = :userid ORDER BY `completed` DESC, `updated` DESC");
			$query->bindparam(":userid",$_SESSION['userid']);
			$query->execute();
			$rows = $query->fetchAll();
			foreach($rows as $row){
				$html = "";
				$html .= '<li id="task_'.$row['t_id'].'">
					<div class="collapsible-header ';

					if($row['completed'] !='Not completed.'){
						$html .= 'completed';
					}else{
						$html .= 'uncompleted';
					}

					$html.='">
						<div class="row">
							<div class="col s3">'.$row['topic'].'</div>
							<div class="col s2">'.$names2[$row['head_id']].'</div>
							<div class="col s3">'.$names2[$row['sub_id']].'</div>
							<div class="col s2">'.$row['updated'].'</div>
							<div class="col s2">'.$row['completed'].'</div>
						</div>
					</div>
					<div class="collapsible-body">
						<div class="row">
							<div class="col s12">'.$row['des'].'</div>
						</div>';
						
						if($row['completed'] =='Not completed.'){
										$html .= '<div class="row">
													<div class="col s12">
														<a class="btn-flat trigger ft" href="#!">Mark task Finished</a>
													</div>
												</div>';
						}
						
					$html .= '</div>
				</li>
				';

				echo $html;
			}
		}
		catch(PDOException $e){
			// error in task fetching
		}
	}

	public function fetchHeadTask($userid) {
		try{
			$query = $this->db->prepare("SELECT `id`,`name` FROM `login` WHERE `role` = '0'");
			$query->execute();
			$names = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($names as $n){
				$names2[$n['id']]=$n['name'];
			}
			unset($n);

			$query = $this->db->prepare("SELECT * FROM `task` WHERE `head_id` = :userid ORDER BY `completed` DESC, `updated` DESC");
			$query->bindparam(":userid",$userid);
			$query->execute();
			$rows = $query->fetchAll();
			$num = $query->rowCount();
			$html='';

			for($key=0; $key<$num; ){

				$html .= '
				<li id="task_'.$rows[$key]['t_id'].'">
					<div class="collapsible-header ';

					if($rows[$key]['completed'] !='Not completed.'){
						$html .= 'completed';
					}else{
						$html .= 'uncompleted';
					}

					$html .= '">
						<div class="row">
							<div class="col s5">'.$rows[$key]['topic'].'</div>
							<div class="col s3">'.$names2[$rows[$key]['sub_id']];

								for($key2=$key+1; $key2<$num && $rows[$key]['t_id'] === $rows[$key2]['t_id']; $key2++){
									$html .= ','.$names2[$rows[$key2]['sub_id']];
								}

								$html.='</div>
								<div class="col s2">'.$rows[$key]['updated'].'</div>
								<div class="col s2">'.$rows[$key]['completed'].'</div>
							</div>
						</div>
						<div class="collapsible-body">
							<div class="row">
								<div class="col s12">'.$rows[$key]['des'].'</div>
							</div>
							';
									if($rows[$key]['completed'] =='Not completed.'){
										$html .= '<div class="row">
													<div class="col s12">
														<a class="modal-trigger btn-flat trigger_et" href="#modal1">Edit Task</a>
														<a class="btn-flat trigger_dt" href="#!">Delete Task</a>
													</div>
												</div>';
									}

				$html .='</div>
					</li>
					';
					echo $html;
					$html = '';
					$key = $key2;
				}
			}
			catch(PDOException $e){
			// error in task fetching
			}
		}

		public function fetchFree() {
			try{
				$query = $this->db->prepare("SELECT * FROM `login` WHERE `free` = '0'");
				$query->execute();
				$rows = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach($rows as $row){
					echo '
					<p>
						<input type="checkbox" id="'.$row['name'].'" value="'.$row['id'].'" />
						<label class="grey-text text-darken-4" for="'.$row['name'].'">'.$row['name'].'</label>
					</p>
					';
				}
			}
			catch(PDOException $e){
				// error in task fetching
			}
		}

		public function fetchAll($t_id) {
			try{
				/*$query = $this->db->prepare("SELECT * FROM `task` WHERE `t_id` = :t_id");
				$query->bindparam(":t_id",$t_id);
				$query->execute();
				$rows = $query->fetchAll(PDO::FETCH_ASSOC);*/
				
				$query = $this->db->prepare("SELECT `id`,`name` FROM `login` WHERE `role` = '0' AND `free`=:t_id");
				$query->bindparam(":t_id",$t_id);
				$query->execute();
				$names = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach($names as $n){
					$names2[$n['id']]=$n['name'];
				}
				unset($n);



				foreach($names as $row){
					
					echo '
					<p>
						<input type="checkbox" id="'.$names2[$row['id']].'" value="'.$row['id'].'" checked />
						<label class="grey-text text-darken-4" for="'.$names2[$row['id']].'">'.$names2[$row['id']].'</label>
					</p>
					';
				}

				$this->fetchFree();
			}
			catch(PDOException $e){
				// error in task fetching
			}
		}

		public function fetchAllTask() {
			try{
			$query = $this->db->prepare("SELECT `id`,`name` FROM `login` WHERE `role` = '0'");
			$query->execute();
			$names = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($names as $n){
				$names2[$n['id']]=$n['name'];
			}
			unset($n);

			$query = $this->db->prepare("SELECT * FROM `task` ORDER BY `completed` DESC, `updated` DESC");
			$query->bindparam(":userid",$userid);
			$query->execute();
			$rows = $query->fetchAll();
			$num = $query->rowCount();
			$html='';

			for($key=0; $key<$num; ){

				$html .= '
				<li id="task_'.$rows[$key]['t_id'].'">
					<div class="collapsible-header ';

					if($rows[$key]['completed'] !='Not completed.'){
						$html .= 'completed';
					}else{
						$html .= 'uncompleted';
					}

					$html .= '">
						<div class="row">
							<div class="col s5">'.$rows[$key]['topic'].'</div>
							<div class="col s3">'.$names2[$rows[$key]['sub_id']];

								for($key2=$key+1; $key2<$num && $rows[$key]['t_id'] === $rows[$key2]['t_id']; $key2++){
									$html .= ','.$names2[$rows[$key2]['sub_id']];
								}

								$html.='</div>
								<div class="col s2">'.$rows[$key]['updated'].'</div>
								<div class="col s2">'.$rows[$key]['completed'].'</div>
							</div>
						</div>
						<div class="collapsible-body">
							<div class="row">
								<div class="col s12">'.$rows[$key]['des'].'</div>
							</div>
						</div>
					</li>
					';
					echo $html;
					$html = '';
					$key = $key2;
				}
			}
			catch(PDOException $e){
			// error in task fetching
			}
		}

		public function completed($t_id){
			
			date_default_timezone_set("Asia/Kolkata");
			$time = date("y/m/d h:ia");

			$query = $this->db->prepare("UPDATE `task` SET `completed` = :tim WHERE `t_id` = :t_id");
			$query->bindparam(":tim",$time);
			$query->bindparam(":t_id",$t_id);
			$query->execute();

			$query  = $this->db->prepare("UPDATE `login` SET `free` = 0 WHERE `free` = :t_id");
			$query->bindparam(":t_id",$t_id);
			$query->execute();
		}



	}
	?>


