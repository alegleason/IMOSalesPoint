 <?php
  session_start();
  require_once("util.php");

  if(isset($_SESSION["idUsuario"]) && allowed(43)) {
    date_default_timezone_set('America/Mexico_City');
    $horaSalida=date('Y-m-d H:i:s', time());
    $query=getCorteCaja(1,$_SESSION["horaconex"],$horaSalida);
    $row=mysqli_fetch_assoc($query);
    $efectivo=$row["Pago"];
    $query=getCorteCaja(2,$_SESSION["horaconex"],$horaSalida);
    $row=mysqli_fetch_assoc($query);
    $tarjeta=$row["Pago"];
    $query=getCorteCaja(3,$_SESSION["horaconex"],$horaSalida);
    $row=mysqli_fetch_assoc($query);
    $fiar=$row["Pago"];
    if($efectivo==NULL) $efectivo=0;
    if($tarjeta==NULL) $tarjeta=0;
    if($fiar==NULL) $fiar=0;
    $total=$efectivo+200+$tarjeta;
    include 'partials/_header.html';
    include 'partials/corte.html';
    footerhtml();
  } else {
    header("location: ../index.php");
  }

?>
