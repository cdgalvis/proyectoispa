<?php 
	include_once("../config/Config.php");

	session_start();
	session_destroy();
	header("Location:".ROOT."index.php");
?>