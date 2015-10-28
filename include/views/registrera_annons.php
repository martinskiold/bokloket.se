			<?php

				//--Bootstrap--//
				require_once 'include/bootstrap.php';

				//--Autentiserar besökare--//
				authorize();

			?>

			<div class="regcenter">
					<form class="regFields" method='POST' action='processing/registrera_annons_process.php' enctype='multipart/form-data' onsubmit='return validate_add();'>
						<br>
						<h1 class="regh1" >Registrera ny annons</h1>
						<p class="white">Bokens titel<br><input id="titel" class="input_text" type='text' name='book_title' placeholder='Skriv bokens titel...' required></p>
						<p class="white">Författare till boken<br><input id="forfattare" class="input_text" type='text' name='book_authors' placeholder='Skriv bokens författare...' required></p>
						<p class="white">Genre<br><input id="genre" class="input_text" type='text' name='book_genre' placeholder='Skriv bokens genre...' required></p>
						<p class="white">ISBN<br><input id="isbn" class="input_text"type='text' name='book_isbn' placeholder='Skriv bokens isbn...' required></p>
					
						<p class="white">Beskrivning<br><textarea id="beskrivning" class="input_text_area" type='text' name='add_description' placeholder='Skriv annonsinformation...' required></textarea>
						<p class="white">Pris<br><input id="pris" class="input_text" type='text' name='add_price' placeholder='Välj pris...' required></p>
						<p class="white">Byta eller sälja?</p>
						<p class="white"><input type='radio' value='byte' name='annonstyp' required>Bytes</p>
						<p class="white"><input type='radio' value='försäljning' name='annonstyp'>Säljes</p>
						<p class="white"><input type='radio' value='byte/försäljning' name='annonstyp'>Bytes/Säljes</p>
						<p class="white">Ladda upp en bild<br><input class="white" type='file' name='annonsbild' required></p>
						<a href="https://www.goodreads.com/search?utf8=%E2%9C%93&query=" class="white" target="_blank">Svårt att hitta bild? Hämta bild här!</a>
						<br><br>
						<input class="btn" type='submit' name='reg_add_btn' value='Registrera annons'>
						<br><br>
					</form>
			</div>