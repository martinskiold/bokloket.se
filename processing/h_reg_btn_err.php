<?php
	
	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
	setMessage("Du kan tyvärr inte registrera en annons förrän du är inloggad. Därför ber vi dig logga in/registrera dig som medlem på bokloket.se innan du försöker registrera en annons igen. Vi på bokloket.se vill påminna er om att det är gratis att lägga ut annonser på hemsidan och att det därför inte är en dum idé att skapa medlemskonto på hemsidan.", "index.php", MESSAGE);
		
	//Redirect till sida som visar meddelande.
	header("Location: ../message.php");
	exit();

?>