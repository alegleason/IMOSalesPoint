 <?php
  session_start();
  require_once("util.php");
<<<<<<< HEAD
  $buttons=highestSold();

  if(isset($_SESSION["idUsuario"])) {
=======

  if(isset($_SESSION["idUsuario"]) && (allowed(39) || allowed(50))) {
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    include 'partials/_header.html';

    $error="";

<<<<<<< HEAD
    if(allowed(50)) {
      // Pedido en Punto de Venta
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Si en punto de venta se ingresa un id de comprador
        $idComprador=$_POST['idComprador'];
        if(checkBuyer($idComprador)) {
          $_SESSION['idComprador']=$idComprador;
          iniciarCompra($_SESSION['idComprador'],$_SESSION['idUsuario']);
          
          $table=actualizarTicket($_SESSION['idCompra']);
          include 'partials/principal.html';
        } else {
          $error = "<p class='red lighten-2'>El ID ingresado no existe o no pertenece a un comprador.</p>";
          include 'partials/bienvenidaVendedor.html';
        }
      } else if(isset($_SESSION['idComprador']) && $_SESSION['idComprador']!="" && (!isset($_GET['nav']) || $_GET['nav']!=1)) {
        //Si ya hay una compra y no se pica home en el navbar
        $table=actualizarTicket($_SESSION['idCompra']);
        include 'partials/principal.html';
      } else {
        //Si se picó home en el navbar
        if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
          cancelarCompra($_SESSION['idCompra']);
        }
        include 'partials/bienvenidaVendedor.html';
      }

    } else if(allowed(39)) {
      // Pedido en Línea
      if(isset($_GET['nuevo']) && $_GET['nuevo']==1) {
        iniciarCompra($_SESSION['idUsuario']);
      }
      $table=actualizarTicket($_SESSION['idCompra']);
      include 'partials/principal.html';

    } else {
      header("location: ../index.php");
    }

    footerhtml();

=======
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $idComprador=$_POST['idComprador'];
      if(checkBuyer($idComprador)) {
        $_SESSION['idComprador']=$idComprador;
        iniciarCompra($_SESSION['idComprador'],$_SESSION['idUsuario']);
        $table=actualizarTicket($_SESSION['idCompra']);
        include 'partials/principal.html';
      }
      else {
        $error = "<p class='red lighten-2'>El ID ingresado no existe o no pertenece a un comprador.</p>";
        include 'partials/bienvenidaVendedor.html';
      }
    } else if(isset($_SESSION['idComprador']) && $_SESSION['idComprador']!="" && $_GET['nav']!=1) {
      $table=actualizarTicket($_SESSION['idCompra']);
      include 'partials/principal.html';
    } else {
      if(isset($_SESSION['idCompra']) && $_SESSION['idCompra']!="") {
        cancelarCompra($_SESSION['idCompra']);
      }
      include 'partials/bienvenidaVendedor.html';
    }
    footerhtml();
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
  } else {
    header("location: ../index.php");
  }

?>
