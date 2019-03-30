<?php
  if(!isset($_SESSION))
    {
        session_start();
    }

  function footerhtml() {
    include "partials/_footer.html";
  }

  function connectDB() {
    $servername = "localhost";
    $username = "symphony";
    $password = "3lm3j0r3quip0";
    $dbname = "Symphony";

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

    $query = "SELECT * FROM Usuarios WHERE idUsuario = '$usuario' AND contrasena = '$passwd'";
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

  function getName($id){
    $db = connectDB();

    $query = "SELECT nombre FROM Usuarios WHERE idUsuario='".$id."'";//Check whether if the user exists
    $res = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($res);

    closeDB($db);

    return $row['nombre'];
  }

  function getDeuda($id){
    $db = connectDB();

    $query = "SELECT deuda FROM Usuarios WHERE idUsuario='".$id."'";//Check whether if the user exists
    $res = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($res);

    closeDB($db);

    return $row['deuda'];
  }

  function createUser($nombre, $apellidoPaterno, $apellidoMaterno, $telefono, $correo, $fechaNacimiento, $contrasena){
    $db = connectDB();
    $deuda = 0;// todos tienen una deuda inicial de 0 pesos
    $query = "INSERT INTO Usuarios ".
               "(idUsuario,idRol, nombre, apellidoPaterno, apellidoMaterno, telefono, correo, fechaNacimiento, contrasena, deuda) "."VALUES ".
               "(NULL,'2','$nombre','$apellidoPaterno','$apellidoMaterno','$telefono','$correo','$fechaNacimiento','$contrasena', '$deuda')";
               mysqli_select_db($db,'Symphony');

    //$retval = mysqli_query($sql, $conn);
    $res = mysqli_query($db, $query);
    //echo $fechaNacimiento;
    if(! $res ){
      die('Could not enter data: ' . mysqli_error($db));
      $flag = 0;
    }else{
      echo '<script type="text/javascript">alert("Usuario agregado correctamente!");</script>';
      header( "refresh:.1; url=inicio.php" );
    }

    closeDB($db);
  }

  function getRol($id) {
    $db = connectDB();

    $query = "SELECT idRol FROM Usuarios WHERE idUsuario='".$id."'";
    $role = mysqli_query($db, $query);
    $roleid = mysqli_fetch_assoc($role);

    closeDB($db);

    return $roleid['idRol'];
  }

  function getPasswordHashed($id) {
    $db = connectDB();

    $sql = "SELECT contrasena FROM Usuarios WHERE idUsuario='".$id."'";
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
    $db = connectDB();

    $query = "SELECT * FROM PermisosXRol WHERE idRol='".$_SESSION['rol']."' AND idPermiso=".$permiso;
    $results = mysqli_query($db, $query);
    if(mysqli_num_rows($results) > 0) {
      $res = true;
    }
    else {
      $res = false;
    }
    closeDB($db);

    return $res;
  }

  function getProductos($idcat){
    $db = connectDB();
    $query="CALL `obtener_productos` ('$idcat')";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }

  function getUpdateById($idProducto,$num){
    $db = connectDB();
    $query="CALL `modificar_disponibilidad` ('$idProducto','$num')";
    $results=mysqli_query($db,$query);
    closeDB($db);
  }

  function getProductos_Todos(){
    $db = connectDB();
    $query="CALL `obtener_productos_todos` ()";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }


  function getProductoUnico($id){
    $db = connectDB();
    $query="CALL `obtener_producto_id` ('$id')";
    $results=mysqli_query($db,$query);
    closeDB($db);
    return $results;
  }

  function InsertarProducto($idcat, $precio, $descripcion,$nombre){
    $db = connectDB();
    $query="CALL `insertar_producto` ('$idcat','$precio','$descripcion','$nombre')";
    if(mysqli_query($db,$query)) return true;
    else false;
    closeDB($db);
  }

  function getProductosDisponibles($idCategoria){
    $db = connectDB();

    $query= "SELECT idProducto, nombre FROM Productos WHERE idCategoria='".$idCategoria."' AND disponible=1";
    $results=mysqli_query($db,$query);

    closeDB($db);

    return $results;
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
        $class.="lime darken-1";
        break;
      case 2:
        $class.="light-blue darken-1";
        break;
      case 3:
        $class.="pink darken-1 ";
        break;
    }
    return $class;
  }

  function getBotones($idCategoria) {
    $productos=getProductosDisponibles($idCategoria);
    $cantProductos=mysqli_num_rows($productos);

    if($cantProductos > 0) {
      $btnClass = getBtnClass($idCategoria);
      $rowClass = getRowClass(ceil($cantProductos/4));

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

    $query= "SELECT * FROM Usuarios WHERE idUsuario='".$idUsuario."' AND idRol=2";
    $results=mysqli_query($db,$query);

    closeDB($db);

    if(mysqli_num_rows($results) > 0) {
      return true;
    }
    else {
      return false;
    }
  }

  function iniciarCompra($idComprador, $idVendedor) {
    $con = connectDB();

    $query='INSERT INTO Compras (idCompra, idUsuarioComprador, idUsuarioVendedor, horaFechaVenta, horaEntrega) VALUES (?,?,?,?,?)';

    if (!($statement = $con->prepare($query))) {
      die("Preparation failed: (" . $con->errno . ") " . $con->error);
    }

    $idCompra=NULL;
    $idComprador = $con->real_escape_string($idComprador);
    $idVendedor = $con->real_escape_string($idVendedor);
    $horaFechaVenta=NULL;
    $horaEntrega=NULL;

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

    $sql = "SELECT contrasena FROM Usuarios WHERE correo='".$email."'";

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

        $table.="<tr><td>".$row['nombre']."</td><td>".$input."</td><td>$".$row['precioVenta']."</td><td>$".$row['cantidad']*$row['precioVenta']."</td><td><a href='modificar_pedido.php?idProdEliminar=".$row[idProducto]."'><i class='small material-icons icon-red'>cancel</i></a></td></tr>";
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

//categorias: 1 - comida, 2 - bebida, 3 - postre
  function getAvBebida() {//Av stands for available
    $db = connectDB();

    $sql = "SELECT nombre FROM Productos WHERE disponible=1 AND idCategoria=2";

    $query = mysqli_query($db, $sql);

    /*while($row = mysqli_fetch_assoc($query)) {

    }*/

    if(mysqli_num_rows($query) > 0) {
      $resultstring = mysqli_fetch_row($query)[0];
    }
    else {
      $resultstring = "No hay bebidas disponibles, favor de acudir al punto de venta físico.";
    }

    closeDB($db);

    return $resultstring;

  }

  function getAvComida() {//Av stands for available
    $db = connectDB();

    $sql = "SELECT nombre FROM Productos WHERE disponible=1 AND idCategoria=1";

    $query = mysqli_query($db, $sql);

    if(mysqli_num_rows($query) > 0) {
      $resultstring = mysqli_fetch_row($query)[0];
    }
    else {
        $resultstring = "No hay platillos disponibles, favor de acudir al punto de venta físico.";
    }

    closeDB($db);

    return $resultstring;

  }

  function getAvPostre() {//Av stands for available
    $db = connectDB();

    $sql = "SELECT nombre FROM Productos WHERE disponible=1 AND idCategoria=3";

    $query = mysqli_query($db, $sql);

    if(mysqli_num_rows($query) > 0) {
      $resultstring = mysqli_fetch_row($query)[0];
    }
    else {
      $resultstring = "No hay postres disponibles, favor de acudir al punto de venta físico.";
    }

    closeDB($db);

    return $resultstring;

  }


  
  function UpdateProducto($id, $descripcion, $precio,$cate){
    $db = connectDB();
    $query="CALL `update_producto` ('$id','$descripcion','$precio','$cate')";
    if(mysqli_query($db,$query)) return true;
    else false;
    closeDB($db);
  }
  
  function DeleteProducto($id){
    $db = connectDB();
    $query="CALL `delete_producto` ('$id')";
    if(mysqli_query($db,$query)) return true;
    else false;
    closeDB($db);
  }

?>
