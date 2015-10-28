//Validerar login-input.
var validate_kontakt = function()
{

	//-------------REGLER---------------//
	// * email måste innehålla någonting innan @, någonting efter @,
	//	 en punkt efter @ och minste ett tecken efter punkt.
	// * phone_nr måste skrivas in i formatet XXX-XXX-XX-XX eller
	//   XXXXXXXXXX och alltid vara exakt 10 tecken långt.
	// * message får inte lämnas tom men inte heller innehålla mer
	//   än 300 tecken.

	//Hämtar input.
	var email_sender=$('#email_sender').val();
	var phone_nr=$("#phone_nr_sender").val();
	var message=$('#message_sender').val();
	var name=$('#name_sender').val();

	//regular expression för emailadress.
	var regE_mail=/^([A-Za-z0-9_\-\.]){1,}\@([A-Za-z0-9_\-\.]){1,}\.([A-Za-z]){2,4}$/;

	//regular expression med endast mellanslag.
	var regEmpty=/^\s*$/;

	if(regEmpty.test(name) || name.length == 0)
	{
		$('#name_sender').val("");
		alert("Skriv in ett namn");
		return false;
	}
	else if(regEmpty.test(email_sender) || email_sender.length == 0)
	{
		$('#email_sender').val("");
		alert("Email saknas.");
		return false;
	}
	else if(!regE_mail.test(email_sender))
	{
		alert("Ogiltig email! Måste innehålla ett '@' och en punkt.");
		return false;
	}
	else if(regEmpty.test(phone_nr))
	{
		$('#phone_nr_sender').val("");
		alert("Felaktigt telefonnummer! Max 10 siffror, skrivs in som antingen XXX-XXX-XX-XX eller XXXXXXXXXX");
		return false;
	}
	else if(regEmpty.test(message) || message.length > 300)
	{
		$('#message_sender').val("");
		alert("Tomt meddelande!");
		return false;
	}

	//Om formulärdatat passerade denna kontroll så är den i korrekt format.
	return true;
}