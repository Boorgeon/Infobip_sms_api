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
 
 
 
 
 
// Send 1 SMS to many --------------------------------------------------------

$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_XML); // With xml method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_PLAIN); // OR With plain method

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
 
 
 
 
 
 // Send flash SMS --------------------------------------------------------

$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_XML); // With xml method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();

$message->setSender('Boorgeon'); // Sender name
$message->setText('Hello World'); // Message
$message->setFlash(Infobip_sms_message::FLASH);
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
 
 
 
 
 
 // Send long SMS --------------------------------------------------------

$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_XML); // With xml method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();

$message->setSender('Boorgeon'); // Sender name
$message->setText('Hello World'); // Message
$message->setType(Infobip_sms_message::LONG_SMS);
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
 
 
 
 
 // Send scheduled SMS --------------------------------------------------------

$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_XML); // With xml method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();

$message->setSender('Boorgeon'); // Sender name
$message->setText('Hello World'); // Message
$message->setSendDateTime('4d2h2m0s');
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
 
 
 
 
 // Send SMS with differrent messages --------------------------------------------------------

$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_XML); // With xml method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_PLAIN); // OR With plain method

$message = new Infobip_sms_message();
$message->setSender('Sender 1'); // Sender name
$message->setText('Message 1'); // Message
$message->setType(Infobip_sms_message::LONG_SMS);
$message->setRecipients('phone1');


$message2 = new Infobip_sms_message();
$message2->setSender('Sender 2');
$message2->setDatacoding(Infobip_sms_message::UNICODE);
$message2->setSendDateTime('0d0h2m0s');
$message2->setText('Message 1 àéîûôè');
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
 
 
 
 
 // Send unicode SMS --------------------------------------------------------

$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_XML); // With xml method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_JSON); // OR With json method
$infobip->setMethod(Boorgeon_Service_Sms_Infobip::OUTPUT_PLAIN); // OR With plain method

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
