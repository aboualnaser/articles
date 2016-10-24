<?php
echo "string";
session_start();
if (!isset($_SESSION['username'])) {
	header("location:login.php");
}


?>
<h2>welecome in contol panal </h2>