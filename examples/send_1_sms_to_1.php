<?php

// Add zend library
set_include_path(implode(PATH_SEPARATOR, array(
    realpath('/path/to/zend/library'),
    get_include_path()
)));

// Begin script

require_once 'Infobip_sms_api.php';

// Send 1 SMS to 1 --------------------------------------------------------

$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_XML); // With xml method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();

$message->setSender('Boorgeon'); // Sender name
$message->setText('Hello World'); // Message
$message->setRecipients('phone1');
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