<?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && allowed(35)) {
<<<<<<< HEAD
    $id=$_GET["id"];
    $activo=$_GET["activo"];
=======
    $id=strtolower($_GET['id']);
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    $query=getProductoUnico($id);
    $row=mysqli_fetch_assoc($query);
    $nombre=$row["nombre"];
    $descripcion=$row["descripcion"];
    $precio=$row["precio"];
    $disponibilidad=$row["disponible"];
    $categoria=$row["idCategoria"];
    include 'partials/_header.html';
    include "partials/modificar_producto.html";
    include "partials/_footer.html";
<<<<<<< HEAD
    //var_dump($activo);
    //var_dump($id);
=======
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
  } else {
    header("location: ../index.php");
  }

?>
