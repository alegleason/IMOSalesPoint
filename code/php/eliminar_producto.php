<?php
    require_once "util.php";
    $type=$_GET["type"];
    $idProducto=htmlspecialchars($_GET["pattern"]);
    if($type==2){
        $result=activarProducto($idProducto);
    }else{
        $result=DeleteProducto($idProducto);
    }
    
?>