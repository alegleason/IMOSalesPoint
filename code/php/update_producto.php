<?php
    require_once "util.php";
    $id=$_GET["id"];
    $descripcion=$_GET["des"];
    $precio=$_GET["price"];
    $cate=$_GET["categoria"];
    $query=UpdateProducto($id,$descripcion,$precio,$cate);
    $response="";
    if($query) $response.="<p>El producto se actualizó con éxito</p>";
    else $response.="<p>El producto no se actualizó con éxito</p>";
    return $reponse;
?>