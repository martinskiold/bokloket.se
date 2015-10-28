
			<?php
				
					//--Bootstrap--//
					require_once 'include/bootstrap.php';

					$medlem_id=mysql_real_escape_string($_GET['medlem_id']);

					//Upprättar anslutning till databasen.
					$db = new Database();

					//Hämtar den aktuella medlemmen.
					$result = $db->getUserById($medlem_id);

					//Hämtar första raden ur resultatet.
					$row = mysqli_fetch_row($result);

						//Om läsaren ser sin egen profil.
						if(get_user_id()==$row[MEDLEM_ID] || isAdmin())
						{
							//Då kan privat information skrivas ut.
							echo"
							<div class='sokresultat_alla profil_wrapper'>
							  <h2>Profil</h2>
							  <hr>
							<div class='sokresultat'>
							<table>
								<tr>	
									<td class='sokresultat_bild'>
										<img class='avatar' src=assets/img/avatar.jpg>
									</td>
								<td>

								  <p class='inline'><b>Medlems-id:</b> ".$row[MEDLEM_ID]."</p>
								  <br>
								  <p class='inline'><b>Namn:</b> ".$row[MEDLEM_NAMN]."</p>
								  <br>
								  <p class='inline'><b>Län:</b> ".$row[MEDLEM_LAN]."</p>
								  <br>
								  <p class='inline'><b>Ort:</b> ".$row[MEDLEM_ORT]."</p>
								  <br>
								  <p class='inline'><b>Telefonnummer:</b> ".$row[MEDLEM_TFN]."</p>
								  <br>
								  <p class='inline'><b>E-mail:</b> ".$row[MEDLEM_EMAIL]."</p>
								  <br>
								  <p class='inline'><b>Behörighet:</b> ".$row[MEDLEM_BEHORIGHET]."</p>
								  <br>
								  <br>
								  ";

								  //Om sessionen bedrivs av en admin.
								  if(isAdmin())
								  {
								  	echo "
								  	<a class='btn big_btn' type='button' href='kontrollera_annons.php'>Publicera/Ta bort nya annonser</a>
								  	";
								  }
								  else
								  {
								  	echo "
								  		<a class='btn' type='button' href='processing/remove_user.php?medlem_id=".$row[MEDLEM_ID]."'>Ta bort profil</a>
								  		";
								  }
								  	echo "
										  <br>
										  <br>
										  <a class='btn' type='button' href='bokhylla.php?medlem_id=".$medlem_id."'>Bokhylla</a>
								  		  <br>
								  		  <br>
								  		  <button id='reg_annons_btn' class='btn' type='button'>Registrera Annons</button>
										  <br>
										  <br>
										</td>
										</tr>
									</table>
									</div>
									</div>
						  				";
						}
						else
						{
							echo "
							<div class='sokresultat_alla profil_wrapper'>
							<h2>Profil</h2>
							<hr>
							<div class='sokresultat'>
							<table>
								<tr>	
									<td class='sokresultat_bild'>
										<img class='avatar' src=assets/img/avatar.jpg>
									</td>
								<td>
								
								  <p class='inline'><b>Medlems-id:</b> ".$row[MEDLEM_ID]."</p>
								  <br>
								  <p class='inline'><b>Namn:</b> ".$row[MEDLEM_NAMN]."</p>
								  <br>
								  <p class='inline'><b>Län:</b> ".$row[MEDLEM_LAN]."</p>
								  <br>
								  <p class='inline'><b>Ort:</b> ".$row[MEDLEM_ORT]."</p>
								  <br>
								  <a class='btn' type='button' href='bokhylla.php?medlem_id=".$medlem_id."'>Bokhylla</a>
						  		  <br>
						  		  <button id='reg_annons_btn' class='btn' type='button'>Registrera Annons</button>
								  <br>
								  <br>
								  </td>
								</tr>
							</table>
							</div>
							</div>
								  ";
						}


						 //Inkluderar home menu.
						 include '_home_menu.php';
			?>