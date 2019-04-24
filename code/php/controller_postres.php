
<?php
    require_once "util.php";
    $pattern=strtolower($_GET["pattern"]);
    $query=getProductos(3);
    $response="";
    $size=0;
    $numcol=1;
    for($i=0; $i<mysqli_num_rows($query); $i++){
        $row=mysqli_fetch_assoc($query);
        $pos=strncasecmp($row["nombre"],$pattern, strlen($pattern));
        if(($pos===0)){
           if($numcol%6===1){
               $response.="<div class=\"row\">";
           }
           if($row["disponible"]==1){
               $aux=$row["idProducto"];
               $num=$row["disponible"];
               $response.="<div class=\"col m2\"><a class=\"waves-effect waves-light btn green darken-1 three-row-btn valign-wrapper\" id=\"$aux\" name=\"$aux\" value=\"$aux\" onclick=\"cambiarDisponibilidadPostres($aux,$num)\">".$row["nombre"]."</a></div>";
           }else{
               $aux=$row["idProducto"];
               $num=$row["disponible"];
               $response.="<div class=\"col m2\"><a class=\"waves-effect waves-light btn red darken-1 three-row-btn valign-wrapper\" id=\"$aux\" name=\"$aux\" value=\"$aux\" onclick=\"cambiarDisponibilidadPostres($aux,$num)\">".$row["nombre"]."</a></div>";
           }

           if($numcol%6===0){
               $response.="</div>";
           }
           $numcol++;
        }
        $size++;
    }
    if($size>0){
        echo $response;
    }
    else{
        $response.="<h6 class=\"center\">No existe bebida con ese nombre</h6>";
        echo $response;
    }

?>
