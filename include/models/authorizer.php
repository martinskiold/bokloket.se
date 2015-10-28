<?php
	//Kontrollerar att obehörig ej får läsa innehåll. Om inte så körs en redirect till förstasidan.
	function authorize()
	{
		if(!isActive())
		{
			header("Location: "."index.php");
		}
	}

	//Kontrollerar att obehörig ej får läsa innehåll. Om inte så körs en redirect till förstasidan.
	function authorize_admin()
	{
		if(!isAdmin())
		{
			header("Location "."index.php");
		}
	}
?>