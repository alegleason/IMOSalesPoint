 <?php
  session_start();
  require_once("php/util.php");

  if(isset($_SESSION["idUsuario"])) {
    if(allowed(50)) {
      header("location: php/principal.php");
    } else {
      header("location: php/inicio.php");
    }
  } else {
      header("location: php/login.php");
  }
?>
