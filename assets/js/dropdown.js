//Eventlistener för dropdown meny för login.
$('#login_btn').click(function(){
  $('.dropdown_register_user_wrapper').hide('slow');
  $('.dropdown_login_wrapper').slideToggle('slow');
});

//Eventlistener för stängning av dropdown meny för login.
$('#close_dropdown_login').click(function(){
  $('.dropdown_login_wrapper').hide('slow');
});

//Eventlistener för dropdown meny för registrera användare.
$('#reg_link').click(function(){
  $('.dropdown_login_wrapper').hide('slow');
  $('.dropdown_register_user_wrapper').slideToggle('slow');
});

//Eventlistener för stängning av dropdown meny för registrera användare.
$('#close_dropdown_register').click(function(){
  $('.dropdown_register_user_wrapper').hide('slow');
});

