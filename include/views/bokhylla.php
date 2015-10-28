<?php
	
	define("PATH_TO_TA_BORT_ANNONS", "bekrafta_ta_bort_annons.php?");

	//--Bootstrap--//
	require_once 'include/bootstrap.php';

	$medlem_id = $_GET['medlem_id'];

	//Ny connection
	$db = new Database();

	//Hämtar aktuell medlem.
	$medlem_result = $db->getUserById($medlem_id);
	$medlem = mysqli_fetch_row($medlem_result);

	//Query för att hämta information från medlemmens alla annonser.
	$result = $db->medlem_annonser($medlem_id);
	
	echo "<h2>".$medlem[MEDLEM_NAMN]."'s bokhylla</h2>";
	echo "<hr>";
	echo "<div class='bookshelf'>";

	//Hämtar alla rader ur resultatet.
	while($annons = mysqli_fetch_row($result))
	{
		//Hämtar bokinformation om given bok.
		$result_bok = $db->hitta_bok($annons[ANNONS_ISBN]);

		//Hämtar ut raden med information om aktuell bok.
		$bok = mysqli_fetch_row($result_bok);

		echo   "
				<div class='sokresultat_alla'>
					<div class='sokresultat'>
						<table>
							<tr>	
								<td class='sokresultat_bild'>
									<a href='presentera_annons.php?annons_id=".$annons[ANNONS_ID]."'><img class='search_img' src='".$annons[ANNONS_BILD]."'></a>
								</td>
								<td>
									<a id='search_title' href='presentera_annons.php?annons_id=".$annons[ANNONS_ID]."'>".$bok[BOK_TITEL]."</a>
									<h3>".$bok[BOK_FORFATTARE]."</h3>
									<h3>".$bok[BOK_GENRE]."</h3>
									<p>ISBN:".$annons[ANNONS_ISBN]."</p>
								</td>
							</tr>
						</table>
						";

						//Om användaren kollar sin egen bokhylla.
						if(get_user_id() == $medlem_id || isAdmin())
						{
							$get_request_ta_bort = PATH_TO_TA_BORT_ANNONS."annons_id=".$annons[ANNONS_ID];
							echo "<a href=".$get_request_ta_bort."><h3 class='red'>(x) Ta bort annons</h3></a>";
						}

						echo "
					</div>
				</div>
				<br>
				<hr id='search_ruler'>
				";
	}

	echo "</div>";

?>