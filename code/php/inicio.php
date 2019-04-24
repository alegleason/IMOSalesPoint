 <?php
   session_start();
   require_once("util.php");

   if(isset($_SESSION["idUsuario"])) {
<<<<<<< HEAD
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
=======
     //include
     include 'partials/_header.html';
     $postre=getAvPostre();
     $comida=getAvComida();
     $bebida=getAvBebida();
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
     include "partials/inicio.html";
     footerhtml();
   } else {
     header("location: ../index.php");
   }

?>
