 <?php
   session_start();
   require_once("util.php");

   if(isset($_SESSION["idUsuario"])) {
     //include
     include 'partials/_header.html';
     $postre=getAvPostre();
     $comida=getAvComida();
     $bebida=getAvBebida();
     include "partials/inicio.html";
     footerhtml();
   } else {
     header("location: ../index.php");
   }

?>
