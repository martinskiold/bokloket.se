<?php

		//Lokala konstanter.
		define("PATH_TO_GODKANN", "processing/godkann_annons.php?");
		define("PATH_TO_TA_BORT_ANNONS", "bekrafta_ta_bort_annons.php?");
		define("PATH_TO_ANNONS", "presentera_annons.php?");
		
		//--Bootstrap--//
		require_once 'include/bootstrap.php';
		
		//--Autentiserar besökare--//
		authorize_admin();
		
		//Upprättar anslutning till databasen.
		$db = new Database();

		//Hämtar alla annonser som ännu ej är godkända.
		$result = $db->okontrollerade_annonser();

		echo 	"	
				<h2>Annonser väntandes på publicering:</h2>
				<a href='processing/godkann_alla_annonser.php' class='green'><h2 class='green'>(x) Godkänn ALLA annonser</h2></a>
				<hr>
				";

		//Div för alla okontrollerade annonser.
		echo 	"
				<div class='sokresultat_alla'>
				";


		//Iterera alla icke-godkända annonser och genererar html.
		while($annons = mysqli_fetch_row($result))
		{
			//Hämtar annonsens aktuella bok.
			$bok_result = $db->hitta_bok($annons[ANNONS_ISBN]);

			//Hämtar annonsens aktuella medlem.
			$medlem_result = $db->getUserById($annons[ANNONS_MEDLEM_ID]);

			//Extraherar rad.
			$bok = mysqli_fetch_row($bok_result);
			$medlem = mysqli_fetch_row($medlem_result);

			//Specificerar URL för GET-request.
			$get_request = PATH_TO_ANNONS."annons_id=".$annons[ANNONS_ID];
			$get_request_godkann = PATH_TO_GODKANN."annons_id=".$annons[ANNONS_ID];
			$get_request_ta_bort = PATH_TO_TA_BORT_ANNONS."annons_id=".$annons[ANNONS_ID];

			echo"
					<div class='sokresultat'>
					<table>
						<tr>	
							<td class='sokresultat_bild'>				
								<a href=".$get_request."><img class='search_img' src=".$annons[ANNONS_BILD]."></a>
							</td>
							<td>
								<a id='search_title' href=".$get_request.">".$bok[BOK_TITEL]."</a>
								<h3>".$bok[BOK_FORFATTARE]."</h3>
								<h3>".$bok[BOK_GENRE]."</h3>
								<p>ISBN:".$annons[ANNONS_ISBN]."</p>
								<p>".$annons[ANNONS_ANNONSTYP]."</p>
								<p>Uppladdad av: ".$medlem[MEDLEM_NAMN]."</p>
								<p>Av: ".$medlem[MEDLEM_BEHORIGHET]." </p> 
								<h3>Pris: ".$annons[ANNONS_PRIS]." </h3> 
							</td>
						</tr>
					</table>
					</div>
					<a href=".$get_request_godkann."><h3 class='green'>(x) Godkänn annons</h3></a>
					<a href=".$get_request_ta_bort."><h3 class='red'>(x) Ta bort annons</h3></a>
					<br>
					<hr id='search_ruler'>
				";
	}

?>