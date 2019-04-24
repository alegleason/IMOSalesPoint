<?php
    require_once "util.php";
    $idProducto=$_GET["pattern"];
    $available=$_GET["available"];
    $result=getUpdateById($idProducto,$available);
?>

