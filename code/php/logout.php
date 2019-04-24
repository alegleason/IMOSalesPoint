 <?php
    session_start();
    require_once("util.php");
    if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
      // Si el usuario dejó una compra bailando se elimina
      cancelarCompra($_SESSION['idCompra']);
    }

    session_unset();
    session_destroy();

    header("location:../index.php");
?>
