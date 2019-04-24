<?php
    require_once "util.php";
    $type=strtolower($_GET["type"]);
    if($type==1){
        $pattern=strtolower($_GET["pattern"]);
        $query=getUsuariosTodosActivos();
        $response="";
        $size=0;
        for($i=0; $i<mysqli_num_rows($query); $i++){
            $row=mysqli_fetch_assoc($query);
            $pos=strncasecmp($row["nombre"],$pattern, strlen($pattern));
            if($pos===0){
                $size++;
                $aux=$row["nombre"];
                $aux.=" ";
                $aux.=$row["apellidoPaterno"];
                $aux.=" ";
                $aux.=$row["apellidoMaterno"];
                $id=$row["idUsuario"];
                $response.="<li><div class=\"collapsible-header center\"></t><a class=\"waves-effect waves-light btn blocku\" href=\"modificar_usuario_act.php?id=$id\" >$aux</a><input type=\"hidden\" value=\"$id\"></div></li>";
            }
        }
        if($size>0){
            echo "<ul class=\"collapsible\">$response</ul>";
        }
        else{
            $response.="<h6 class=\"center\">No existe usuario con ese nombre</h6>";
            echo $response;
        }
    }
    if($type==2){
        $id=$_GET["id"];
        $rol=$_GET["rol"];
        $query=updateUsuarioRolAct($id,$rol);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    if($type==3){
        $pattern=strtolower($_GET["pattern"]);
        $query=getUsuariosTodosInactivos();
        $response="";
        $size=0;
        for($i=0; $i<mysqli_num_rows($query); $i++){
            $row=mysqli_fetch_assoc($query);
            $pos=strncasecmp($row["nombre"],$pattern, strlen($pattern));
            if($pos===0){
                $size++;
                $aux=$row["nombre"];
                $aux.=" ";
                $aux.=$row["apellidoPaterno"];
                $aux.=" ";
                $aux.=$row["apellidoMaterno"];
                $id=$row["idUsuario"];
                $response.="<li><div class=\"collapsible-header center\"></t><a class=\"waves-effect waves-light btn red blocku\" href=\"modificar_usuario_act.php?id=$id\" >$aux</a><input type=\"hidden\" value=\"$id\"></div></li>";
            }
        }
        if($size>0){
            echo "<ul class=\"collapsible\">$response</ul>";
        }
        else{
            $response.="<h6 class=\"center\">No existe usuario con ese nombre</h6>";
            echo $response;
        }
    }

    if($type==4){
        $id=$_GET["id"];
        $query=desactivarUsuario($id);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    if ($type==5){
        $id=$_GET["id"];
        $query=activarUsuario($id);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    if($type==6){
        $id=$_GET["id"];
        $nombre=$_GET["nombre"];
        $ap=$_GET["aP"];
        $am=$_GET["aM"];
        $tel=$_GET["telefono"];
        $correo=$_GET["correo"];
        $query=updatePersonalUser($id,$nombre,$ap,$am,$tel,$correo);
        if($query){
            $_SESSION['nombre']=$nombre;
            return true;
        }else{
            return false;
        }
    }


?>
