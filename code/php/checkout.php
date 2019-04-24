<?php

  session_start();

	use PayPal\Api\Payer;
	use PayPal\Api\Item;
	use PayPal\Api\ItemList;
	use PayPal\Api\Details;
	use PayPal\Api\Amount;
	use PayPal\Api\Transaction;
	use PayPal\Api\RedirectUrls;
	use PayPal\Api\Payment;

  require 'app/start.php';
  require 'util.php';

    if (isset($_POST['payP'])) {//Caso cuando vas a pagar todo lo de tu ticket
        $price=$_SESSION['totalAPagar'];
        $shipping=0;
        $_SESSION['pago']=$price;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName('abono')
            ->setCurrency('MXN')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping);

        $amount = new Amount();
        $amount->setCurrency('MXN')
            ->setTotal($price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)//recieves an amount
            ->setItemList($itemList)
            ->setDescription('Abono a saldo con PayPal')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
            ->setCancelUrl(SITE_URL . '/pay.php?success=false');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try{
            $payment->create($paypal);
        }catch(Exception $e){
            die($e);
        }

        $approvalUrl = $payment->getApprovalLink();

        header("Location: {$approvalUrl}");
    }
    else if (!isset($_POST['price'])) {
    	die();
    } else {//Caso cuando vas a pagar parte
    	$price=$_POST['price'];
    	$shipping=0;
      $_SESSION['pago']=$price;

    	$payer = new Payer();
    	$payer->setPaymentMethod('paypal');

    	$item = new Item();
    	$item->setName('abono')
    		->setCurrency('MXN')
    		->setQuantity(1)
    		->setPrice($price);

    	$itemList = new ItemList();
    	$itemList->setItems([$item]);

    	$details = new Details();
    	$details->setShipping($shipping);

    	$amount = new Amount();
    	$amount->setCurrency('MXN')
    		->setTotal($price);

    	$transaction = new Transaction();
    	$transaction->setAmount($amount)//recieves an amount
    		->setItemList($itemList)
    		->setDescription('Abono a saldo con PayPal')
    		->setInvoiceNumber(uniqid());

    	$redirectUrls = new RedirectUrls();
    	$redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
    		->setCancelUrl(SITE_URL . '/pay.php?success=false');

    	$payment = new Payment();
    	$payment->setIntent('sale')
    		->setPayer($payer)
    		->setRedirectUrls($redirectUrls)
    		->setTransactions([$transaction]);

    	try{
    		$payment->create($paypal);
    	}catch(Exception $e){
    		die($e);
    	}

    	$approvalUrl = $payment->getApprovalLink();

    	header("Location: {$approvalUrl}");
    }
