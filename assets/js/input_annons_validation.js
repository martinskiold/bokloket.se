//Validerar login-input.
var validate_add = function()
{

	//-------------REGLER---------------//
	// * titel, genre, isbn eller pris får inte lämnas tomma, 
	//   men får inte heller innehålla mer än 50 tecken.
	// * författare får inte lämnas tom, men får inte heller innehålla
	//   mer än 150 tecken.
	// * beskrivning får inte lämnas tom, men får inte heller innehålla
	//	 mer än 300 tecken.

	//Hämtar input.
	var titel=$('#titel').val();
	var forfattare=$("#forfattare").val();
	var genre=$('#genre').val();
	var isbn=$('#isbn').val();
	var beskrivning=$('#beskrivning').val();
	var pris=$('#pris').val();

	//regular expression med endast mellanslag.
	var regEmpty=/^\s*$/;

	if(regEmpty.test(titel) || titel.length == 0 || titel.length > 50)
	{
		$('#titel').val("");
		alert("Titeln får inte vara tom eller mer än 50 tecken.");
		return false;
	}
	else if(regEmpty.test(forfattare) || forfattare.length == 0 || forfattare.length > 150)
	{
		$('#forfattare').val("");
		alert("Författaren/författarnas namn får inte vara tomma eller överstiga 100 tecken.");
		return false;
	}
	else if(regEmpty.test(genre) || genre.length == 0 || genre.length > 50)
	{
		$('#genre').val("");
		alert("Genren får inte vara tom eller mer än 50 tecken.");
		return false;
	}
	else if(regEmpty.test(isbn) || isbn.length == 0 || isbn.length > 50)
	{
		$('#isbn').val("");
		alert("Isbn får inte vara tom eller mer än 50 tecken.");
		return false;
	}
	else if(regEmpty.test(beskrivning) || beskrivning.length == 0 || beskrivning.length > 300)
	{
		$('#beskrivning').val("");
		alert("Beskrivningen får inte vara tom eller mer än 300 tecken.");
		return false;
	}
	else if(regEmpty.test(pris) || pris .length == 0 || pris.length > 50)
	{
		$('#pris').val("");
		alert("Pris får inte vara tom eller mer än 50 tecken.");
		return false;
	}
	


	//Om formulärdatat passerade denna kontroll så är den i korrekt format.
	return true;

}