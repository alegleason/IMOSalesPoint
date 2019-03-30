<?php
    require_once "util.php";
    $id=strtolower($_GET["cate"]);
    $name=($_GET["nombre"]);
    $descripcion=($_GET["des"]);
    $precio=strtolower($_GET["price"]);
    $query=InsertarProducto($id,$precio,$descripcion,$name);
    if($query) $response=true;
    else $response=false;
    return $reponse;
?>
