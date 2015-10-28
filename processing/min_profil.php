<?php

	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	//Hämtar sessionens medlems id.
	$medlem_id = get_user_id();

	//Sickar medlemmen till sin egna sida.
	header("Location: ../profil.php?medlem_id=".$medlem_id);
	exit();

?>