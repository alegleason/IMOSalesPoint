<?php
   require_once("util.php");
   if (isset($_POST['mail_to'])) {
    if (checkUsr($_POST['mail_to'])) {
      $mailto = htmlspecialchars($_POST['mail_to']);
      $pass=getPassword($mailto);
      $mailSub = "Ayuda con recuperar tu clave.";
      $mailMsg = "Tu clave es: ".$pass."<br><br>Favor de eliminar este correo por seguridad.";
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

     if(!$mail->Send())
     {
        echo '<script type="text/javascript">alert("Correo no enviado.");</script>';
        header( "refresh:.1; url=inicio.php" );
     }
     else
     {
        echo '<script type="text/javascript">alert("Correo enviado correctamente!");</script>';
        header( "refresh:.1; url=inicio.php" );
     }
    }else{
      echo '<script type="text/javascript">alert("No existe usuario con ese correo!");</script>';
      header( "refresh:.1; url=inicio.php" );
    }
   }else{
        echo '<script type="text/javascript">alert("Tu correo no fue recibido correctamente, favor de ingresarlo de nuevo!");</script>';
        header( "refresh:.1; url=forgot.php" );
   }
    
?>