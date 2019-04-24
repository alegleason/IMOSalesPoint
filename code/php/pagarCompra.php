 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && isset($_POST["pagar_saldo"]) && (allowed(40) || allowed(51))) {//Pagototal
    include 'partials/_header.html';
    $_SESSION['deuda'] = getSaldo($_SESSION['idUsuario']);
    include "partials/pagar_saldo.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
