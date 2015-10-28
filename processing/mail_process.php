<?php

	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	//Upprättar anslutning till databasen.
	$db = new Database();

	//Hämtar data från annonsen. Fås med hjälp av get request.
	$receiver_email = mysql_real_escape_string($_GET['email']);
	$annons_id=mysql_real_escape_string($_GET['annons_id']);
	$titel=mysql_real_escape_string($_GET['titel']);

	//Hämtar data från formen
	$sendername = mysql_real_escape_string($_POST['name_sender']);
	$senderemail= mysql_real_escape_string($_POST['email_sender']);
	$senderphone = mysql_real_escape_string($_POST['phone_nr_sender']);
	$sendermessage = mysql_real_escape_string($_POST['message_sender']);

	/*
	//Sätter parametrarna för mail-funktionen
	$to = $receiver_email;
	$subject = $titel . " (Annons: " . $annons_id . ")";
	$headers = "From: " . $senderemail . "\r\n";
	*/

	//Lägger in i databasen.
	$result = $db->lagra_mail_data($senderemail, $annons_id, $sendername, $senderphone, $sendermessage);

	if($result)
	{
		//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
		setMessage("Meddelandet är skickat! Klicka fortsätt för att komma till förstasidan", "index.php", MESSAGE);
		
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}
	else
	{
		//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
		setMessage("Meddelandet är skickat! Klicka fortsätt för att komma till förstasidan", "presentera_annons.php?annons_id=".$annons_id, ERROR);
		
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}

	//mail($to, $subject, $message, $headers);

?>