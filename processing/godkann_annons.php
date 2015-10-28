<?php

	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	$annons_id = mysql_real_escape_string($_GET['annons_id']);

	$db = new Database();

	$annons_result = $db->godkann_annons($annons_id);

	if($annons_result)
	{
		//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
		setMessage("Annonsen med ID: ".$annons_id." är nu godkänd! Klicka fortsätt för att komma till din profil.", "profil.php?medlem_id=".get_user_id(),  MESSAGE);
		
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}

?>