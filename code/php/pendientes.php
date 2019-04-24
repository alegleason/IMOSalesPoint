 <?php
  session_start();
  require_once("util.php");
<<<<<<< HEAD
  //if(isset($_SESSION["idUsuario"]) && (allowed(33) || allowed(34))) {
  if(isset($_SESSION["idUsuario"]) &&  ((allowed(41)) || allowed(33) || allowed(34))) {
    include 'partials/_header.html';
    $table=getDeudores();
=======

  if(isset($_SESSION["idUsuario"]) && (allowed(33) || allowed(34))) {
    include 'partials/_header.html';
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    include "partials/pendientes.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
