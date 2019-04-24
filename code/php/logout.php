 <?php
    session_start();
<<<<<<< HEAD
    require_once("util.php");
    if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
      // Si el usuario dejó una compra bailando se elimina
      cancelarCompra($_SESSION['idCompra']);
    }

=======
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    session_unset();
    session_destroy();

    header("location:../index.php");
?>
