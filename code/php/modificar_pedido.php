 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && isset($_SESSION['idCompra']) && allowed(44)) {
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idProdEliminar'])) {
      eliminarProdDeCompra($_SESSION['idCompra'], $_GET['idProdEliminar']);
    }
    else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idProd'])) {
      modificarCantidadProducto($_SESSION['idCompra'], $_POST['idProd'], $_POST['cantidad']);
    }
    include 'partials/_header.html';
    $table=actualizarTicketEdicion($_SESSION['idCompra']);
    include "partials/modificar_pedido.html";
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
