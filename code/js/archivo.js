

var d = new Date();
var days = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];
var months = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
document.getElementById("date").innerHTML = days[d.getDay()] + " " + d.getDate() + " de " + months[d.getMonth()] + " del " +  " " + d.getFullYear();

{ hover: false }

$(document).ready(function() {
	M.updateTextFields();
});

$(".dropdown-trigger").dropdown();

$(document).ready(function() {
    $('select').material_select();
    window.picker = $('.datepicker').pickadate({
        selectYears: 50, // Creates a dropdown of 16 years to control year
    });

});

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function validarClaves(){
	var a = document.getElementById("passwords").value;//DOM
	var b = document.getElementById("passwordss").value;

	if(a==""){
		document.getElementById("messages").innerHTML="** Favor de llenar el campo";
		return false;
	}

	if(a.length < 5){
		document.getElementById("messages").innerHTML="** El tamaño de la clave debe ser mayor a 5 caracteres";
		return false;
	}

	if(a.length > 25){
		document.getElementById("messages").innerHTML="** El tamaño de la clave debe ser menor a 25 caracteres";
		return false;
	}

	if(a!=b){
		document.getElementById("messages").innerHTML="** Las contraseñas no coinciden";
		return false;
	}
}

function addProducto(){
	var name = document.getElementById("nameP").value;//DOM
	var desc = document.getElementById("description").value;
	var pc = document.getElementById("price").value;

	if(name==""){
		document.getElementById("namePWrong").innerHTML="** Favor de poner tu nombre";
		return false;
	}

	if(name.length<5){
		document.getElementById("namePWrong").innerHTML="** El nombre del producto debe ser mayor a 5 caracteres";
		return false;
	}

	if(desc==""){
		document.getElementById("descriptionWrong").innerHTML="** Favor de poner alguna descripción";
		return false;
	}

	if(desc.length<5){
		document.getElementById("descriptionWrong").innerHTML="** La descripción debe ser mayor a 5 caracteres";
		return false;
	}

	if(pc==0){
		document.getElementById("priceWrong").innerHTML="** El precio debe ser mayor a 0";
		return false;
	}
}