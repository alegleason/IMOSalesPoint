<?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && (allowed(39) || allowed(50))) {
    include 'partials/_header.html';
<<<<<<< HEAD
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idProducto']) && isset($_GET['individual'])) {
      agregarProductoACompra($_SESSION['idCompra'], $_GET['idProducto']);
      $table=actualizarTicket($_SESSION['idCompra']);
      $buttons=highestSold();
      include 'partials/principal.html';
    } else if($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['categoria']) || isset($_GET['idProducto']))) {
      var_dump($_GET);
=======
    if($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['categoria']) || isset($_GET['idProducto']))) {
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
      if(isset($_GET['categoria'])) {
        $_SESSION['prevCategoria']=$_GET['categoria'];
      }
      else if(isset($_GET['idProducto'])) {
        agregarProductoACompra($_SESSION['idCompra'], $_GET['idProducto']);
      }
      $table=actualizarTicket($_SESSION['idCompra']);
      $botonesProductos=getBotones($_SESSION['prevCategoria']);
      include 'partials/productosDisp.html';
    } else {
       echo "No tienes permiso para acceder aquí, lo siento.";
    }
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
