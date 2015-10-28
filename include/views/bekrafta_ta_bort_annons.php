<?php

	//--Bootstrap--//
	require_once 'include/bootstrap.php';

	//Autentiserar att läsaren är admin.
	authorize();

	$db = new Database();

	//Hämtar annonsen som ska tas bort.
	$annons_id = mysql_real_escape_string($_GET['annons_id']);

	$annons_result = $db->hitta_annons($annons_id);
	$annons = mysqli_fetch_row($annons_result);

	//Om annons id är given i urlen.
	if(isAdmin() || get_user_id() == $annons[ANNONS_MEDLEM_ID])
	{

		echo "<h2>Bekräfta</h2>
			  <hr>";

			echo "<p>Bekräfta att du vill TA BORT ANNONSEN.</p>";
			echo "<a id='back_link' type='button' href='processing/ta_bort_annons.php?annons_id=".$annons_id."'>Jag bekräftar härmed att jag vill TA BORT den angivna annonsen med Annons ID: ".$annons_id.".</a>";
			echo "<br><br>";
			echo "<a id='back_link' type='button' href='kontrollera_annons.php'>Tillbaka</a>";
			echo "<br>";
			echo "<br>";

		//Inkluderar hem menyn.
		include 'include/views/_home_menu.php';
	}
	else
	{
		header("Location: index.php");
		exit();
	}


?>