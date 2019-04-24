<?php
session_start();

require_once("util.php");

include 'partials/_header.html';

$error = "";
    //Starting the session
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST["idU"]) && isset($_POST["nuevo"])) {
    	$id=htmlspecialchars($_POST["idU"]);
    	$new=htmlspecialchars($_POST["nuevo"]);
        if (ouB($id)) {
            if(updateSaldo($id,$new)){
                $table=getDeudores();
                echo '<script type="text/javascript">alert("Saldo actualizado correctamente!");</script>';
                header( "refresh:.1; url=pendientes.php" );
            }else{
                echo '<script type="text/javascript">alert("Error al actualizar el saldo, favor de volver a intentar");</script>';
                header( "refresh:.1; url=pendientes.php" );
            }
        }else{
            echo '<script type="text/javascript">alert("El usuario no existe");</script>';
            header( "refresh:.1; url=pendientes.php" );
        }
    }else {
    //echo '<script type="text/javascript">alert(NO SE RECIBIO ALGO!");</script>';
    include 'partials/pendientes.html';
    }
 } else {
 	//echo '<script type="text/javascript">alert("NO ES POST!");</script>';
    include 'partials/pendientes.html';
 }
include 'partials/_footer.html';
?>
