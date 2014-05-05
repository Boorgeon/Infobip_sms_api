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

// Send 1 SMS to many --------------------------------------------------------

$infobip->setMethod(Infobip_sms_api::OUTPUT_XML); // With xml method
$infobip->setMethod(Infobip_sms_api::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Infobip_sms_api::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();

$message->setSender('Boorgeon'); // Sender name
$message->setText('Hello World'); // Message
$message->setRecipients('phone1');
$message->setRecipients('phone2', 'messageID1'); // With custom message id
$message->setRecipients('phone3', 'messageID2'); // With custom message id
$message->setRecipients('phone4', 'messageID4'); // With custom message id

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
    [0] => stdClass Object
        (
            [status] => 0
            [messageid] => messageID2
            [destination] => phone2
        )
    [0] => stdClass Object
        (
            [status] => 0
            [messageid] => messageID3
            [destination] => phone3
        )
    [0] => stdClass Object
        (
            [status] => 0
            [messageid] => messageID4
            [destination] => phone4
        )

)        
 */
