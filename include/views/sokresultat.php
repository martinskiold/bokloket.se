<?php

	//--Bootstrap--//
	require_once 'include/bootstrap.php';

	define("PATH_TO_ANNONS", "presentera_annons.php?");
	define("PATH_TO_MEDLEM", "profil.php?");

	//Upprättar anslutning till databasen.
	$db = new Database();

	//--Hämtar sökresultat--//
	$search_result = get_search_result();

	//Fördelar resultatsarrayer i respektive variabel.
	$annonser_prio = $search_result[SOK_ANNONSER_PRIO];
	$annonser_ejprio = $search_result[SOK_ANNONSER_EJPRIO];
	$medlemmar_prio = $search_result[SOK_MEDLEMMAR_PRIO];
	$medlemmar_ejprio = $search_result[SOK_MEDLEMMAR_EJPRIO];




	//---ANNONSRESULTAT---//
	//(sökresultatet för annonser innehåller såväl annonsinformation som bokinformation.)

	echo "<h2>Sökresultat</h2>
		  <hr>";

	//Div för alla annons-sökresultat.
	echo "<div class='sokresultat_alla'>";

	//Itererar de prioriterade annonserna.
	foreach ($annonser_prio as $annons_prio) {

		//Specificerar URL för GET-requestet.
		$get_request = PATH_TO_ANNONS."annons_id=".$annons_prio[ANNONS_ID];

		//SÖKRESULTAT FÖR PRIORITERADE ANNONSER.
		echo"
				<div class='sokresultat'>
				<table>
					<tr>	
						<td class='sokresultat_bild'>				
							<a href=".$get_request."><img class='search_img' src=".$annons_prio[ANNONS_BILD]."></a>
						</td>
						<td>
							<a id='search_title' href=".$get_request.">".$annons_prio[ANNONS_MAX + 1 + BOK_TITEL]."</a>
							<h3>".$annons_prio[ANNONS_MAX + 1 + BOK_FORFATTARE]."</h3>
							<h3>".$annons_prio[ANNONS_MAX + 1 + BOK_GENRE]."</h3>
							<p>ISBN:".$annons_prio[ANNONS_ISBN]."</p>
							<p>".$annons_prio[ANNONS_ANNONSTYP]."</p>
			";

			//Hämtar medlems id.
			$medlem_id = $annons_prio[ANNONS_MEDLEM_ID];

			//Hämtar medlem med query.
			$result = $db->getUserById($medlem_id);

			//Extraherar medlemmen ur queryresultatet.
			$medlem=mysqli_fetch_row($result);

			echo"
							<p>Uppladdad av: ".$medlem[MEDLEM_NAMN]."</p>
							<p>Av: ".$medlem[MEDLEM_BEHORIGHET]." </p> 
							<h3>Pris: ".$annons_prio[ANNONS_PRIS]." </h3> 
						</td>
					</tr>
					</table>
					</div>
					<br>
					<hr id='search_ruler'>
			";
	}

	//Itererar de ej prioriterade annonserna.
	foreach ($annonser_ejprio as $annons_ejprio) {

		//Specificerar URL för GET-requestet.
		$get_request = PATH_TO_ANNONS."annons_id=".$annons_ejprio[ANNONS_ID];

		//SÖKRESULTAT FÖR EJ PRIORITERADE ANNONSER.
		echo"
				<div class='sokresultat'>
				<table>
					<tr>	
						<td class='sokresultat_bild'>				
							<a href=".$get_request."><img class='search_img' src=".$annons_ejprio[ANNONS_BILD]."></a>
						</td>
						<td>

							<a id='search_title' href=".$get_request.">".$annons_ejprio[ANNONS_MAX + 1 + BOK_TITEL]."</a>
							<h3>".$annons_ejprio[ANNONS_MAX + 1 + BOK_FORFATTARE]."</h3>
							<h3>".$annons_ejprio[ANNONS_MAX + 1 + BOK_GENRE]."</h3>
							<p>ISBN:".$annons_ejprio[ANNONS_ISBN]."</p>
							<p>".$annons_ejprio[ANNONS_ANNONSTYP]."</p>
			";

			//Hämtar medlems id.
			$medlem_id = $annons_ejprio[ANNONS_MEDLEM_ID];

			//Hämtar medlem med query.
			$result = $db->getUserById($medlem_id);

			//Extraherar medlemmen ur queryresultatet.
			$medlem=mysqli_fetch_row($result);

			echo"
							<p>Uppladdad av: ".$medlem[MEDLEM_NAMN]."</p>
							<p>Av: ".$medlem[MEDLEM_BEHORIGHET]." </p> 
							<h3>Pris: ".$annons_ejprio[ANNONS_PRIS]." </h3> 
						</td>
					</tr>
					</table>
					</div>
					<br>
					<hr id='search_ruler'>
			";

	}



	//---MEDLEMSRESULTAT---//

	//Itererar de prioriterade medlemmarna.
	foreach ($medlemmar_prio as $medlem_prio) {

		//Specificerar URL för GET-requestet.
		$get_request = PATH_TO_MEDLEM."medlem_id=".$medlem_prio[MEDLEM_ID];

		//SÖKRESULTAT FÖR PRIORITERADE MEDLEMMAR.
		echo"
				<div class='sokresultat'>
				<table>
					<tr>	
						<td class='sokresultat_bild'>				
							<a href=".$get_request."><img class='avatar' src=assets/img/avatar.jpg></a>
						</td>
						<td>
							<a id='search_title' href=".$get_request.">".$medlem_prio[MEDLEM_NAMN]."</a>
							<h3>".$medlem_prio[MEDLEM_BEHORIGHET]."</h3>
							<h3>".$medlem_prio[MEDLEM_LAN]."</h3>
						</td>
					</tr>
				</table>
				</div>
				<br>
				<hr id='search_ruler'>
			";
	}

	//Itererar de ej prioriterade annonserna.
	foreach ($medlemmar_ejprio as $medlem_ejprio) {

		//Specificerar URL för GET-requestet.
		$get_request = PATH_TO_MEDLEM."medlem_id=".$medlem_ejprio[MEDLEM_ID];

		//SÖKRESULTAT FÖR PRIORITERADE MEDLEMMAR.
		echo"
				<div class='sokresultat'>
				<table>
					<tr>	
						<td class='sokresultat_bild'>				
							<a href=".$get_request."><img class='avatar' src=assets/img/avatar.jpg></a>
						</td>
						<td>
							<a id='search_title' href=".$get_request.">".$medlem_ejprio[MEDLEM_NAMN]."</a>
							<h3>".$medlem_ejprio[MEDLEM_BEHORIGHET]."</h3>
							<h3>".$medlem_ejprio[MEDLEM_LAN]."</h3>
						</td>
					</tr>
				</table>
				</div>
				<br>
				<hr id='search_ruler'>
			";

	}

	//Stänger sokresultats diven.
	echo "</div>";

?>