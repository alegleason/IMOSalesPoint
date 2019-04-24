 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && (allowed(37) || allowed(38))) {
    if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
      // Si el usuario dejó una compra bailando se elimina
      cancelarCompra($_SESSION['idCompra']);
    }
    include 'partials/_header.html';
    include "partials/pedidos.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
