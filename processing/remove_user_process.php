<?php
	
	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	//--Autentiserar besökare--//
	authorize();
	
	//Ifall användare givit tillåtelse eller remove sker av en admin.
	if(remove_is_verified() || isAdmin())
	{
		//Hämtar information om användare som ska tas bort.
		$medlem_id = mysql_real_escape_string($_GET['medlem_id']);

		$db = new Database();

		//Försöker ta bort användaren.
		$result = $db->removeUser($medlem_id);

		//Om det inte är en admin som tagit bort profil.
		if(!isAdmin())
		{
			//Logga ut medlemmen.
			logout();
		}
		
			//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
			setMessage("Profilen är nu borttagen.", "index.php",MESSAGE);
			header("Location: ../message.php");
			exit();
	}
	else
	{
		//Någon annan försöker ta bort profilen.
		header("Location: index.php");
		exit();
	}

?>