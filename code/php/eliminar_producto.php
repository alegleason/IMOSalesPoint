<?php
    require_once "util.php";
    $idProducto=htmlspecialchars($_GET["pattern"]);
    $result=DeleteProducto($idProducto);
?>