<?php

// Add zend library
set_include_path(implode(PATH_SEPARATOR, array(
    realpath('/path/to/zend/library'),
    get_include_path()
)));

// Begin script

require_once 'Infobip_sms_api.php';

$infobip = new Infobip_sms_api();
$infobip->setUsername('username');
$infobip->setPassword('password');

// OR
$infobip = new Infobip_sms_api(array(
    Infobip_sms_api::USERNAME => 'username',
    Infobip_sms_api::PASSWORD => 'password'
));

// Get balance -------------------------------------------------
$balance = $infobip->getBalance();

echo '<pre>';
print_r($balance);
echo '</pre>';

// Return
/*
  stdClass Object
  (
        [value] => 0.7900
        [currency] => €
  )
 */

echo $balance->value;
echo $balance->currency;