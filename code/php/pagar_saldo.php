 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && (allowed(40) || allowed(51))) {
    include 'partials/_header.html';
<<<<<<< HEAD
    $_SESSION['deuda'] = getSaldo($_SESSION['idUsuario']);
=======
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    include "partials/pagar_saldo.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
