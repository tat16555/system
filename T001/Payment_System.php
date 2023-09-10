<?php
require_once '../config/course_information.php';
require_once('../omise-php/lib/Omise.php');
define('OMISE_PUBLIC_KEY', 'pkey_test_5up309jgwjbj6ou8fs6');
define('OMISE_SECRET_KEY', 'skey_test_5up309jgwjbj6ou8fs6');

if (!empty($_POST['omiseToken'])) {
  try {
    $charge = OmiseCharge::create(array(
      'amount' => $_POST['amount'],
      'currency' => 'thb',
      'card' => $_POST['omiseToken']
    ));

    if ($charge['status'] == 'successful') {
      echo 'Payment Successful';
    } else {
      echo 'Payment failed: ' . $charge['failure_message'];
    }
  } catch (OmiseException $e) {
    echo 'Payment failed: ' . $e->getMessage();
  }
} else {
  echo 'Error: Missing required Omise Token';
}
?>