<?php

	ob_start();

	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	//Hämtar input och escapar string för att förhindra sql injections.
	$email=mysql_real_escape_string($_POST['email']);
	$pass=mysql_real_escape_string($_POST['password']);

	//Upprättar anslutning till databasen.
	$db = new Database();

	//SELECT-query mot databasen för att hämta eventuell rad med användarens hash och salt.
	$result = $db->getUser($email);

	//Hämtar data ur resultatsraden.
	if($row = mysqli_fetch_row($result))
	{
		//Hämtar det hashade lösenordet och saltet.
		$db_hash=$row[MEDLEM_HASH];
		$db_salt=$row[MEDLEM_SALT];

		//Hashar det givna lösenordet tillsammans med saltet från databasen.
		$hash=sha1($db_salt.$pass);

		//Om lösenordet stämmer överens med det lagrade lösenordet i databasen.
		if($hash==$db_hash)
		{
			$user_id = $db->getUserId($email);

			//Metodanrop till 'session.php' för att aktivera sessionen.
			login($email, $user_id, $row[MEDLEM_BEHORIGHET]);
				
			//Redirect till login-sidan.
			header("Location: ". "../profil.php?medlem_id=".$user_id);
			exit();
		}
		else
		{
			//Felmeddelande.
			setMessage("Du har angivit fel lösenord. Vänligen försök igen.", "index.php", ERROR);
		
			//Redirect till sida som visar meddelande.
			header("Location: ../message.php");
			exit();
		}
	}
	else
	{
		//Felmeddelande.
		setMessage("Du har angivit fel email. Vänligen försök igen.", "index.php", ERROR);
	
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();	}

?>