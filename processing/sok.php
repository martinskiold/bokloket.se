<?php

	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	ob_start();

	//Hämtar input och escapar string för att förhindra sql injections.
	$search=mysql_real_escape_string($_GET['search_input']);

	//Delar upp input i söktaggar där mellanslag skiljer söktaggarna åt.
	$söktaggar = explode(" ",$search);

	//Itererar alla söktaggar
	foreach ($söktaggar as $söktag) 
	{
		//Upprättar anslutning till databasen.
		$db = new Database();

		//Hämtar rader med överensstämmande keywords.
		$resultat_annons = $db->search_annons($söktag);
		$resultat_medlem = $db->search_medlem($söktag);

		//Arrayer för att ange prioritetsvisning.
		$annonser_prio = array();
		$annonser_ejprio = array();
		$medlemmar_prio = array();
		$medlemmar_ejprio = array();

		//Går igenom alla resultatsrader.
		while($row = mysqli_fetch_row($resultat_annons))
		{
			echo $row[ANNONS_MEDLEM_ID]."   ".$row[ANNONS_NYCKELORD]." SLUT ANNONS ";
			//Hämtar medlemmen som överensstämmer med annonsen.
			$annons_medlem = $db->getUserById($row[ANNONS_MEDLEM_ID]);

			$medlem = mysqli_fetch_row($annons_medlem);

			//Om sökresultat är ett företag får den högre prioritet.
			if($medlem[MEDLEM_BEHORIGHET]=="Företag")
			{
				//Resultatsraden läggs till prioritetlistan.
				array_push($annonser_prio, $row);
			}
			else
			{
				array_push($annonser_ejprio,$row);
			}
		}
		
		//Går igenom alla resultatsrader 
		while($row = mysqli_fetch_row($resultat_medlem))
		{
			echo $row[MEDLEM_NYCKELORD]."   ".$row[MEDLEM_NAMN]." SLUT MEDLEM ";
			//Om sökresultat är ett företag får den högre prioritet.
			if($row[MEDLEM_BEHORIGHET]=="Företag")
			{
				//Resultatsraden läggs till prioritetlistan.
				array_push($medlemmar_prio,$row);
			}
			else
			{
				array_push($medlemmar_ejprio,$row);
			}
		}

		//--REDIRECT TILL SÖKRESULTAT--//

		//Sätter sessionsvariabler för sökresultatet.
		set_search_result($annonser_prio,$annonser_ejprio,$medlemmar_prio,$medlemmar_ejprio);

		//Redirect till sökresultat.
		header("Location: ../sokresultat.php");
		exit();
	}

?>