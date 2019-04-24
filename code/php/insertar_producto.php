<?php
    require_once "util.php";
    $id=strtolower($_GET["cate"]);
    $name=($_GET["nombre"]);
    $descripcion=($_GET["des"]);
    $precio=strtolower($_GET["price"]);
    var_dump($_GET);
    var_dump($id);
    var_dump($name);
    var_dump($descripcion);
    var_dump($precio);
    $query=InsertarProducto($id,$precio,$descripcion,$name);
    if($query) $response=true;
    else $response=false;
    return $reponse;
?>
