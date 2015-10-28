<?php
	
	//--Bootstrap--
	require_once '../include/bootstrap.php';

	//Deaktiverar sessionen.
	logout();

	//Redirect till förstasidan.
	header("Location: ../index.php");
	exit();	

?>