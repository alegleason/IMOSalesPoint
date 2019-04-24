 <?php
  session_start();
  require_once("util.php");
  //if(isset($_SESSION["idUsuario"]) && (allowed(33) || allowed(34))) {
  if(isset($_SESSION["idUsuario"]) &&  ((allowed(41)) || allowed(33) || allowed(34))) {
    include 'partials/_header.html';
    $table=getDeudores();
    include "partials/pendientes.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
