<?php
     require_once("util.php");
     //$mailto = htmlspecialchars($_GET['monto']);
     $mailto="salvador.espinosa@imoiap.edu.mx";
     $monto=htmlspecialchars($_GET['monto']);
     $efectivo=htmlspecialchars($_GET['efect'])+200;
     $tarjeta=htmlspecialchars($_GET['tar']);
     $fiar=htmlspecialchars($_GET['fiar']);
     $mailSub = "Corte de Caja";
     $mailMsg = "El monto total en caja es: ".$monto."<br><br>----El desglose se presenta a continuación----.<br> - Monto en efectivo: ".$efectivo."<br> - Monto en tarjeta: ".$tarjeta."<br> - Monto fiado: ".$fiar."<br>";
     require 'PHPMailer-master/PHPMailerAutoload.php';
     $mail = new PHPMailer();
     $mail ->IsSmtp();
     $mail ->SMTPDebug = 0;
     $mail ->SMTPAuth = true;
     $mail ->SMTPSecure = 'ssl';
     $mail ->Host = "smtp.gmail.com";
     $mail ->Port = 465; // o 587
     $mail ->IsHTML(true);
     $mail ->Username = "imoiapmail@gmail.com";
     $mail ->Password = "Imoiap1234";
     $mail ->SetFrom("no-reply");
     $mail ->Subject = $mailSub;
     $mail ->Body = $mailMsg;
     $mail ->AddAddress($mailto);

     if($mail->Send()) return true;
     else return false;
    
?>