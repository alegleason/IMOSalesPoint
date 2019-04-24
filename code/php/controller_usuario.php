<?php
require_once "util.php";
//If all data is present
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['lastname2']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['fechanacimiento']) && isset($_POST['passwords']) && isset($_POST['passwordss'])){
  //Retrieving data by POST, on a safe way, preventing XSS
  $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
  $lastname = htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8');
  $lastname2 = htmlspecialchars($_POST['lastname2'], ENT_QUOTES, 'UTF-8');
  $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
  $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
  $fechanacimiento = $_POST['fechanacimiento'];
  $passwords = htmlspecialchars($_POST['passwords'], ENT_QUOTES, 'UTF-8');
  $passwordss = htmlspecialchars($_POST['passwordss'], ENT_QUOTES, 'UTF-8');
  $passwordCifrado = password_hash($passwords, PASSWORD_DEFAULT);
  createUser($name, $lastname, $lastname2, $phone, $email, $fechanacimiento, $passwords);
}else{
  echo '<script type="text/javascript">alert("Datos recibidos incorrectamente!");</script>';
  header('Location: '.$_SERVER['HTTP_REFERER']);//Redirecting
}

?>
