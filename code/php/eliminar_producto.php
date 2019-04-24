<?php
    require_once "util.php";
<<<<<<< HEAD
    $type=$_GET["type"];
    $idProducto=htmlspecialchars($_GET["pattern"]);
    if($type==2){
        $result=activarProducto($idProducto);
    }else{
        $result=DeleteProducto($idProducto);
    }
    
=======
    $idProducto=htmlspecialchars($_GET["pattern"]);
    $result=DeleteProducto($idProducto);
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
?>