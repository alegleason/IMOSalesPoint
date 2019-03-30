 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && allowed(43)) {
    include 'partials/_header.html';
    include 'partials/corte.html';
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
