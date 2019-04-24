<?php
    require_once "util.php";
    $id=strtolower($_GET["cate"]);
    $name=($_GET["nombre"]);
    $descripcion=($_GET["des"]);
    $precio=strtolower($_GET["price"]);
<<<<<<< HEAD
    var_dump($_GET);
    var_dump($id);
    var_dump($name);
    var_dump($descripcion);
    var_dump($precio);
=======
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    $query=InsertarProducto($id,$precio,$descripcion,$name);
    if($query) $response=true;
    else $response=false;
    return $reponse;
?>
