<?php
  if(!isset($_SESSION)) {
      session_start();
  }

  function footerhtml() {
    include "partials/_footer.html";
  }

  function connectDB() {
    $servername = "remotemysql.com";
    $username = "HkAYQjkxnm";
    $password = "zvlDuwLcEf";
    $dbname = "HkAYQjkxnm";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    // Check fann_get_total_connection
    if(!$con) {
      die("Connection failed: ".mysqli_connect_error());
    }

    return $con;
  }

  function closeDB($con) {
    mysqli_close($con);
  }

  function checkMatch($usuario, $passwd){
    $db = connectDB();

    $query = "SELECT * FROM Usuarios WHERE idUsuario = '$usuario' AND contrasena = '$passwd' AND activo=1";
    $res = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($res);

    if(mysqli_num_rows($res) > 0){//If there are actually results
      $res = true;
    }else{
      $res = false;
    }

    closeDB($db);

    return $res;
  }

  function checkUsr($usuario){
    $db = connectDB();

    $query = "SELECT * FROM Usuarios WHERE correo = '$usuario'";
    $res = mysqli_query($db, $query);

    if(mysqli_num_rows($res) > 0){//If there are actually results
      $res = true;
    }else{
      $res = false;
    }

    closeDB($db);

    return $res;
  }

    function ouB($id){
     $db = connectDB();
     $sql="SELECT * FROM Usuarios WHERE idUsuario='$id' AND activo=1 AND idRol=2";
     $query = mysqli_query($db,$sql);
     if(mysqli_num_rows($query) > 0){//If there are actually results
      $query = true;
     }else{
      $query = false;
      }
     closeDB($db);
     return $query;
  }

  function getName($id){
    $db = connectDB();

    $query = "SELECT nombre FROM Usuarios WHERE idUsuario='".$id."' AND activo=1";//Check whether if the user exists
    $res = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($res);

    closeDB($db);

    return $row['nombre'];
  }

  function getDeuda($id){
    $db = connectDB();

    $query = "SELECT deuda FROM Usuarios WHERE idUsuario='".$id."' AND activo=1";//Check whether if the user exists
    $res = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($res);

    closeDB($db);

    return $row['deuda'];
  }

  function createUser($nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $correo, $fechaNacimiento, $contrasena){
    $db = connectDB();
    $deuda = 0;// todos tienen una deuda inicial de 0 pesos
    $query = "INSERT INTO Usuarios ".
               "(idUsuario,idRol, nombre, apellidoPaterno, apellidoMaterno, telefono, correo, fechaNacimiento, contrasena, deuda, activo) "."VALUES ".
               "(NULL,'2','$nombre','$apellidoPaterno','$apellidoMaterno','$telefono','$correo','$fechaNacimiento','$contrasena', '$deuda', '1')";

    //$retval = mysqli_query($sql, $conn);
    $res = mysqli_query($db, $query);
    //echo $fechaNacimiento;
    if(! $res ){
      die('Error al ingresar la información: ' . mysqli_error($db));
      $flag = 0;
    }else{
      echo '<script type="text/javascript">alert("Usuario agregado correctamente!");</script>';
      header( "refresh:.1; url=inicio.php" );
    }

    closeDB($db);
  }

  function getRol($id) {
    $db = connectDB();

    $query = "SELECT idRol FROM Usuarios WHERE idUsuario='".$id."' AND activo=1";
    $role = mysqli_query($db, $query);
    $roleid = mysqli_fetch_assoc($role);

    closeDB($db);

    return $roleid['idRol'];
  }

  function getPasswordHashed($id) {
    $db = connectDB();

    $sql = "SELECT contrasena FROM Usuarios WHERE idUsuario='".$id."' AND activo=1";
    $query = mysqli_query($db, $sql);

    $resultstring = mysqli_fetch_row($query)[0];

    closeDB($db);

    return $resultstring;
  }

  function obtainUserInfo($userid) {
    $_SESSION['nombre'] = getName($userid);
    $_SESSION['deuda'] = getDeuda($userid);
    $_SESSION['rol'] = getRol($userid);
  }

  function allowed($permiso) {
    $res = false;

    if(isset($_SESSION['rol'])) {
      $db = connectDB();
      $query = "SELECT * FROM PermisosXRol WHERE idRol='".$_SESSION['rol']."' AND idPermiso=".$permiso;
      $results = mysqli_query($db, $query);
      if(mysqli_num_rows($results) > 0) {
        $res = true;
      }
      closeDB($db);
    }
    return $res;
  }

  function getProductos($idcat){
    $db = connectDB();
    $query="SELECT P.idProducto, P.nombre, P.disponible, P.activo FROM Productos P WHERE P.idCategoria='$idcat' AND P.activo='1'";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }

  function getUpdateById($id,$num){
    $db = connectDB();
    $query="UPDATE Productos SET disponible='$num' WHERE idProducto='$id'";
    $results=mysqli_query($db,$query);
    closeDB($db);
  }

  function getProductos_Todos(){
    $db = connectDB();
    $query="SELECT * FROM Productos";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }


  function getProductoUnico($id){
    $db = connectDB();
    $query="SELECT * FROM Productos P WHERE P.idProducto='$id'";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }

function InsertarProducto($idcat, $price, $des,$nombre){
    $con = connectDB();
    $query='INSERT INTO Productos (idCategoria, precio, descripcion, nombre, disponible, activo) VALUES (?,?,?,?,?,?)';
    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }
    $idcat = $con->real_escape_string($idcat);
    $price = $con->real_escape_string($price);
    $des = $con->real_escape_string($des);
    $nombre = $con->real_escape_string($nombre);
    $des="$des";
    $nombre="$nombre";
    $num=1;
    if (!$statement->bind_param("ssssss", $idcat, $price, $des, $nombre,$num,$num)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }
    //echo $statement;
    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    } else {
      $_SESSION['idCompra']=mysqli_insert_id($con);
    }
    $statement->close();
    closeDB($con);
}

  function getRowClass($numFilas) {
    if($numFilas==1) {
      $class="prod-1row";
    } else if($numFilas==2) {
      $class="prod-2row";
    } else {
      $class="prod-3row";
    }

    return $class;
  }

  function getBtnClass($idCategoria) {
    switch($idCategoria) {
      case 1:
        $class="lime darken-1";
        break;
      case 2:
        $class="light-blue darken-1";
        break;
      case 3:
        $class="pink darken-1 ";
        break;
    }
    return $class;
  }

  function getBotones($idCategoria) {
    $productos=getProductosDisponibles($idCategoria);
    $cantProductos=mysqli_num_rows($productos);
    $numFilas=ceil($cantProductos/4);

    if($cantProductos > 0) {
      $btnClass = getBtnClass($idCategoria);
      $rowClass = getRowClass($numFilas);

      $stringBotones="<div class='row ".$rowClass."'>";
      $prodActual=1;
      while($row = mysqli_fetch_assoc($productos)) {
        $stringBotones.="<div class='col m3 full-height'><a href='productosDisp.php?idProducto=".$row['idProducto']."' class='waves-effect waves-light btn prod-btn ".$btnClass." valign-wrapper'>".$row['nombre']."</a></div>";

        if(($prodActual%4 == 0) && ($prodActual != $numFilas)) {
          $stringBotones.="</div><div class='row ".$rowClass."'>";
        }
        $prodActual++;
      }
      $stringBotones.="</div>";

    } else {
      $stringBotones="<p>No hay bebidas disponibles</p>";
    }

    return $stringBotones;
  }

  function checkBuyer($idUsuario) {
    $db = connectDB();

    $query= "SELECT * FROM Usuarios WHERE idUsuario='".$idUsuario."' AND idRol=2 AND activo=1";
    $results=mysqli_query($db,$query);

    closeDB($db);

    if(mysqli_num_rows($results) > 0) {
      return true;
    }
    else {
      return false;
    }
  }

  function iniciarCompra($idComprador, $idVendedor="") {
    $con = connectDB();

    $query='INSERT INTO Compras (idCompra, idUsuarioComprador, idUsuarioVendedor, horaFechaVenta, horaEntrega) VALUES (?,?,?,?,?)';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idCompra=NULL;
    $idComprador = $con->real_escape_string($idComprador);
    if($idVendedor=="") {
      // Si se empieza una compra en línea el vendedor es null
      $idVendedor=NULL;
    } else {
        $idVendedor = $con->real_escape_string($idVendedor);
    }
    date_default_timezone_set('America/Mexico_City');
    $horaFechaVenta = date("Y-m-d H:i:s");
    $horaEntrega = NULL;

    if (!$statement->bind_param("sssss", $idCompra, $idComprador, $idVendedor, $horaFechaVenta, $horaEntrega)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }

    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    } else {
      $_SESSION['idCompra']=mysqli_insert_id($con);
    }

    $statement->close();
    closeDB($con);
  }

  function agregarProductoACompra($idCompra, $idProducto) {

    $con = connectDB();

    $cantidad=getCantidad($con, $idCompra, $idProducto);

    if($cantidad > 0) {
      $statement=aumentarCantidadProducto($con, $idCompra, $idProducto, $cantidad);
    } else {
      $statement=insertarProductoEnCompra($con, $idCompra, $idProducto);
    }

    $statement->close();
    closeDB($con);
  }

  function getCantidad($con, $idCompra, $idProducto) {
    $query = "SELECT cantidad FROM ProductosXCompra WHERE idProducto=".$idProducto." AND idCompra=".$idCompra;
    $results=mysqli_query($con,$query);

    if(mysqli_num_rows($results) > 0) {
      $row=mysqli_fetch_assoc($results);
      return $row['cantidad'];
    }
    else {
      return 0;
    }
  }

  function insertarProductoEnCompra($con, $idCompra, $idProducto) {

    $query='INSERT INTO ProductosXCompra (idCompra, idProducto, cantidad, precioVenta) VALUES (?,?,?,?)';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idCompra = $con->real_escape_string($idCompra);
    $idProducto = $con->real_escape_string($idProducto);
    $cantidad = 1;
    $precioVenta = getPrecioProducto($idProducto);

    if (!$statement->bind_param("ssss", $idCompra, $idProducto, $cantidad, $precioVenta)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }

    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    }

    return $statement;
  }

  function aumentarCantidadProducto($con, $idCompra, $idProducto, $cantidad) {
    $cantidad++;
    $query='UPDATE ProductosXCompra SET cantidad=? WHERE idProducto=? AND idCompra=?';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idCompra = $con->real_escape_string($idCompra);
    $idProducto = $con->real_escape_string($idProducto);
    $cantidad = $con->real_escape_string($cantidad);

    if (!$statement->bind_param("sss", $cantidad, $idProducto, $idCompra)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }

    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    }

    return $statement;
  }

  function modificarCantidadProducto($idCompra, $idProducto, $cantidad) {
    $con=connectDB();
    $query='UPDATE ProductosXCompra SET cantidad=? WHERE idProducto=? AND idCompra=?';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idCompra = $con->real_escape_string($idCompra);
    $idProducto = $con->real_escape_string($idProducto);
    $cantidad = $con->real_escape_string($cantidad);

    if (!$statement->bind_param("sss", $cantidad, $idProducto, $idCompra)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }

    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    }

    $statement->close();
    closeDB($con);
  }

  function getPrecioProducto($idProducto) {
    $db = connectDB();

    $query= "SELECT precio FROM Productos WHERE idProducto=".$idProducto;
    $results=mysqli_query($db,$query);

    closeDB($db);

    $row=mysqli_fetch_assoc($results);
    return $row['precio'];
  }

  function getPassword($email) {
    $db = connectDB();

    $sql = "SELECT contrasena FROM Usuarios WHERE correo='".$email."' AND activo=1";

    $query = mysqli_query($db, $sql);

    if(mysqli_num_rows($query) > 0) {
      $resultstring = mysqli_fetch_row($query)[0];
    }
    else {
      $resultstring = false;
    }

    closeDB($db);

    return $resultstring;
  }

  function actualizarTicket($idCompra) {
    $db = connectDB();
    $sql = "SELECT P.nombre, PXC.cantidad FROM Productos AS P, ProductosXCompra AS PXC WHERE P.idProducto=PXC.idProducto AND PXC.idCompra=".$idCompra;
    $query = mysqli_query($db, $sql);
    closeDB($db);

    if(mysqli_num_rows($query) > 0) {
      $table="<table class='centered'><thead><tr><th>Artículo</th><th>Cantidad</th></tr></thead><tbody>";
      while($row = mysqli_fetch_assoc($query)) {
        $table.="<tr><td>".$row['nombre']."</td><td>".$row['cantidad']."</td></tr>";
      }
      $table.="</tbody></table>";
    }
    else {
      $table="No has agregado ningún producto por el momento.";
    }

    return $table;
  }


  function actualizarTicketEdicion($idCompra) {
    $db = connectDB();
    $sql = "SELECT P.idProducto, P.nombre, PXC.cantidad, PXC.precioVenta FROM Productos AS P, ProductosXCompra AS PXC WHERE P.idProducto=PXC.idProducto AND PXC.idCompra=".$idCompra;
    $query = mysqli_query($db, $sql);
    closeDB($db);

    if(mysqli_num_rows($query) > 0) {
      $table="<table class='centered'><thead><tr><th>Artículo</th><th>Cantidad</th><th>Precio</th><th>Total</th><th>Eliminar</th></tr></thead><tbody>";
      while($row = mysqli_fetch_assoc($query)) {
        $input="<form action='modificar_pedido.php' method='post'><input type='hidden' name='idProd' id='idProd' value='".$row['idProducto']."'/><div class='input-field col m4 offset-m4'>";
        $input.="<input id='cantidad' name='cantidad' type='number' class='validate'><label for='cantidad'>".$row['cantidad']."</label></div>";
        $input.="<div class='col m2'><button class='btn waves-effect waves-light small-font brown lighten-3 change-btn' type='submit'>Cambiar</button></div></form>";

        $table.="<tr><td>".$row['nombre']."</td><td>".$input."</td><td>$".$row['precioVenta']."</td><td>$".$row['cantidad']*$row['precioVenta']."</td><td><a href='modificar_pedido.php?idProdEliminar=".$row['idProducto']."'><i class='small material-icons icon-red'>cancel</i></a></td></tr>";
      }
      $table.="</tbody></table>";
    }
    else {
      $table="No has agregado ningún producto por el momento.";
    }

    return $table;
  }

  function actualizarTicketPago($idCompra) {
    $db = connectDB();
    $sql = "SELECT P.nombre, PXC.cantidad, PXC.precioVenta FROM Productos AS P, ProductosXCompra AS PXC WHERE P.idProducto=PXC.idProducto AND PXC.idCompra=".$idCompra;
    $query = mysqli_query($db, $sql);
    closeDB($db);
    $total=0;
    if(mysqli_num_rows($query) > 0) {
      $total=0;
      $table="<table class='centered'><thead><tr><th>Artículo</th><th>Cantidad</th><th>Precio</th><th>Total</th></tr></thead><tbody>";
      while($row = mysqli_fetch_assoc($query)) {
        $table.="<tr><td>".$row['nombre']."</td><td>".$row['cantidad']."</td><td>$".$row['precioVenta']."</td><td>$".$row['cantidad']*$row['precioVenta']."</td></tr>";
        $total+=($row['cantidad']*$row['precioVenta']);
      }
      $table.="<tr><td></td><td></td><td><strong>Total</strong></td><td><strong>$".$total."</strong></td></tr>";
      $table.="</tbody></table>";
    }
    else {
      $table="No has agregado ningún producto por el momento.";
    }
    $_SESSION['totalAPagar']=$total; //pagoTotal es para pagos independientes
    return $table;
  }

  function actualizarTicketDeuda($idUsuario) {
    $db = connectDB();
    $sql = "SELECT nombre, apellidoPaterno, apellidoMaterno, deuda FROM Usuarios WHERE idUsuario=".$idUsuario;
    $query = mysqli_query($db, $sql);
    closeDB($db);

    if(mysqli_num_rows($query) > 0) {
      $table="<table class='centered'><thead><tr><th>Nombre del usuario</th><th>Deuda</th></tr></thead><tbody>";
      while($row = mysqli_fetch_assoc($query)) {
        $_SESSION['pagoTotal'] = $row['deuda'];
        $table.="<tr><td>".$row['nombre']." ".$row['apellidoPaterno']." ".$row['apellidoMaterno']."</td><td>$".$row['deuda']."</td></tr>";
      }
      $table.="</tbody></table>";
    }
    else {
      $table="No hay usuarios con ese ID.";
    }

    return $table;
  }

  function cancelarCompra($idCompra) {
    $db = connectDB();
    $sql = "DELETE FROM ProductosXCompra WHERE idCompra=".$idCompra;
    $query = mysqli_query($db, $sql);
    $sql = "DELETE FROM Compras WHERE idCompra=".$idCompra;
    $query = mysqli_query($db, $sql);
    closeDB($db);

    $_SESSION['idCompra']="";
    $_SESSION['idComprador']="";
  }

  function eliminarProdDeCompra($idCompra, $idProd) {
    $db = connectDB();
    $sql = "DELETE FROM ProductosXCompra WHERE idCompra=".$idCompra." AND idProducto=".$idProd;
    $query = mysqli_query($db, $sql);
    closeDB($db);
  }


  function getSaldo($usuario) {
    $db = connectDB();

    $sql = "SELECT deuda FROM Usuarios WHERE idUsuario='$usuario' AND activo=1";

    $query = mysqli_query($db, $sql);

    if(mysqli_num_rows($query) > 0) {
      $resultstring = mysqli_fetch_row($query)[0];
    }
    else {
      $resultstring = "Error al obtener el saldo del usuario.";
    }

    closeDB($db);

    return $resultstring;

  }

  function UpdateProducto($id, $des, $price,$cate){

    $db = connectDB();
    $query="UPDATE Productos SET idCategoria='$cate', descripcion='$des', precio='$price' WHERE idProducto='$id'";
    if(mysqli_query($db,$query)){
      closeDB($db);
      return true;
    }else{
      closeDB($db);
      return false;
    }
  }

  function DeleteProducto($id){
    $db = connectDB();
    $query="UPDATE Productos SET activo='0' Where idProducto='$id'";
    if(mysqli_query($db,$query)){
      closeDB($db);
      return true;
    }else{
      closeDB($db);
      return false;
    }

  }

    function activarProducto($id){
    $db = connectDB();
    $query="UPDATE Productos SET activo='1' Where idProducto='$id'";
    if(mysqli_query($db,$query)){
      closeDB($db);
      return true;
    }else{
      closeDB($db);
      return false;
    }

  }

  function getUsuariosTodosActivos(){
    $db = connectDB();
    $query="SELECT * FROM Usuarios WHERE activo='1'";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }

  function getUsuarioUnico($id){
    $db = connectDB();
    $query="SELECT * FROM Usuarios WHERE idUsuario='".$id."'";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }

  function updateUsuarioRolAct($id,$rol) {
    $db = connectDB();
    $query="UPDATE Usuarios SET idRol='$rol' WHERE idUsuario='$id'";
    if(mysqli_query($db,$query)){
      closeDB($db);
      return true;
    }else{
      closeDB($db);
      return false;
    }
  }

  function getUsuariosTodosInactivos(){
    $db = connectDB();
    $query="SELECT * FROM Usuarios WHERE activo='0'";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }

  function desactivarUsuario($id){
    $db = connectDB();
    $query="UPDATE Usuarios SET activo='0' WHERE idUsuario='$id'";
    if(mysqli_query($db,$query)){
      closeDB($db);
      return true;
    }else{
      closeDB($db);
      return false;
    }
  }

  function activarUsuario($id){
    $db = connectDB();
    $query="UPDATE Usuarios SET activo='1' WHERE idUsuario='$id'";
    if(mysqli_query($db,$query)){
      closeDB($db);
      return true;
    }else{
      closeDB($db);
      return false;
    }
  }

  function getDeudores() {
    $db = connectDB();
    $sql = "SELECT nombre, apellidoPaterno, idUsuario, deuda FROM Usuarios WHERE deuda>0 AND idRol=2 AND activo=1";
    $query = mysqli_query($db, $sql);
    closeDB($db);
    return $query;
  }


  function getAvComidaT() {//Av stands for available, T for table
    $db = connectDB();

    $sql = "SELECT nombre,precio FROM Productos WHERE disponible=1 AND idCategoria=1 AND activo=1";

    $query = mysqli_query($db, $sql);
    closeDB($db);

    $i = 0;

    if(mysqli_num_rows($query) > 0) {
        $table="<ol><strong>Comida</strong>";
        while($row = mysqli_fetch_assoc($query)) {//solo queremos mostrar tres platillos
          if($i < 3){
             $table.="<li>".$row['nombre']." - $".$row['precio']."</li>";
            $i++;
          }
        }
        $table.="</ol>";
      }

    return $table;
  }

  function getAvPostreT() {//Av stands for available, T for table
    $db = connectDB();

    $sql = "SELECT nombre,precio FROM Productos WHERE disponible=1 AND idCategoria=3 AND activo=1";

    $query = mysqli_query($db, $sql);
    closeDB($db);

    $i = 0;

    if(mysqli_num_rows($query) > 0) {
        $table="<ol><strong>Postre</strong>";
        while($row = mysqli_fetch_assoc($query)) {//solo queremos mostrar tres platillos
          if($i < 3){
             $table.="<li>".$row['nombre']." - $".$row['precio']."</li>";
            $i++;
          }
        }
        $table.="</ol>";
      }

    return $table;
  }



  function obtenerUsuario($id){
     $db = connectDB();
     $sql="SELECT * FROM Usuarios WHERE idUsuario='$id'";
     $query = mysqli_query($db,$sql);
     closeDB($db);
     return $query;
  }

  function updatePersonalUser($id,$nom,$ap,$am,$tel,$mail){
    $db = connectDB();
    $sql = "UPDATE Usuarios SET nombre = '$nom', apellidoPaterno='$ap', apellidoMaterno='$am', telefono='$tel', correo='$mail'  WHERE idUsuario = '$id'";
    $query = mysqli_query($db,$sql);
    closeDB($db);
    return $query;
  }

   function updateSaldo($usuario,$nuevo) {
    $db = connectDB();
    $saldoActual=getSaldo($usuario);

    $nuevoA=$saldoActual-$nuevo;

    //$sql = "UPDATE Usuarios SET deuda=".$nuevo."WHERE Usuarios.idUsuario=".$usuario;
    $sql = "UPDATE Usuarios SET deuda = '$nuevoA' WHERE idUsuario = '$usuario' AND activo=1";
    $met=5;

    registrarPago($met,$usuario,$nuevo);

    $query = mysqli_query($db, $sql);

    if($query) {
      $res=true;
    }
    else {
      $res=false;
    }

    closeDB($db);

    return $res;

  }

  function registrarPago($idmetodo, $idusuario, $cantidad) {
    //Este pago es cuando se NO hace una compra , SOLO un pago
    $con = connectDB();

    $query='INSERT INTO Pagos (idPago, idMetodoPago, idUsuario, cantidadPago, horaFechaPago) VALUES (?,?,?,?,?)';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idPago=NULL;
    $idmetodo = $con->real_escape_string($idmetodo);
    $idusuario = $con->real_escape_string($idusuario);
    $cantidad = $con->real_escape_string($cantidad);
    date_default_timezone_set('America/Mexico_City');
    $horaFechaPago = date("Y-m-d H:i:s");

    if (!$statement->bind_param("sssss", $idPago, $idmetodo, $idusuario, $cantidad, $horaFechaPago)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }

    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    }

    $statement->close();

    $query="UPDATE Usuarios SET deuda=deuda-'$cantidad' WHERE idUsuario='$idusuario'";
    $results=mysqli_query($con,$query);

    closeDB($con);
  }

  function fiarTotal($idusuario, $cantidad) {
    $con = connectDB();

    $query='INSERT INTO Pagos (idPago, idMetodoPago, idUsuario, cantidadPago, horaFechaPago) VALUES (?,?,?,?,?)';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idPago=NULL;
    $idmetodo = '3';
    $idusuario = $con->real_escape_string($idusuario);
    $cantidad = $con->real_escape_string($cantidad);
    date_default_timezone_set('America/Mexico_City');
    $horaFechaPago = date("Y-m-d H:i:s");

    if (!$statement->bind_param("sssss", $idPago, $idmetodo, $idusuario, $cantidad, $horaFechaPago)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }

    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    }

    $statement->close();

    $query="UPDATE Usuarios SET deuda=deuda+'$cantidad' WHERE idUsuario='$idusuario'";
    $results=mysqli_query($con,$query);

    closeDB($con);
  }

  function registrarPagoCompra($idmetodo, $idusuario, $cantidadPagada, $cantidadTotal) {
    //Este pago es cuando se hace una compra
    $con = connectDB();

    $query='INSERT INTO Pagos (idPago, idMetodoPago, idUsuario, cantidadPago, horaFechaPago) VALUES (?,?,?,?,?)';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idPago=NULL;
    $idmetodo = $con->real_escape_string($idmetodo);
    $idusuario = $con->real_escape_string($idusuario);
    $cantidadPagada = $con->real_escape_string($cantidadPagada);
    date_default_timezone_set('America/Mexico_City');
    $horaFechaPago = date("Y-m-d H:i:s");

    if (!$statement->bind_param("sssss", $idPago, $idmetodo, $idusuario, $cantidadPagada, $horaFechaPago)) {
      die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
    }

    if (!$statement->execute()) {
      die("Execution failed: (" . $statement->errno . ") " . $statement->error);
    }



    if($cantidadTotal-$cantidadPagada != 0) {
      $query="UPDATE Usuarios SET deuda=deuda+'$cantidadTotal'-'$cantidadPagada' WHERE idUsuario='$idusuario'";
      $results=mysqli_query($con,$query);

      if($cantidadTotal-$cantidadPagada > 0) {
        $cant=$cantidadTotal-$cantidadPagada;
        $metodo=3;
        if (!$statement->bind_param("sssss", $idPago, $metodo, $idusuario, $cant, $horaFechaPago)) {
          die("Parameter vinculation failed: (" . $statement->errno . ") " . $statement->error);
        }

        if (!$statement->execute()) {
          die("Execution failed: (" . $statement->errno . ") " . $statement->error);
        }
      }
    }

    $statement->close();
    closeDB($con);
  }

  function getCorteCaja($tipo,$horainicio,$horafin){
    $db = connectDB();
    $query = "Select Sum(cantidadPago) as Pago From Pagos Where idMetodoPago='$tipo' AND horaFechaPago>='$horainicio' AND horaFechaPago<='$horafin'";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }

  function getMails(){
    $db = connectDB();
    $query = "Select correo FROM Usuarios WHERE idUsuario=25";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }


  function getNumberOfSells($horainicio,$horafin){
    $db = connectDB();
    $query = "Select Count(*) as Cantidad From Compras Where horaFechaVenta>='$horainicio' AND horaFechaVenta<='$horafin'";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }


  function getReporteProductosVendidos($horainicio,$horafin){
    $db = connectDB();
    $query = "SELECT P.nombre, SUM(PC.cantidad) as Total
    FROM Productos P, ProductosXCompra PC, Compras C
    WHERE P.idProducto=PC.idProducto AND C.idCompra=PC.idCompra AND C.horaFechaVenta>='$horainicio' AND C.horaFechaVenta<='$horafin'
    GROUP BY P.nombre";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }

  function getUsuarioDeudaMaxima(){
    $db = connectDB();
    $query = "SELECT MAX(deuda) as Deuda
    From Usuarios
    WHERE activo=1";
    $res = mysqli_query($db, $query);
    $row=mysqli_fetch_assoc($res);
	  $deud=$row["Deuda"];
	  $query = "SELECT nombre, apellidoPaterno, apellidoMaterno
    From Usuarios
    WHERE deuda='$deud'";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }

  function getUsuarioDeudaMinima(){
    $db = connectDB();
    $query = "SELECT MIN(deuda) as Deuda
    From Usuarios
    WHERE activo=1 AND deuda>0";
    $res = mysqli_query($db, $query);
    $row=mysqli_fetch_assoc($res);
	  $deud=$row["Deuda"];
	  $query = "SELECT nombre, apellidoPaterno, apellidoMaterno
    From Usuarios
    WHERE deuda='$deud'";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }

  function getPromedioDeuda(){
    $db = connectDB();
    $query = "SELECT AVG(deuda) as Deuda
    From Usuarios
    WHERE activo=1";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }

  function mejorVendedor($horainicio,$horafin){
    $db = connectDB();
    $query = "SELECT idUsuarioVendedor, COUNT(idUsuarioVendedor) as ID
    FROM Compras
    WHERE idUsuarioVendedor!='NULL' AND horaFechaVenta>='$horainicio' AND horaFechaVenta<='$horafin'
    GROUP BY idUsuarioVendedor
    ORDER BY Count(idUsuarioVendedor) DESC
    LIMIT 1";
    $res = mysqli_query($db, $query);
	  $row=mysqli_fetch_assoc($res);
		$mejorVendedor=$row["idUsuarioVendedor"];
		$query = "SELECT idUsuario, nombre, apellidoPaterno, apellidoMaterno
    From Usuarios
    WHERE idUsuario='$mejorVendedor'";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }

  function peorVendedor($horainicio,$horafin){
    $db = connectDB();
    $query = "SELECT idUsuarioVendedor, COUNT(idUsuarioVendedor) as ID
    FROM Compras
    WHERE idUsuarioVendedor!='NULL' AND horaFechaVenta>='$horainicio' AND horaFechaVenta<='$horafin'
    GROUP BY idUsuarioVendedor
    ORDER BY Count(idUsuarioVendedor) ASC
    LIMIT 1";
    $res = mysqli_query($db, $query);
	  $row=mysqli_fetch_assoc($res);
		$mejorVendedor=$row["idUsuarioVendedor"];
		$query = "SELECT idUsuario, nombre, apellidoPaterno, apellidoMaterno
    From Usuarios
    WHERE idUsuario='$mejorVendedor'";
    $res = mysqli_query($db, $query);
    closeDB($db);
    return $res;
  }

  function highestSold() {//recupera los tres platillos mas vendidos
    $db = connectDB();

    $query = "SELECT idProducto, COUNT(idProducto) AS n FROM ProductosXCompra GROUP BY idProducto ORDER BY n DESC LIMIT 3";

    $res = mysqli_query($db, $query);

    $buttonString="";

    while($row = mysqli_fetch_assoc($res)) {//solo queremos mostrar tres platillos
      $mostSold=$row['idProducto'];
      $query = "SELECT nombre,idProducto FROM Productos WHERE disponible=1 AND idProducto='$mostSold' AND activo=1";
      $res2 = mysqli_query($db, $query);
      $row2 = mysqli_fetch_assoc($res2);
      $buttonString.="<div class='row'><div class='col m12'><a href='productosDisp.php?idProducto=".$mostSold."&individual=1' class='waves-effect waves-light btn orange darken-1 reciente-btn valign-wrapper'>".$row2['nombre']."</a></div></div>";
    }

    closeDB($db);

    return $buttonString;

  }

  //categorias: 1 - comida, 2 - bebida, 3 - postre
  function getAvBebidaT() {//Av stands for available, T for table
    $db = connectDB();

    $sql = "SELECT nombre,precio FROM Productos WHERE disponible=1 AND idCategoria=2 AND activo=1";

    $query = mysqli_query($db, $sql);
    closeDB($db);

    $i = 0;

    if(mysqli_num_rows($query) > 0) {
        $table="<ol><strong>Bebidas</strong>";
        while($row = mysqli_fetch_assoc($query)) {//solo queremos mostrar tres platillos
          if($i < 3){
             $table.="<li>".$row['nombre']." - $".$row['precio']."</li>";
            $i++;
          }
        }
        $table.="</ol>";
      }

    return $table;
  }

?>
