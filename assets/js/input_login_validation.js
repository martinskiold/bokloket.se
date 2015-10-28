//Validerar login-input.
var validate_login = function()
{

	//-------------REGLER---------------//
	// * email måste innehålla någonting innan @, någonting efter @,
	//	 en punkt efter @ och minste ett tecken efter punkt.
	// * password måste innehålla minst 6 tecken.
	

	//Hämtar input.
	var e_mail=$('#email').val();
	var password=$("#password").val();

	//regular expression med endast mellanslag.
	var regEmpty=/^\s*$/;

	//regular expression för e-mail.
	var regE_mail=/^([A-Za-z0-9_\-\.]){1,}\@([A-Za-z0-9_\-\.]){1,}\.([A-Za-z]){1,4}$/;

	//Testar email och lösenord mot de två regular expression. Kollar även längden på email och lösenord.
	//returnerar ifall validering lyckades.
	if(regEmpty.test(e_mail) || e_mail.length == 0)
	{
		$('#email').val("");
		alert("Email saknas.");
		return false;
	}
	else if(!regE_mail.test(e_mail))
	{
		alert("Ogiltig email! Måste innehålla ett '@' och en punkt.");
		return false;
	}
	else if(regEmpty.test(password) || password.length < 6 || password.length > 78)
	{
		$('#password').val("");
		alert("Lösenordet måste vara mellan 6 och 78 tecken.");
		return false;
	}

	//Om formulärdatat passerade denna kontroll så är den i korrekt format.
	return true;
}