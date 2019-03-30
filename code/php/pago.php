<?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && isset($_SESSION['idCompra']) && (allowed(40) || allowed(51))) {
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['opcionPago'])) {
      if($_GET['opcionPago']=='fiar') {
        $_SESSION['idCompra']="";
        $_SESSION['idComprador']="";

        header("location: principal.php");
      }
    } else {
      include 'partials/_header.html';
      $table=actualizarTicketPago($_SESSION['idCompra']);
      include 'partials/pago.html';
      footerhtml();
    }
  } else {
    header("location: ../index.php");
  }

?>
