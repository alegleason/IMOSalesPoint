<?php

require 'vendor/autoload.php';

//define('SITE_URL', 'http://192.168.64.2/code/php');
define('SITE_URL', 'http://localhost:8888/proyecto/code/php');

$paypal = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential('ARvI9kVDKs7DkgrLvZvYeXdIrDEq0aODoEQG7qpnkfpfrVt4KhZ-v99V_F3TH6stadCYvhJNMl0GvmdI',
		'EMol4auGbZWhjUnEZvfnsdgoHzGDYFwtDC5dhDwP2QfKryfvarRMyeWesG6cGhXPXvqj5WEeEO0CQ3El'
	)
);
