<?php
	//Databasen som ska användas.
	define("DB_SERVER","localhost");
	define("DB_USER","root");
	define("DB_PASS","root");
	define("DB_NAME","bokloket");


	//
	//--Tabellkonstanter--
	//

	//Konstanter för kolumnnummer i databastabellen över kontakt mellan annonsör och läsare.
	define("KONTAKT_TABELL","kontakt");
	define("KONTAKT_EMAIL",0);
	define("KONTAKT_ANNONS_ID",1);
	define("KONTAKT_NAMN",2);
	define("KONTAKT_TFN",3);
	define("KONTAKT_MEDDELANDE",4);
	define("KONTAKT_MAX",4);

	//Konstanter för kolumnnummer i databastabellen över medlemmar.
	define("MEDLEM_TABELL","medlem");
	define("MEDLEM_ID", 0);
	define("MEDLEM_NAMN", 1);
	define("MEDLEM_LAN", 2);
	define("MEDLEM_ORT", 3);
	define("MEDLEM_TFN", 4);
	define("MEDLEM_EMAIL", 5);
	define("MEDLEM_HASH", 6);
	define("MEDLEM_SALT", 7);
	define("MEDLEM_BEHORIGHET", 8);
	define("MEDLEM_NYCKELORD",9);
	define("MEDLEM_MAX",9);

	//Konstanter för kolumnnummer i databastabellen över böcker.
	define("BOK_TABELL","bok");
	define("BOK_ISBN", 0);
	define("BOK_TITEL", 1);
	define("BOK_FORFATTARE", 2);
	define("BOK_GENRE", 3);
	define("BOK_MAX",3);

	//Konstanter för kolumnnummer i databastabellen över annonser.
	define("ANNONS_TABELL","annons");
	define("ANNONS_ID", 0);
	define("ANNONS_MEDLEM_ID", 1);
	define("ANNONS_ISBN", 2);
	define("ANNONS_ANNONSTYP", 3);
	define("ANNONS_PRIS", 4);
	define("ANNONS_BESKRIVNING", 5);
	define("ANNONS_BILD", 6);
	define("ANNONS_ANTAL_LASARE", 7);
	define("ANNONS_GODKAND",8);
	define("ANNONS_NYCKELORD",9);
	define("ANNONS_MAX", 9);

?>