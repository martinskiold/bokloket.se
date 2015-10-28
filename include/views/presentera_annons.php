<?php

	//--Bootstrap--//
	require_once 'include/bootstrap.php';

	//Hämtar Get-request.
	$annons_id = $_GET['annons_id'];

	//Upprättar ny anslutning till databasen.
	$db = new Database();

	//Hämtar överensstämmande annons.
	$annons_result = $db->hitta_annons($annons_id);

	//Extraherar aktuell annons.
	$annons = mysqli_fetch_row($annons_result);

	//Hämtar överensstämmande medlem.
	$medlem_result = $db->getUserById($annons[ANNONS_MEDLEM_ID]);

	//Extraherar aktuell medlem.
	$medlem = mysqli_fetch_row($medlem_result);

	//Hämtar överensstämmande bok.
	$bok_result = $db->hitta_bok($annons[ANNONS_ISBN]);

	//Hämtar aktuell bok.
	$bok = mysqli_fetch_row($bok_result);


	//---ANTALET VISNINGAR---//

	//Antalet visningar.
	$antal_visningar = $annons[ANNONS_ANTAL_LASARE] + 1;

	//Uppdatera antalet visningar.
	$db->uppdatera_visningar($annons_id, $antal_visningar);

	//---HTML---//
	
		echo "
		<div class='option'>
			<img class='bookCover' src=".$annons[ANNONS_BILD].">
		</div>
			<div class='bookWrapper'>
				
					<h1>".$bok[BOK_TITEL]."</h1>
					Upplagd av: <a href='profil.php?medlem_id=".$medlem[MEDLEM_ID]."' >".$medlem[MEDLEM_NAMN]."</a>
					<hr>
					<h3>Författare: ".$bok[BOK_FORFATTARE]."</h3>
					<h3>Genre: ".$bok[BOK_GENRE]."</h3>
					<p>ISBN: ".$bok[BOK_ISBN]."</hp>
					
					<p>Typ av anonns: ".$annons[ANNONS_ANNONSTYP]."</p>
					<p>Antal visningar: ".$antal_visningar."</p>
					<p>Beskrivning: ".$annons[ANNONS_BESKRIVNING]."</p>
					<h1>Pris: ".$annons[ANNONS_PRIS]."</h1>
			</div>

			<div class='contactForm'>
			<h1>Kontakta ".$medlem[MEDLEM_NAMN]."</h>
			<form method='POST' action='processing/mail_process.php?email=".$medlem[MEDLEM_EMAIL]."&annons_id=".$annons[ANNONS_ID]."&titel=".$bok[BOK_TITEL]."' onsubmit='return validate_kontakt();'>
			<p><input class='input_text' id='name_sender' name='name_sender' type='text' required placeholder='Ditt namn...'></p>
			<p><input class='input_text' id='email_sender' name='email_sender' type='text' requierd placeholder='Din emailadress...'></p>
			<p><input class='input_text' id='phone_nr_sender' name='phone_nr_sender' type='text' requierd placeholder='Telefonnummer...'></p>
			<p><textarea class='input_text_area' id='message_sender' name='message_sender' type='text' requierd placeholder='Skriv ett meddelande...'></textarea></p>
			<input class='btn' type='submit' name='send_mail' value='Skicka'>
			</form>
			</div>
			
	";
	
	

	include 'include/views/_home_menu.php';
?>