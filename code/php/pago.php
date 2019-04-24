<?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION['idUsuario']) && (allowed(40) || allowed(51))) {
    include 'partials/_header.html';
    $error="";

    if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="" && (!isset($_GET['nav']) || $_GET['nav']!=1)) {
      if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['opcionPago'])) {
        if($_GET['opcionPago']=='fiar') {
          if($_SESSION['rol']==3) {
            fiarTotal($_SESSION['idComprador'], $_SESSION['totalAPagar']);
          }
          else {
            fiarTotal($_SESSION['idUsuario'], $_SESSION['totalAPagar']);
          }
        }
        else {
          $cant=0;
          $metodo="";
          if($_GET['opcionPago']=='total') {
            $cant=$_SESSION['totalAPagar'];
          }
          else if($_GET['opcionPago']=='otra') {
            $cant=$_GET['cantidad'];
          }
          if(isset($_GET['tarjeta'])){
            $metodo=2;
          }
          else if(isset($_GET['efectivo'])){
            $metodo=1;
          }
          registrarPagoCompra($metodo, $_SESSION['idComprador'], $cant, $_SESSION['totalAPagar']);
        }

        $_SESSION['idCompra']="";
        $_SESSION['idComprador']="";
        if($_SESSION['rol']==3) {
          include 'partials/bienvenidaVendedor.html';
        }
        else {
          include 'partials/inicio.html';
        }

        footerhtml();
        echo "<script>M.toast({html: '¡La compra se registró exitosamente!', classes: 'rounded'})</script>";

      } else {
        $table=actualizarTicketPago($_SESSION['idCompra']);
        if(allowed(40)) {
          //si es comprador
          include 'partials/pagoPaypal.html';
        }
        else {
          //si es vendedor
          include 'partials/pago.html';
        }
        footerhtml();
      }
    }
    else {
      if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
        cancelarCompra($_SESSION['idCompra']);
      }
      if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idComprador'])) {
        $idComprador=$_POST['idComprador'];
        if(checkBuyer($idComprador)) {
          $_SESSION['idComprador']=$idComprador;
          $table=actualizarTicketDeuda($_SESSION['idComprador']);
          include 'partials/pagoAislado.html';
        } else {
          $error = "<p class='red lighten-2 centered'>El ID ingresado no existe o no pertenece a un comprador.</p>";
          include 'partials/usuarioPago.html';
        }
        footerhtml();
      }
      else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['opcionPago'])) {
        $cant=0;
        $metodo="";
        if($_GET['opcionPago']=='total') {
          $cant=$_SESSION['pagoTotal'];
        }
        else if($_GET['opcionPago']=='otra') {
          $cant=$_GET['cantidad'];
        }
        if(isset($_GET['tarjeta'])){
          $metodo=2;
        }
        else if(isset($_GET['efectivo'])){
          $metodo=1;
        }
        registrarPago($metodo, $_SESSION['idComprador'], $cant);
        include 'partials/bienvenidaVendedor.html';
        footerhtml();
        echo "<script>M.toast({html: '¡El pago se registró exitosamente!', classes: 'rounded'})</script>";
      }
      else {
        include 'partials/usuarioPago.html';
        footerhtml();
      }
    }
  } else {
    header("location: ../index.php");
  }

?>
