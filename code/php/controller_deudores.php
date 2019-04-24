
<?php
    require_once "util.php";
    $pattern=strtolower($_GET["pattern"]);
    $query=getDeudores();
    $response="";
    $size=0;
    if(mysqli_num_rows($query) > 0) {
      $response="<table class='centered'><thead><tr><th>Nombre</th><th>Apellido</th><th>Id</th><th>Deuda</th></tr></thead><tbody>";
      while($row = mysqli_fetch_assoc($query)) {
          $pos=strncasecmp($row["nombre"],$pattern, strlen($pattern));
          if(($pos===0)){
            $response.="<tr><td>".$row['nombre']."</td><td>".$row['apellidoPaterno']."</td><td>".$row['idUsuario']."</td><td>$".$row['deuda']."</td><td></tr>";
            $size++;
          }
      }
      $response.="</tbody></table>";
    }
    if($size>0){
        echo $response;
    }
    else{
        $response.="<h6 class=\"center\">No existe deudor con ese nombre</h6>";
        echo $response;
    }

?>
