<?php
	  session_start();
	  require_once("util.php");
		if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
      // Si el usuario dejó una compra bailando se elimina
      cancelarCompra($_SESSION['idCompra']);
    }
		
	  if(isset($_SESSION["idUsuario"]) && allowed(48)) {
	    $query=obtenerUsuario($_SESSION["idUsuario"]);
	    $row=mysqli_fetch_assoc($query);
	    $id=$row["idUsuario"];
	    $nombre=$row["nombre"];
	    $apellidoP=$row["apellidoPaterno"];
	    $apellidoM=$row["apellidoMaterno"];
	    $telefono=$row["telefono"];
	    $correo=$row["correo"];
	    $idrol=$row["idRol"];
	    $fechaNacimiento=$row["fechaNacimiento"];
        include 'partials/_header.html';
        include "partials/datosUsuario.html";
        footerhtml();
      } else {
        header("location: ../index.php");
      }
?>
