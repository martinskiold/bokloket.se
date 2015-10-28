<?php
	
	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	$annons_id = mysql_real_escape_string($_GET['annons_id']);

	$db = new Database();

	$result_annons = $db->hitta_annons($annons_id);
	$annons = mysqli_fetch_row($result_annons);

	//Autentiserar användaren.
	if(isAdmin() || get_user_id() == $annons[ANNONS_MEDLEM_ID])
	{
		$result = $db->ta_bort_annons($annons[ANNONS_ID]);
		if($result)
		{
			//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
			setMessage("Annonsen är nu borttagen. Klicka fortsätt för att återgå till din profil.", "profil.php?medlem_id=".get_user_id(),  MESSAGE);
		
			//Redirect till sida som visar meddelande.
			header("Location: ../message.php");
			exit();
		}
		else
		{
			//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
			setMessage("Annonsen kunde inte tas bort. Vänligen kontakta support. Klicka på tillbaka för att komma till din profil.", "profil.php?medlem_id=".get_user_id(),  ERROR);
			
			//Redirect till sida som visar meddelande.
			header("Location: ../message.php");
			exit();
		}
	}
	else
	{
		//Obehörig försöker ta bort annons med sql injection.
		header("Location: index.php");
	}

?>