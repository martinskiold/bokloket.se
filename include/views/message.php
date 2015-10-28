<?php

	//--Bootstrap--//
	require_once 'include/bootstrap.php';

	//Om det finns ett meddelande liggandes.
	if(messageWaiting())
	{	
		echo "<h2>Meddelande</h2>
			  <hr>";
			  
		//Hämtar meddelande och metadata.
		$messageData = getMessage();

		//Om det är ett errormeddelande.
		if($messageData[2]==0)
		{
			echo "<p>".$messageData[0]."</p>";
			echo "<a id='back_link' type='button' href='". $messageData[1] ."'>Tillbaka</a>";
			echo "<br>";
			echo "<br>";
		}
		else
		{
			echo "<p>".$messageData[0]."</p>";
			echo "<a id='back_link' type='button' href='". $messageData[1] ."'>Fortsätt</a>";
			echo "<br>";
			echo "<br>";
		}

		include 'include/views/_home_menu.php';

	}
	else
	{
		//Om det inte finns ett meddelande liggandes så redirectas medlem till förstasidan.
		header("Location: index.php");
	}

?>