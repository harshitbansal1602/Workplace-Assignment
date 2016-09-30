<?php

session_destroy();
unset($user);
header('Location: index.php');
exit();

?>