 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && (allowed(39) || allowed(50))) {
    include 'partials/_header.html';

    $error="";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $idComprador=$_POST['idComprador'];
      if(checkBuyer($idComprador)) {
        $_SESSION['idComprador']=$idComprador;
        iniciarCompra($_SESSION['idComprador'],$_SESSION['idUsuario']);
        $table=actualizarTicket($_SESSION['idCompra']);
        include 'partials/principal.html';
      }
      else {
        $error = "<p class='red lighten-2'>El ID ingresado no existe o no pertenece a un comprador.</p>";
        include 'partials/bienvenidaVendedor.html';
      }
    } else if(isset($_SESSION['idComprador']) && $_SESSION['idComprador']!="" && $_GET['nav']!=1) {
      $table=actualizarTicket($_SESSION['idCompra']);
      include 'partials/principal.html';
    } else {
      if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
        cancelarCompra($_SESSION['idCompra']);
      }
      include 'partials/bienvenidaVendedor.html';
    }
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
