//Eventlistener för 'Logga ut'-knappen.
$('#logout_btn').click(function()
{
	window.location.replace('processing/logout_process.php');
});

//Eventlistener för 'Min Sida'-knappen.
$('#min_sida_btn').click(function()
{
	window.location.replace('processing/min_profil.php');
});

//Eventlistener för 'Registrera Annons'-knappen.
$('#reg_annons_btn').click(function()
{
	window.location.replace('registrera_annons.php');
});

//Eventlistener för 'Registrera'-knappen.
$('#h_reg_annons_btn').click(function()
{
	window.location.replace('registrera_annons.php');
});

//Eventlistener för 'Registrera'-knappen.
$('#reg_annons_err').click(function()
{
	window.location.replace('processing/h_reg_btn_err.php');
});

