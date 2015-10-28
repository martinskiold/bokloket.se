						  		<?php

						  			//--Bootstrap--//
									require_once '../include/bootstrap.php';

									$medlem_id=mysql_real_escape_string($_GET['medlem_id']);

									if(isAdmin() || $medlem_id == get_user_id())
									{
										//Verifierar borttagningen.
										verify_remove();

								  		//Sätter sessionens meddelande och dirigerar vart användaren ska kunna ta sig vidare.
										setMessage("Är du säker på att du vill ta bort profilen? Tryck fortsätt.", "processing/remove_user_process.php?medlem_id=".$medlem_id,MESSAGE);
			
										//Redirect till sida som visar meddelande.
										header("Location: ../message.php");
										exit();
									}
									else
									{
										//Obehörig har försökt ta bort en profil som inte är hans genom en manipulerad get-request.
										header("Location: ../index.php");
										exit();
									}
								?>