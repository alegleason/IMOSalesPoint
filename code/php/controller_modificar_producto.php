<?php
    require_once "util.php";
    $pattern=strtolower($_GET["pattern"]);
    $query=getProductos_Todos();
    $response="";
    $responseinac="";
    $size=0;
    for($i=0; $i<mysqli_num_rows($query); $i++){
        $row=mysqli_fetch_assoc($query);
        $pos=strncasecmp($row["nombre"],$pattern, strlen($pattern));
        if($pos===0){
            $size++;
            $aux=$row["nombre"];
            $id=$row["idProducto"];
            $activo=$row["activo"];
            if($activo==1){
                $response.="<li><div class=\"collapsible-header center\"></t><a class=\"waves-effect waves-light btn blocku\" href=\"modificar_producto.php?id=$id&activo=$activo\" >$aux</a><input type=\"hidden\" value=\"$id\"></div></li>";
            }else{
                $responseinac.="<li><div class=\"collapsible-header center\"></t><a class=\"waves-effect waves-light btn red blocku\" href=\"modificar_producto.php?id=$id&activo=$activo\" >$aux</a><input type=\"hidden\" value=\"$id\"></div></li>";
            }

        }
    }
    if($size>0){
        $total="";
        $total.=$response;
        $total.=$responseinac;
        echo "<ul class=\"collapsible\">$total</ul>";
    }
    else{
        $response.="<h6 class=\"center\">No existe producto con ese nombre</h6>";
        echo $response;
    }

?>
