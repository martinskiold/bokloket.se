<?php

	//--Bootstrap--
	require_once '../include/bootstrap.php';

	//Hämtar data från formen och escapar stringen för att förhindra sql injections.
	$namn=mysql_real_escape_string($_POST['namn']);
	$län=mysql_real_escape_string($_POST['län']);
	$ort=mysql_real_escape_string($_POST['ort']);
	$tfn=mysql_real_escape_string($_POST['tfn']);
	$email=mysql_real_escape_string($_POST['email']);
	$password=mysql_real_escape_string($_POST['password']);
	$retype_password=mysql_real_escape_string($_POST['retype_password']);
	$behörighet=mysql_real_escape_string($_POST['behörighet']);

	//Anropar hjälpmetod längre ned i filen.
	$isUnique = email_unique_check($email);

	//Om input ej finns i databasen.
	if($isUnique && $password==$retype_password)
	{
		//Genererar ett salt på 22 characters.
		$salt=generateSalt();

		//Kör salt och lösenord genom hashfunktionen sha1.
		$hash=sha1($salt.$password);

		//Upprättar anslutning till databasen.
		$db=new Database();

		//Genererar nyckelord.
		$keywords = $namn . " " . $län . " " . $ort;

		//Anropar metoden createUser som gör en INSTERT INTO-query mot databastabellen medlem.
		$result = $db->createUser($namn,$län,$ort,$tfn,$email,$hash,$salt,$behörighet, $keywords);

		$user_id = $db->getUserId($email);

		//Metodanrop till 'session.php' för att aktivera sessionen.
		login($email,$user_id);
			
		//Redirect till login-sidan.
		header("Location: ". "../profil.php?medlem_id=".$user_id);
	}
	else
	{
		//Felmeddelande.
		setMessage("Du har angivit ett email som redan finns registrerat på vår hemsida eller så har du skrivit två olika lösenord. Vänligen försök igen.", "index.php", ERROR);
	
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}



	//Kollar om email finns i databasen sen tidigare.
	function email_unique_check($email)
	{
		$isUnique = true;

		//Skapar anslutning till databasen.
		$db=new Database();

		//Hämtar de rader som har samma email.
		$result = $db->getUser($email);

		//Om det blev resultat.
		if($result)
		{
			//Finns det en rad betyder detta att ett konto med samma email redan existerar i databasen, och inget nytt konto ska skapas.
			if($row = mysqli_fetch_row($result))
			{
				//Email är ej unikt.
				$isUnique = false;
			}
		}

		//Avslutar anslutning till databasen.
		$db->close();

		return $isUnique;
	}

?>
