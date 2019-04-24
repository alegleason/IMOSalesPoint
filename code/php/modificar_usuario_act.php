<?php
	  session_start();
	  require_once("util.php");
	  if(isset($_SESSION["idUsuario"]) && allowed(47)) {
	    $id=strtolower($_GET['id']);
        $query=getUsuarioUnico($id);
        $row=mysqli_fetch_assoc($query);
        $id=$row["idUsuario"];
        $nombre=$row["nombre"];
        $apellidoP=$row["apellidoPaterno"];
        $apellidoM=$row["apellidoMaterno"];
        $telefono=$row["telefono"];
        $correo=$row["correo"];
        $idrol=$row["idRol"];
        $activo=$row["activo"];
        include 'partials/_header.html';
        include "partials/modificarUsuarioAct.html";
        footerhtml();
      } else {
        header("location: ../index.php");
      }
?>
