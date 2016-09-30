<?php
ob_start();
unset($_SESSION['userid']);
unset($_POST);
session_destroy();
header("Location: index.php");
?>