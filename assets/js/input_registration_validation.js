//Validerar login-input.
var validate_registration = function()
{

	//-------------REGLER---------------//
	// * email måste innehålla någonting innan @, någonting efter @,
	//	 en punkt efter @ och minste ett tecken efter punkt.
	// * password måste innehålla minst 6 tecken.
	// * namn, län och ort får inte lämnas tomma men inte heller innehålla
	//	 mer än 50 tecken.
	// * ett telefonnummer måste skrivas in i formatet XXX-XXX-XX-XX eller
	//   XXXXXXXXXX och alltid vara exakt 10 tecken långt.

	//Hämtar input.
	var reg_email=$('#reg_email').val();
	var reg_password=$("#reg_password").val();
	var retype_password = $("#retype_password").val();
	var namn=$("#namn").val();
	var lan=$("#lan").val();
	var ort=$("#ort").val();
	var tfn=$("#tfn").val(); 

	//regular expression med endast mellanslag.
	var regEmpty=/^\s*$/;

	//regular expression för e-mail.
	var regE_mail=/^([A-Za-z0-9_\-\.]){1,}\@([A-Za-z0-9_\-\.]){1,}\.([A-Za-z]){2,4}$/;

	//regular expression för telefonnummer.
	//var regNumber=\d{3}-\d{3}-\d{2}-\d{2}|\d{10}\;
	
	if(regEmpty.test(reg_email) || reg_email.length == 0)
	{
		$('#reg_email').val("");
		alert("Email saknas.");
		return false;
	}
	else if(!reg_password == retype_password)
	{
		$('#reg_password').val("");
		$('#retype_password').val("");
		alert("Lösenorden matchade inte.");
		return false;
	}
	else if(regEmpty.test(lan) || lan.length == 0)
	{
		$('#lan').val("");
		alert("Ogiltigt län.");
		return false;
	}
	else if(regEmpty.test(ort) || ort.length == 0)
	{
		$('#ort').val("");
		alert("Ogiltig ort.");
		return false;
	}
	else if(regEmpty.test(namn) || namn.length == 0)
	{
		$('#namn').val("");
		alert("Felaktigt namn.");
		return false;
	}
	else if(!regE_mail.test(reg_email))
	{
		alert("Ogiltig email! Måste innehålla ett '@' och en punkt.");
		$('#reg_email').val("");
		return false;
	}
	else if(regEmpty.test(reg_password) || reg_password.length < 6 || reg_password.length > 78)
	{
		$('#reg_password').val("");
		$('#retype_password').val("");
		alert("Lösenordet måste vara mellan 6 och 78 tecken.");
		return false;
	}
	else if(regEmpty.test(tfn) || tfn.length < 6 || tfn.length > 15)
	{
		$('#tfn').val("");
		alert("Felaktigt telefonnummer! Max 10 siffror, skrivs in som antingen XXX-XXX-XX-XX eller XXXXXXXXXX");
		return false;
	}


	//Om formulärdatat passerade denna kontroll så är den i korrekt format.
	return true;
}