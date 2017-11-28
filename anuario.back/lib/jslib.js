function validateContact(form){
	if (form.nombre.value == ""){
		alert("Por favor ingrese su nombre / Please enter your name");
		form.nombre.focus();
		return false;
	}
	if (form.mensaje.value == ""){
		alert("Por favor ingrese su mensaje/ Please enter your message");
		form.mensaje.focus();
		return false;
	}
	with (form.correoe)
  	{
	  apos=value.indexOf("@");
	  dotpos=value.lastIndexOf(".");
	  if (apos<1||dotpos-apos<2)
	    {
			alert("Por favor verifique su dirección de correo electrónico / Please check your e-mail address");
			form.correoe.focus();
			return false;
		}
  	}
}