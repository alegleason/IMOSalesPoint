 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && (allowed(40) || allowed(51))) {
    include 'partials/_header.html';
    include "partials/pagar_saldo.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
