<?php
    require_once "util.php";
    $pattern=strtolower($_GET["pattern"]);
    $query=getProductos_Todos();
<<<<<<< HEAD
    $response="";
    $responseinac="";
=======
    $reponse="";
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    $size=0;
    for($i=0; $i<mysqli_num_rows($query); $i++){
        $row=mysqli_fetch_assoc($query);
        $pos=strncasecmp($row["nombre"],$pattern, strlen($pattern));
        if($pos===0){
            $size++;
            $aux=$row["nombre"];
            $id=$row["idProducto"];
<<<<<<< HEAD
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
=======
            $descripcion["descripcion"];
            $response.="<li><div class=\"collapsible-header center\"></t><a class=\"waves-effect waves-light btn blocku\" href=\"modificar_producto.php?id=$id\" >$aux</a><input type=\"hidden\" value=\"$id\"></div></li>";
            $_SESSION[$id]=$id;
        }
    }
    if($size>0){
        echo "<ul class=\"collapsible\">$response</ul>";
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
    }
    else{
        $response.="<h6 class=\"center\">No existe producto con ese nombre</h6>";
        echo $response;
    }

<<<<<<< HEAD
?>
=======
?>
>>>>>>> 22408f508e1cb158071ed17531441eca9f3e298e
