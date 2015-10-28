<?php
	
	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	$db = new Database();

	$annonser_result = $db->okontrollerade_annonser();

	$isSuccess=true;

	while($annons = mysqli_fetch_row($annonser_result))
	{

		$annons_result = $db->godkann_annons($annons[ANNONS_ID]);

		//Om det gick att godkänna annons.
		if(!$annons_result)
		{
			$isSuccess=false;
		}
	}

	//Om alla annonser kunde godkännas.
	if($isSuccess)
	{
		//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
		setMessage("Alla liggandes annonser är nu godkända! Klicka fortsätt för att komma till din profil.", "profil.php?medlem_id=".get_user_id(),  MESSAGE);
		
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}
	else
	{
		//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
		setMessage("Alla annonser kunde inte godkännas. Vänligen kontakta support", "profil.php?medlem_id=".get_user_id(),  ERROR);
		
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}

?>