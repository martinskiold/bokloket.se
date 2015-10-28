<?php
	
	//--Bootstrap--//
	require_once '../include/bootstrap.php';

	//Hämtar bokdata från formen
	$title=mysql_real_escape_string($_POST['book_title']);
	$author=mysql_real_escape_string($_POST['book_authors']);
	$genre=mysql_real_escape_string($_POST['book_genre']);
	$isbn=mysql_real_escape_string($_POST['book_isbn']);
	
	//Hämtar annonsdata från formen
	$description=mysql_real_escape_string($_POST['add_description']);
	$price=mysql_real_escape_string($_POST['add_price']);
	$annonstyp=mysql_real_escape_string($_POST['annonstyp']);
	$medlem_id = get_user_id();

	//Upprättar anslutning till databasen.
	$db = new Database();
	
	//Hämtar id:t för senast tillagda annons.
	$result = $db->senast_annons_id();

	//Extraherar information ur resultatet.
	$row = mysqli_fetch_row($result);
	
	//Sätt det nya id:t
	$new_filename = $row[ANNONS_ID] + 1;
	
	//De tillåtna filtyperna.
	$allowed = array("gif", "jpeg", "jpg", "png");

	//Delar upp strängen vid punkt.
	$temp = explode(".", $_FILES["annonsbild"]["name"]);

	//Sparar filändelsen.
	$type = end($temp);

	//Om fil och filändelsen överensstämmer med de tillåtna filtyperna och filstorleken ej överskrider 2MB.
	if ((($_FILES["annonsbild"]["type"] == "image/gif")
	|| ($_FILES["annonsbild"]["type"] == "image/jpeg")
	|| ($_FILES["annonsbild"]["type"] == "image/jpg")
	|| ($_FILES["annonsbild"]["type"] == "image/pjpeg")
	|| ($_FILES["annonsbild"]["type"] == "image/x-png")
	|| ($_FILES["annonsbild"]["type"] == "image/png"))
	&& ($_FILES["annonsbild"]["size"] < 2000000)
	&& in_array($type, $allowed))
	{
		//Flyttar på den uppladdade bilden till mappen uploads i mappen assets.
		$moved = move_uploaded_file($_FILES["annonsbild"]["tmp_name"], '../assets/uploads/'. $new_filename . '.' . end($temp));

		//Om bilden uppladdades korrekt.
		if($moved)
		{
			//--Sökväg till den nya bildfilen--//
			$img = 'assets/uploads/'.$new_filename.'.'.end($temp);
		}
		else
		{
			//Sätter sessionens 'meddelande' och dirigerar vart användaren ska kunna ta sig vidare.
			setMessage("Annonsen kunde tyvärr inte registreras då det finns problem med den uppladdade bildfilen. Var god kontakta support.", "registrera_annons.php", ERROR);
		
			//Redirect till sida som visar meddelande.
			header("Location: ../message.php");
			exit();	
		}

	}
	else
	{
		//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
		setMessage("Annonsen kunde tyvärr inte registreras då den uppladdade bildfilen ej följer godkänt format. Vänligen ladda upp en bild av typen jpg/jpeg/gif/png. Max storlek 2MB.", "registrera_annons.php", ERROR);
		
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}
	


	//
	//--Sparar information i databasen--//
	//

	//Lagrar boken i databasen.
	$db->ny_bok($isbn,$title,$author,$genre);

	//Hämtar medlem.
	$result_medlem = $db->getUserById(get_user_id());

	//Extraherar medlem ur resultatsraderna
	$medlem = mysqli_fetch_row($result_medlem);

	//Genererar nyckelord. Lägger till medlemmens namn så att annonssökningar på personer även visar dess annonser.
	$keywords = $title." ".$author." ".$genre." ".$isbn." ".$price." ".$annonstyp." ".$medlem[MEDLEM_NAMN];

	//Genererar nyckelord ur beskrivningen.
	$description_keywords = explode(" ", $description);
	foreach ($description_keywords as $keyword) 
	{
		//Varje ord skiljt med mellanslag blir nyckelord.
		$keywords = $keywords." ".$keyword;
	}

	//Sparar annonsinformationen i databasen.
	$result_annons = $db->ny_annons($medlem[MEDLEM_ID],$isbn,$annonstyp,$price,$description,$img,$keywords);

	//Om queryn för att skapa ny annons i databasen misslyckades.
	if(!$result_annons)
	{
		//Felmeddelande.
		setMessage("Annonsen kunde tyvärr inte registreras. Detta beror förmodligen på att din inloggningssession tagit slut. Var god logga ut och in och pröva igen. Skulle problemet återkomma, vänligen kontakta support.", "index.php",ERROR);
	
		//Redirect till sida som visar meddelande.
		header("Location: ../message.php");
		exit();
	}

	//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
	setMessage("Annonsen är nu inlagd och finns tillgänglig för samtliga medlemmar och läsare genom sökfunktionen.", "profil.php?medlem_id=".get_user_id(),MESSAGE);
	
	//Redirect till sida som visar meddelande.
	header("Location: ../message.php");
	exit();

?>