<?php

	//Validerar email och lösenord så att de är på rätt format.
	function validate_registration($email,$password)
	{
		//regular expression med endast mellanslag.
		$regEmpty='/\A\s*\z/';

		//regular expression för e-mail.
		$regE_mail='/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

		//Testar email och lösenord mot de två regular expression. Kollar även längden på email och lösenord.
		//returnerar ifall validering lyckades.
		if(preg_match($regEmpty,$email) || strlen($email) == 0 || strlen($email) > 100)
		{
			return false;
		}
		else if(!preg_match($regE_mail,$email))
		{
			return false;
		}
		else if(preg_match($regEmpty,$password) || strlen($password) == 0 || strlen($password) > 78)
		{
			return false;
		}

		//Om input passerade kontrollen så är den enligt korrekt syntax och validerad.
		return true;
	}

 ?>