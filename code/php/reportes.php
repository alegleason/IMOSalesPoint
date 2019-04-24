<?php
	session_start();
	require_once("util.php");

	if(isset($_SESSION["idUsuario"]) && allowed(45)) {
		include 'partials/_header.html';
		date_default_timezone_set('America/Mexico_City');
    	$horaFechaInicio = date("Y-m-d ");
    	$horaFechaFin = date("Y-m-d ");
    	$horaFechaInicio.="00:00:00";
    	$horaFechaFin.="23:59:59";
    	$query=getCorteCaja(1,$horaFechaInicio,$horaFechaFin);
	    $row=mysqli_fetch_assoc($query);
	    $efectivo=$row["Pago"];
		$query=getCorteCaja(2,$horaFechaInicio,$horaFechaFin);
	    $row=mysqli_fetch_assoc($query);
	    $tarjeta=$row["Pago"];
		$query=getCorteCaja(3,$horaFechaInicio,$horaFechaFin);
	    $row=mysqli_fetch_assoc($query);
	    $fiado=$row["Pago"];
		$query=getCorteCaja(4,$horaFechaInicio,$horaFechaFin);
	    $row=mysqli_fetch_assoc($query);
	    $paypal=$row["Pago"];
		$query=getCorteCaja(5,$horaFechaInicio,$horaFechaFin);
	    $row=mysqli_fetch_assoc($query);
	    $admin=$row["Pago"];
		if($efectivo==NULL) $efectivo=0;
		if($tarjeta==NULL) $tarjeta=0;
		if($fiado==NULL) $fiado=0;
		if($paypal==NULL) $paypal=0;
		if($admin==NULL) $admin=0;
		$total=$efectivo+$tarjeta+$fiado+$paypal-$admin;
		$query=getUsuarioDeudaMaxima();
	    $row=mysqli_fetch_assoc($query);
	    $usuarioMayor=$row["nombre"];
	    $usuarioMayor.=' ';
	    $usuarioMayor.=$row["apellidoPaterno"];
	    $usuarioMayor.=' ';
	    $usuarioMayor.=$row["apellidoMaterno"];
	    $query=getUsuarioDeudaMinima();
	    $row=mysqli_fetch_assoc($query);
	    $usuarioMenor=$row["nombre"];
	    $usuarioMenor.=' ';
	    $usuarioMenor.=$row["apellidoPaterno"];
	    $usuarioMenor.=' ';
	    $usuarioMenor.=$row["apellidoMaterno"];
	    $query=getPromedioDeuda();
	    $row=mysqli_fetch_assoc($query);
	    $promedio=$row["Deuda"];
	    $query=mejorVendedor($horaFechaInicio,$horaFechaFin);
	    $row=mysqli_fetch_assoc($query);
	    $idMejorVendedor=$row["idUsuario"];
	    if($idMejorVendedor!=NULL){
	    	$mejorVendedor=$row["nombre"];
		    $mejorVendedor.=' ';
		    $mejorVendedor.=$row["apellidoPaterno"];
		    $mejorVendedor.=$row["apellidoMaterno"];
	    }else $mejorVendedor="No hay";
	    
	    $query=peorVendedor($horaFechaInicio,$horaFechaFin);
	    $row=mysqli_fetch_assoc($query);
	    $idPeorVendedor=$row["idUsuario"];
	    if($idPeorVendedor!=NULL && $idPeorVendedor!=$idMejorVendedor){
	    	$peorVendedor=$row["nombre"];
		    $peorVendedor.=' ';
		    $peorVendedor.=$row["apellidoPaterno"];
		    $peorVendedor.=' ';
		    $peorVendedor.=$row["apellidoMaterno"];
	    }else $peorVendedor="No hay";
	    
	    
	    
		include "partials/reportes.html";
		footerhtml();
	} else {
	  header("location: ../index.php");
	}

?>
