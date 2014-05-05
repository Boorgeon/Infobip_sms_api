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

// Send 1 SMS to 1 --------------------------------------------------------

$infobip->setMethod(Infobip_sms_api::OUTPUT_XML); // With xml method
$infobip->setMethod(Infobip_sms_api::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Infobip_sms_api::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();

$message->setSender('Boorgeon'); // Sender name
$message->setText('Bonjour'); // Message
$message->setRecipients('23794595605');
//$message->setRecipients('phone1', 'messageID'); // With custom message id

$infobip->addMessages(array(
    $message
));

$results = $infobip->sendSMS();

echo '<pre>';
print_r($results);
echo '</pre>';

// Return

/*      
Array
(
    [0] => stdClass Object
        (
            [status] => 0
            [messageid] => messageID
            [destination] => phone1
        )

)        
 */
