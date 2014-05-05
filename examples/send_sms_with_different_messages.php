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

// Send SMS with differrent messages --------------------------------------------------------

$infobip->setMethod(Infobip_sms_api::OUTPUT_XML); // With xml method
$infobip->setMethod(Infobip_sms_api::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Infobip_sms_api::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();
$message->setSender('Sender 1'); // Sender name
$message->setText('Message 1'); // Message
$message->setType(Infobip_sms_message::LONG_SMS);
$message->setRecipients('phone1');


$message2 = new Infobip_sms_message();
$message2->setSender('Sender 2');
$message2->setDatacoding(Infobip_sms_message::UNICODE);
$message2->setSendDateTime('0d0h2m0s');
$message2->setText('Message 1 ������');
$message2->setRecipients('phone2');
$message2->setRecipients('phone3');
$message2->setRecipients('phone4');
$message2->setRecipients('phone5');

$infobip->addMessages(array(
    $message,
    $message2
));

$results = $infobip->sendSMS();

echo '<pre>';
print_r($results);
echo '</pre>';
