<?php
// Begin script

require_once 'Infobip_sms_api.php';

$infobip = new Infobip_sms_api();
$infobip->setUsername('username');
$infobip->setPassword('password');

// Send unicode SMS --------------------------------------------------------

$infobip->setMethod(Infobip_sms_api::OUTPUT_XML); // With xml method
$infobip->setMethod(Infobip_sms_api::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Infobip_sms_api::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();

$message->setSender('Boorgeon'); // Sender name
$message->setText('Hello World'); // Message
$message->setDatacoding(Infobip_sms_message::UNICODE);
$message->setRecipients('phone1');

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
            [messageid] => infobip_message_id
            [destination] => phone1
        )

)        
 */
