<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("location:login.php");
}
require_once('frame.php');

?>
<h2>welecome in contol panal </h2>