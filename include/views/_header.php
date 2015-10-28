<!DOCTYPE html>
<html>
	<head>
		<title>bokloket.se</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/main.css">
	</head>
	<body>
		<div class="header">
			<div class="logotype_wrapper">
				<a class="logo_text" href="index.php">bokloket.se</a>
				<a href="index.php"><img class="logotype" src="assets/img/bokloket_logotyp.png"></a>
			</div>
			<div class="search_wrapper">
				<form class="search_form" action="processing/sok.php" method="GET">
					<input class="search_input" name="search_input" type="text" placeholder="Sök här..." required>
					<input class="btn search_btn" type="submit" value="Sök">
				</form>
			</div>
			<div class="registrera_annons_wrapper">
				<?php

					//--Bootstrap--
					require_once 'include/bootstrap.php';

					//Om läsare är inloggad.
					if(isActive())
					{
						//Registrera annons knapp.
						echo "<button id='h_reg_annons_btn' class='btn big_btn' type='button'>Registrera Annons</button>";
					}
					else
					{
						//Registrera annons knapp som uppmanar användaren att logga in först.
						echo "<button id='reg_annons_err' class='btn big_btn' type='button'>Registrera Annons</button>";
					}

				?>
			</div>
			<div class="login_wrapper">
				<?php

					//--Bootstrap--
					require_once 'include/bootstrap.php';

					if(isActive())
					{
						echo "<button id='min_sida_btn' class='btn small_btn' type='button'>Min Sida</button>
								<br>
							  <button id='logout_btn' class='btn small_btn' type='button'>Logga ut</button>
							  ";  
							  
					}
					else
					{
						echo "
						<button id='reg_link' class='btn small_btn' type='button'>Registrera</button>
						<button id='login_btn' class='btn small_btn' type='button'>Logga in</button>
							  <br>
							  ";
							  
					}

				?>
			</div>
			<div class="dropdown_login_wrapper">
				<a id="close_dropdown_login" class="link white" type="button">close(x)</a>
				  <h1 class="white">Logga in!</h1>
				  <form method="POST" action="processing/login_process.php" onsubmit="return validate_login();">
				  	<br>
				  	<label class="white">E-mail</label>
				  	<br>
				    <input id="email" class="input_text" name="email" type="text" placeholder="Skriv din email..." autofocus="autofocus" required>
				    <br>
				    <br>
				    <label class="white">Password</label>
				    <br>
				    <input id="password" class="input_text" name="password" type="password" placeholder="Skriv ditt password..." required>
				    <br>
				    <br>
				    <input class="btn" type="submit" value="Logga in">
				  </form>
			</div>
		</div>
		<div class="dropdown_register_user_wrapper">
			<a id="close_dropdown_register" class="link white" type="button">close(x)</a>
				  <h1 class="white">Registrera medlem</h1>
				  <form method="POST" action="processing/registrera_medlem_process.php" onsubmit="return validate_registration();">
				  				<label class="white">Namn</label>
				    			<br>
				    			<input id="namn" class="input_text" name="namn" type="text" placeholder="Förnamn & efternamn..." autofocus="autofocus" required>
				    			<br>
				    			<br>
				  				<label class="white">Län</label>
				    			<br>
				    			<input id="lan" class="input_text" name="län" type="text" placeholder="Länet du bor i..." required>
				  				<br>
				  				<br>
				  				<label class="white">Ort</label>
				    			<br>
				    			<input id="ort" class="input_text" name="ort" type="text" placeholder="Orten du bor i..." required>
				  				<br>
				  				<br>
				  				<label class="white">Telefonnummer</label>
				    			<br>
				    			<input id="tfn" class="input_text" name="tfn" type="text" placeholder="Ditt telefonnummer..." required>
				  				<br>
				  				<br>
								<label class="white">E-mail</label>
				  				<br>
				    			<input id="reg_email" class="input_text" name="email" type="text" placeholder="Välj e-mail..." required>
				    			<br>
				    			<br>
				  				<label class="white">Välj lösenord</label>
				    			<br>
				    			<input id="reg_password" class="input_text" name="password" type="password" placeholder="Välj lösenord..." required>
				    			<br>
				    			<br>
								<label class="white">Skriv om lösenord</label>
				    			<br>
				    			<input id="retype_password" class="input_text" name="retype_password" type="password" placeholder="Skriv om lösenord..." required>
				    			<br>
				    			<br>
								<label class="white">Är du privatperson eller företag?</label>
				    			<br>
				    			<p class="white inline">Privatperson</p><input name="behörighet" type="radio" value="Privatperson" required>
				    			<p class="white inline">Företag</p><input name="behörighet" type="radio" value="Företag" required>
				    			<br>
				  				<input class="btn" type="submit" value="Registrera mig">
				  				<br>
				  				<br>
				  </form>
			</div>
		<div class="content">
