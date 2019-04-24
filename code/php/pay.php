<?php

    session_start();

    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;

    require 'app/start.php';
    require 'util.php';



    if ((bool)$_GET['success'] === false) {
        echo '<script type="text/javascript">alert("Pago NO realizado! Favor de volver a intentar.");</script>';
        header( "refresh:.1; url=inicio.php" );

        die();
    }

    if (isset($_GET['success']) && isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
        //echo '<script type="text/javascript">alert("Datos recibidos!");</script>';
        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];

        $payment = Payment::get($paymentId,$paypal);

        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try{
            //echo '<script type="text/javascript">alert("Pago realizado!");</script>';
            $result = $payment->execute($execute, $paypal);
        }catch(Execute $e){
            //echo '<script type="text/javascript">alert("Pago NO realizado!");</script>';
            $data = json_decode($e->getData());
            //var_dump($data);
            echo $data->message;//mostrando mensaje de error
            die();
        }
        $metodo = 4;//paypal method
        registrarPagoCompra($metodo, $_SESSION['idUsuario'], $_SESSION['pago'], $_SESSION['totalAPagar']);
        //echo 'Payment made. Thanks!';
        echo '<script type="text/javascript">alert("Pago realizado correctamente. Gracias!");</script>';
        header( "refresh:.1; url=inicio.php?realizado=1" );
    }else{
        echo '<script type="text/javascript">alert("Pago NO realizado! Favor de volver a intentar.");</script>';
        header( "refresh:.1; url=inicio.php" );
        die();
    }
