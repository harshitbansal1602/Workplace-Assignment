<?php
require_once 'connect.php';

/*if(isset($_POST['userid']) && !empty($_POST['userid']) && isset($_POST['password']) && !empty($_POST['password'])){
	$user->login($_POST['userid'],$_POST['password']);
}
else{
	//error message.
}*/

if($user->isLoggedIn()){
	if($user->getRole() == 1){
		header('Location: home_head.php');
	}
	elseif($user->getRole() == 0){
		header('Location: home_subhead.php');
	}
	else {
		header('Location: error.php');
	}
}

/*if(isset($_POST['userid']) && !empty($_POST['userid'])){
	if($user->getRole() == 1){
		header('Location: head.php');
	}
	elseif($user->getRole() == 0){
		header('Location: subhead.php');
	}
}*/



?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<title>Your own Workspace!</title>
</head>
<body>
	<div class="login-page">
  <div class="form">
    <form class="login-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
      <input type="text" name="userid" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
</body>
</html>