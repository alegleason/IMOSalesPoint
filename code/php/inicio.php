 <?php
   session_start();
   require_once("util.php");

   if(isset($_SESSION["idUsuario"])) {
     if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="" && !isset($_GET['realizado'])) {
       // Si el usuario dejó una compra pendiente se elimina
       cancelarCompra($_SESSION['idCompra']);
     }
     include 'partials/_header.html';
     $table=getAvBebidaT();
     $table2=getAvComidaT();
     $table3=getAvPostreT();
     $_SESSION['deuda'] = getSaldo($_SESSION['idUsuario']);
     //$saldo=getSaldo();
     include "partials/inicio.html";
     footerhtml();
   } else {
     header("location: ../index.php");
   }

?>
