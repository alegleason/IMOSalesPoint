function addDatos(){
	var a = document.getElementById("passwords").value;//DOM
	var b = document.getElementById("passwordss").value;
	var nombre = document.getElementById("name").value;
	var apellido = document.getElementById("lastname").value;
	var apellido2 = document.getElementById("lastname2").value;
	var email = document.getElementById("email").value;
	var telefono = document.getElementById("phone").value;
	var fecha = document.getElementById("fechanacimiento").value;
	/*var text = "<br>" + "Revisa tus datos" + "<br>" + "Nombre: " + nombre + "<br>" + " Apellido: " + apellido + "<br>"
	+ " Dirección: " + direccion + "<br>" + " Email: " + email + "<br>" + " Teléfono: " + telefono;
	document.getElementById("res").innerHTML = text;*/
<<<<<<< HEAD
	var idx = email.indexOf('@imoiap.edu.mx');
=======
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e

	if(nombre==""||!nombre.match(/[a-z]/)){
		document.getElementById("nameWrong").innerHTML="** Favor de colocar tu nombre";
		return false;
	}else{
		document.getElementById("nameWrong").innerHTML=" ";
	}

	if(fecha==""){
		document.getElementById("fechaWrong").innerHTML="** Favor de elegir tu fecha de nacimiento";
		return false;
	}else{
		document.getElementById("fechaWrong").innerHTML=" ";
	}

	if(apellido==""||!apellido.match(/[a-z]/)){
		document.getElementById("lastnameWrong").innerHTML="** Favor de colocar tu apellido paterno";
		return false;
	}else{
		document.getElementById("lastnameWrong").innerHTML=" ";
	}

	if(apellido2==""||!apellido2.match(/[a-z]/)){
		document.getElementById("lastname2Wrong").innerHTML="** Favor de colocar tu apellido materno";
		return false;
	}else{
		document.getElementById("lastname2Wrong").innerHTML=" ";
	}

	if(email==""){
		document.getElementById("emailWrong").innerHTML="** Favor de colocar tu email";
		return false;
	}else{
		document.getElementById("emailWrong").innerHTML=" ";
	}
<<<<<<< HEAD
	if (idx == -1) {
	  document.getElementById("emailWrong").innerHTML="** El correo debe terner el dominio @imoiap.edu.mx";
	  return false;
	}else{
		document.getElementById("emailWrong").innerHTML=" ";
	}
=======
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e

	if(telefono==""){
		document.getElementById("phoneWrong").innerHTML="** Favor de colocar tu teléfono";
		return false;
	}else{
		document.getElementById("phoneWrong").innerHTML=" ";
	}

	if(telefono.length != 10){
		document.getElementById("phoneWrong").innerHTML="** El teléfono debe tener 10 dígitos, no ingresar letras";
		return false;
	}else{
		document.getElementById("phoneWrong").innerHTML=" ";
	}

	if(a==""){
		document.getElementById("messages").innerHTML="** Favor de llenar el campo";
		return false;
	}else{
		document.getElementById("messages").innerHTML=" ";
	}

	if(a.length < 5){
		document.getElementById("messages").innerHTML="** El tamaño de la clave debe ser mayor a 4 caracteres";
		return false;
	}else{
		document.getElementById("messages").innerHTML=" ";
	}

	if(a.length > 25){
		document.getElementById("messages").innerHTML="** El tamaño de la clave debe ser menor a 25 caracteres";
		return false;
	}else{
		document.getElementById("messages").innerHTML=" ";
	}

	if(a!=b){
<<<<<<< HEAD
		document.getElementById("messagess").innerHTML="** Las contraseñas no coidddnciden";
=======
		document.getElementById("messagess").innerHTML="** Las contraseñas no coinciden";
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
		return false;
	}else{
		document.getElementById("messagess").innerHTML=" ";
	}
	return true;
}