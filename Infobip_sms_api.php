<?php

/**
 *
 * Copyright (c) 2013, Serge NTONG
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *   - Redistributions of source code must retain the above copyright notice,
 *     this list of conditions and the following disclaimer.
 *   - Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
  /**
 * @author      Boorgeon <boorgeon@gmail.com>
 * @author      Serge NTONG <sergentong@gmail.com>
 * @copyright   Copyright (c) 2013, Boorgeon.
 * @license     http://opensource.org/licenses/gpl-license.php GNU Public License
 * @category	Libraries
 * @version   1.0
 */
/**
 * Zend_Http_Client
 */
require_once 'Zend/Http/Client.php';

/**
 * Infobip_sms_message
 */
require_once 'Infobip_sms_message.php';

class Infobip_sms_api {
    /**
     * HTTP method responses.
     */

    const ALL_RECIPIENTS_PROCESSED = 0;
    const SEND_ERROR = -1;
    const NOT_ENOUGH_CREDITS = -2;
    const NETWORK_NOTCOVERED = -3;
    const SOCKET_EXCEPTION = -4;
    const INVALID_USER_OR_PASS = -5;
    const MISSING_DESTINATION_ADDRESS = -6;
    const MISSING_SMS_TEXT = -7;
    const MISSING_SENDER_NAME = -8;
    const DESTINATION_ADDRESS_INVALID_FORMAT = -9;
    const MISSING_USERNAME = -10;
    const MISSING_PASSWORD = -11;
    const INVALID_DESTINATION_ADDRESS_2 = -12;
    const INVALID_DESTINATION_ADDRESS = -13;
    const SYNTAX_ERROR = -22;
    const ERROR_PROCESSING = -23;
    const COMMUNICATION_ERROR = -26;
    const INVALID_SENDDATETIME = -27;
    const INVALID_DELIVERY_REPORT_PUSH_URL = -28;
    const INVALID_CLIENT_APPID = -30;
    const DUPLICATE_MESSAGEID = -33;
    const SENDER_NOT_ALLOWED = -34;
    const GENERAL_ERROR = -99;

    /**
     * HTTP method responses.
     */
    const OUTPUT_XML = 'xml';
    const OUTPUT_JSON = 'json';
    const OUTPUT_PLAIN = 'plain';

    /**
     * HTTP content type.
     */
    const APPLICATION_XML = 'application/xml';
    const APPLICATION_JSON = 'application/json';

    /**
     * Others constants.
     */
    const USERNAME = 'username';
    const USER = 'user';
    const PASSWORD = 'password';
    const PASS = 'pass';
    const SENDER = 'sender';
    const TEXT = 'text';
    const SMSTEXT = 'SMSText';
    const FLASH = 'flash';
    const IS_FLASH = 'IsFlash';
    const TYPE = 'type';
    const WAP_URL = 'wapurl';
    const BOOKMARK = 'bookmark';
    const BINARY = 'binary';
    const DATACODING = 'datacoding';
    const ESMCLASS = 'esmclass';
    const SRCTON = 'srcton';
    const SRCNPI = 'srcnpi';
    const DESTTON = 'destton';
    const DESTNPI = 'destnpi';
    const VALIDITY_PERIOD = 'ValidityPeriod';
    const SEND_DATETIME = 'sendDateTime';
    const ENCODING = 'encoding';
    const APP_ID = 'appid';
    const PUSH_URL = 'pushurl';
    const NO_PUSH = 'nopush';
    const SMS = 'SMS';
    const AUTHENTIFICATION = 'authentication';
    const MESSAGES = 'messages';
    const MESSAGE = 'message';
    const RECIPIENTS = 'recipients';
    const GSM = 'gsm';
    const STATUS = 'status';
    const STATUS_OK = 'OK';
    const STATUS_FAILED = 'FAILED';
    const DESTINATION = 'destination';
    const DESTINATIONS = 'destinations';
    const MESSAGEID = 'messageId';
    const MESSAGE_ID = 'messageid';
    const CMD = 'cmd';
    const LIMIT = 'limit';
    const RECEIVED_DATETIME = 'ReceivedDateTime';
    const OUTPUT = 'output';
    const HOST = 'Host';
    const HOST_INFOBIP = 'api.infobip.com';

    /**
     * Commands.
     */
    const COMMAND_CREDITS = 'CREDITS';

    /**
     * Separators.
     */
    const GSM_SEPARATOR = ',';
    const MESSAGE_ID_SEPARATOR = ',';
    const DESTINATIONS_SEPARATOR = ';';


    /**
     * Status value.
     */
    const DELIVRD = 'DELIVRD';
    const UNDELIV = 'UNDELIV';
    const UNKNOWN = 'UNKNOWN';
    const REJECTD = 'REJECTD';
    const NOT_SENT = 'NOT_SENT';
    const SENT = 'SENT';
    const NOT_DELIVERED = 'NOT_DELIVERED';
    const DELIVERED = 'DELIVERED';
    const NOT_ALLOWED = 'NOT_ALLOWED';
    const INVALID_DESTINATION_ADDRESS_23 = 'INVALID_DESTINATION_ADDRESS';
    const INVALID_SOURCE_ADDRESS = 'INVALID_SOURCE_ADDRESS';
    const ROUTE_NOT_AVAILLABLE = 'ROUTE_NOT_AVAILLABLE';
    const NOT_ENOUGH_CREDITS_2 = 'NOT_ENOUGH_CREDITS';
    const REJECTED = 'REJECTED';
    const INVALID_MESSAGE_FORMAT = 'INVALID_MESSAGE_FORMAT';

    /**
     * Infobip send sms url.
     *
     * @var string
     */
    protected $_sendsmsurl = 'http://api.infobip.com/api/v3/sendsms/';

    /**
     * Infobip delivery report url.
     *
     * @var string
     */
    protected $_delivery_report_pull_url = 'http://api.infobip.com/api/v3/dr/pull';

    /**
     * Infobip command url.
     *
     * @var string
     */
    protected $_command_url = 'http://api.infobip.com/api/command';

    /**
     * Infobip asynchronous number context url.
     *
     * @var string
     */
    protected $_async_number_context_url = 'http://api.infobip.com/api/hlr';

    /**
     * Infobip synchronous number context url.
     *
     * @var string
     */
    protected $_sync_number_context_url = 'http://api.infobip.com/api/hlr/sync';

    /**
     * Infobip incomming messages url.
     *
     * @var string
     */
    protected $_incomming_messages_url = 'http://api.infobip.com/api/v3/command/inbox';

    /**
     * Infobip Client username.
     *
     * @var string
     */
    protected $_username;

    /**
     * Infobip Client password.
     *
     * @var string
     */
    protected $_password;

    /**
     * Destinations.
     *
     * @var array
     */
    protected $_destinations = array();

    /**
     * HTTP request method.
     *
     * @var string
     */
    protected $_method = self::OUTPUT_XML;

    /**
     * Maximun number of messages.
     *
     * @var int
     */
    protected $_limit = 0;

    /**
     * Date time of message reception.
     *
     * @var string
     */
    protected $_receivedDateTime;

    /**
     * Errors.
     * @var string
     */
    protected $_error;

    /**
     * Array of messages
     *
     * @var array Infobip_sms_message
     */
    protected $_messages = array();

    /**
     * Configuration array
     *
     * @var array
     */
    protected $_configs = array();

    /**
     * Constructor method.
     * Optionally configuration array.
     *
     * @param array $config Configuration key-value pairs.
     */
    public function __construct(array $config = array()) {
        if (array_key_exists(self::USERNAME, $config)) {
            $this->setUsername($config[self::USERNAME]);
        }
        if (array_key_exists(self::PASSWORD, $config)) {
            $this->setPassword($config[self::PASSWORD]);
        }
    }

    /**
     * Get Client info balance.
     *
     * @return object
     */
    public function getBalance() {
        $command = $this->getCommand(self::COMMAND_CREDITS, self::OUTPUT_JSON);
        $json = json_decode($command);

        return $json;
    }

    /**
     * Get Infobip SMS url.
     *
     * @return string
     */
    public function getSendSmsUrl() {
        return $this->_sendsmsurl;
    }

    /**
     * Set Infobip SMS url.
     *
     * @param string $sendsmsurl
     * @return Infobip_sms_api
     */
    public function setSendSmsUrl($sendsmsurl) {
        $this->_sendsmsurl = rtrim($sendsmsurl, '/') . '/';
        return $this;
    }

    /**
     * Get Infobip Delivery report url.
     *
     * @return string
     */
    public function getDeliveryReportPullUrl() {
        return $this->_delivery_report_pull_url;
    }

    /**
     * Set Infobip Delivery report url.
     *
     * @param string $delivery_report_pull_url
     * @return Infobip_sms_api
     */
    public function setDeliveryReportPullUrl($delivery_report_pull_url) {
        $this->_delivery_report_pull_url = $delivery_report_pull_url;
        return $this;
    }

    /**
     * Get Infobip command url.
     *
     * @return string
     */
    public function getCommandUrl() {
        return $this->_command_url;
    }

    /**
     * Set Infobip command url.
     *
     * @param string $command_url
     * @return Infobip_sms_api
     */
    public function setCommandUrl($command_url) {
        $this->_command_url = $command_url;
        return $this;
    }

    /**
     * Get Infobip asynchronous number context url.
     *
     * @return string
     */
    public function getAsynchronousNumberContextUrl() {
        return $this->_async_number_context_url;
    }

    /**
     * Set Infobip asynchronous number context url.
     *
     * @param string $async_number_context_url
     * @return Infobip_sms_api
     */
    public function setAsynchronousNumberContextUrl($async_number_context_url) {
        $this->_async_number_context_url = $async_number_context_url;
        return $this;
    }

    /**
     * Get Infobip synchronous number context url.
     *
     * @return string
     */
    public function getSynchronousNumberContextUrl() {
        return $this->_sync_number_context_url;
    }

    /**
     * Set Infobip synchronous number context url.
     *
     * @param string $sync_number_context_url
     * @return Infobip_sms_api
     */
    public function setSynchronousNumberContextUrl($sync_number_context_url) {
        $this->_sync_number_context_url = $sync_number_context_url;
        return $this;
    }

    /**
     * Get Infobip incomming messages url.
     *
     * @return string
     */
    public function getIncommingMessagesUrl() {
        return $this->_incomming_messages_url;
    }

    /**
     * Set Infobip incomming messages url.
     *
     * @param string $incomming_messages_url
     * @return Infobip_sms_api
     */
    public function setIncommingMessagesUrl($incomming_messages_url) {
        $this->_incomming_messages_url = $incomming_messages_url;
        return $this;
    }

    /**
     * Get Client username for Infobip system Login.
     *
     * @return string
     */
    public function getUsername() {
        return $this->_username;
    }

    /**
     * Set Client username for Infobip system Login.
     *
     * @param string $username Client username
     * @return Infobip_sms_api
     */
    public function setUsername($username) {
        $this->_username = $username;
        return $this;
    }

    /**
     * Get Client password for Infobip system Login.
     *
     * @return string
     */
    public function getPassword() {
        return $this->_password;
    }

    /**
     * Set Client password for Infobip system Login.
     *
     * @param string $password Client password
     * @return Infobip_sms_api
     */
    public function setPassword($password) {
        $this->_password = $password;
        return $this;
    }

    /**
     * Get Destinations.
     *
     * @return array
     */
    public function getDestinations() {
        return $this->_destinations;
    }

    /**
     * Set Destinations for the request.
     *
     * @param string|array $destinations
     * @return Infobip_sms_api
     */
    public function setDestinations($destinations) {
        if (is_array($destinations)) {
            foreach ($destinations as $value) {
                $this->_destinations[] = (string) $value;
            }
        } else {
            $this->_destinations[] = (string) $destinations;
        }
        return $this;
    }

    /**
     * Get infobip http method request.
     *
     * @return string
     */
    public function getMethod() {
        return $this->_method;
    }

    /**
     * Set Infobip http method request.
     *
     * <i>Possible values:</i>
     *
     * <code>
     * <b>xml</b> xml formatted data
     * </code>
     *
     * <code>
     * <b>json</b> json formatted data
     * </code>
     *
     * <code>
     * <b>plain</b> passing parameters as query string variables
     * </code>
     *
     * @param string $method
     * @return Infobip_sms_api
     */
    public function setMethod($method) {
        $this->_method = $method;
        return $this;
    }

    /**
     * Get Maximun number of messages to fetch.
     *
     * @return int
     */
    public function getLimit() {
        return $this->_limit;
    }

    /**
     * Set Maximun number of messages to fetch.
     *
     * Default is 0 which means all.
     *
     * @param int $limit
     * @return Infobip_sms_api
     */
    public function setLimit($limit) {
        $this->_limit = (int) $limit;
        return $this;
    }

    /**
     * Get Date and time of message reception.
     *
     * @return string
     */
    public function getReceivedDateTime() {
        return $this->_receivedDateTime;
    }

    /**
     * Set Date and time of message reception.
     *
     * @param string $receivedDateTime
     * @return Infobip_sms_api
     */
    public function setReceivedDateTime($receivedDateTime) {
        $this->_receivedDateTime = $receivedDateTime;
        return $this;
    }

    /**
     * Get Messages.
     *
     * @return array
     */
    public function getMessages() {
        return $this->_messages;
    }

    /**
     * Add message to send.
     *
     * @param Infobip_sms_message $message
     * @return Infobip_sms_api
     * @throws Exception if invalid message type
     */
    public function addMessage($message) {
        if ($message instanceof Infobip_sms_message) {
            $this->_messages[] = $message;
            return $this;
        }

        throw new Exception('Message type must be Infobip_sms_message.');
    }

    /**
     * Add messages to send.
     *
     * @param array $messages
     * @return Infobip_sms_api
     * @throws Exception if invalid message type
     */
    public function addMessages(array $messages) {
        foreach ($messages as $message) {
            $this->addMessage($message);
        }
        return $this;
    }

    /**
     * Prepare the request JSON.
     *
     * @return string json
     */
    protected function _prepareJson() {
        $messages = array();

        foreach ($this->getMessages() as $message) {
            if ($message instanceof Infobip_sms_message) {
                $stdClass = new stdClass();

                $stdClass->{self::SENDER} = $message->getSender();
                $stdClass->{self::TEXT} = $message->getText();

                $stdClass->{self::FLASH} = $message->getFlash();

                if (1 == $message->getFlash()) {
                    $message->setDatacoding(Infobip_sms_message::FLASH);
                }

                $stdClass->{self::TYPE} = $message->getType();
                $stdClass->{self::WAP_URL} = $message->getWapUrl();
                $stdClass->{self::BINARY} = $message->getBinary();
                $stdClass->{self::DATACODING} = $message->getDatacoding();
                $stdClass->{self::ESMCLASS} = $message->getEsmClass();
                $stdClass->{self::SRCTON} = $message->getSrcTon();
                $stdClass->{self::SRCNPI} = $message->getSrcNpi();
                $stdClass->{self::DESTTON} = $message->getDestTon();
                $stdClass->{self::DESTNPI} = $message->getDestNpi();
                $stdClass->{self::VALIDITY_PERIOD} = $message->getValidityPeriod();
                $stdClass->{self::SEND_DATETIME} = $message->getSendDateTime();
                $stdClass->{self::APP_ID} = $message->getAppId();
                $stdClass->{self::PUSH_URL} = $message->getPushUrl();
                $stdClass->{self::NO_PUSH} = $message->getNoPush();
                $stdClass->{self::RECIPIENTS} = $message->getRecipients();

                $messages[] = $stdClass;
            }
        }

        $json = new stdClass();

        $json->{self::AUTHENTIFICATION} = new stdClass();
        $json->{self::AUTHENTIFICATION}->{self::USERNAME} = $this->getUsername();
        $json->{self::AUTHENTIFICATION}->{self::PASSWORD} = $this->getPassword();
        $json->{self::MESSAGES} = $messages;

        return json_encode($json);
    }

    /**
     * Prepare the request XML.
     *
     * @return string xml
     */
    protected function _prepareXml() {
        $xml = 'XML=';
        $xml .= '<' . self::SMS . '>';
        $xml .= '<' . self::AUTHENTIFICATION . '>';
        $xml .= '<' . self::USERNAME . '>' . $this->getUsername() . '</' . self::USERNAME . '>';
        $xml .= '<' . self::PASSWORD . '>' . $this->getPassword() . '</' . self::PASSWORD . '>';
        $xml .= '</' . self::AUTHENTIFICATION . '>';

        foreach ($this->getMessages() as $message) {
            if ($message instanceof Infobip_sms_message) {
                $xml .= '<' . self::MESSAGE . '>';

                $xml .= '<' . self::SENDER . '>' . $message->getSender() . '</' . self::SENDER . '>';
                $xml .= '<' . self::TEXT . '>' . $message->getText() . '</' . self::TEXT . '>';
                $xml .= '<' . self::FLASH . '>' . $message->getFlash() . '</' . self::FLASH . '>';

                if (1 == $message->getFlash()) {
                    $message->setDatacoding(Infobip_sms_message::FLASH);
                }

                $xml .= '<' . self::TYPE . '>' . $message->getType() . '</' . self::TYPE . '>';
                $xml .= '<' . self::WAP_URL . '>' . $message->getWapUrl() . '</' . self::WAP_URL . '>';
                $xml .= '<' . self::BINARY . '>' . $message->getBinary() . '</' . self::BINARY . '>';
                $xml .= '<' . self::DATACODING . '>' . $message->getDatacoding() . '</' . self::DATACODING . '>';
                $xml .= '<' . self::ESMCLASS . '>' . $message->getEsmClass() . '</' . self::ESMCLASS . '>';
                $xml .= '<' . self::SRCTON . '>' . $message->getSrcTon() . '</' . self::SRCTON . '>';
                $xml .= '<' . self::SRCNPI . '>' . $message->getSrcNpi() . '</' . self::SRCNPI . '>';
                $xml .= '<' . self::DESTTON . '>' . $message->getDestTon() . '</' . self::DESTTON . '>';
                $xml .= '<' . self::DESTNPI . '>' . $message->getDestNpi() . '</' . self::DESTNPI . '>';
                $xml .= '<' . self::VALIDITY_PERIOD . '>' . $message->getValidityPeriod() . '</' . self::VALIDITY_PERIOD . '>';
                $xml .= '<' . self::SEND_DATETIME . '>' . $message->getSendDateTime() . '</' . self::SEND_DATETIME . '>';
                $xml .= '<' . self::APP_ID . '>' . $message->getAppId() . '</' . self::APP_ID . '>';
                $xml .= '<' . self::PUSH_URL . '>' . $message->getPushUrl() . '</' . self::PUSH_URL . '>';
                $xml .= '<' . self::NO_PUSH . '>' . $message->getNoPush() . '</' . self::NO_PUSH . '>';

                $xml .= '<' . self::RECIPIENTS . '>';
                foreach ($message->getRecipients() as $recipient) {
                    $xml .= '<' . self::GSM . ' ' . self::MESSAGEID . '="' . $recipient->{self::MESSAGEID} . '">' . $recipient->{self::GSM} . '</' . self::GSM . '>';
                }
                $xml .= '</' . self::RECIPIENTS . '>';

                $xml .= '</' . self::MESSAGE . '>';
            }
        }

        $xml .= '</' . self::SMS . '>';

        return $xml;
    }

    /**
     * Prepare the request PLAIN.
     *
     * @return array
     */
    protected function _preparePlain() {
        $plain = array();

        $plain[self::USER] = $this->getUsername();
        $plain[self::PASSWORD] = $this->getPassword();

        $message = $this->getMessages()[0];

        $plain[self::SENDER] = $message->getSender();
        $plain[self::SMSTEXT] = $message->getText();

        $recipients = array();
        $messageids = array();
        foreach ($message->getRecipients() as $recipient) {
            $recipients[] = $recipient->{self::GSM};
            $messageids[] = $recipient->{self::MESSAGEID};
        }
        $plain[self::GSM] = implode(self::GSM_SEPARATOR, $recipients);
        $plain[self::MESSAGE_ID] = implode(self::MESSAGE_ID_SEPARATOR, $messageids);

        $plain[self::IS_FLASH] = $message->getFlash();

        if (1 == $message->getFlash()) {
            $message->setDatacoding(Infobip_sms_message::FLASH);
        }

        $plain[self::TYPE] = $message->getType();
        $plain[self::BOOKMARK] = $message->getWapUrl();
        $plain[self::DATACODING] = $message->getDatacoding();
        $plain[self::ESMCLASS] = $message->getEsmClass();
        $plain[self::BINARY] = $message->getBinary();
        $plain[self::SRCTON] = $message->getSrcTon();
        $plain[self::SRCNPI] = $message->getSrcNpi();
        $plain[self::DESTTON] = $message->getDestTon();
        $plain[self::DESTNPI] = $message->getDestNpi();
        $plain[self::VALIDITY_PERIOD] = $message->getValidityPeriod();
        $plain[self::SEND_DATETIME] = $message->getSendDateTime();
//        $plain[self::ENCODING] = '';
        $plain[self::APP_ID] = $message->getAppId();
        $plain[self::PUSH_URL] = $message->getPushUrl();
        $plain[self::NO_PUSH] = $message->getNoPush();

        return $plain;
    }

    /**
     * Get the raw data prepared.
     *
     * @return string|array
     */
    protected function _getRawData() {
        $method = $this->getMethod();

        if ($method == self::OUTPUT_JSON) {
            return $this->_prepareJson();
        } elseif ($method == self::OUTPUT_XML) {
            return $this->_prepareXml();
        } else {
            return $this->_preparePlain();
        }
    }

    public function sendSMS() {
        $method = $this->getMethod();
        $rawdata = $this->_getRawData();

        if ($method == self::OUTPUT_JSON) {
            $minetype = self::APPLICATION_JSON;
        } elseif ($method == self::OUTPUT_XML) {
            $minetype = self::APPLICATION_XML;
        } else {
            $minetype = 'text/html';
        }

        $client = new Zend_Http_Client();
        $client->setMethod(Zend_Http_Client::POST);
        $client->setUri($this->getSendSmsUrl() . $this->getMethod());
        $client->setHeaders(self::HOST, self::HOST_INFOBIP);
        $client->setHeaders(Zend_Http_Client::CONTENT_TYPE, $minetype);
        $client->setHeaders('Accept', '*/*');

        if ($method == self::OUTPUT_PLAIN) {
            $client->setParameterGet($rawdata);
        } else {
            $client->setRawData($rawdata);
        }

        $body = $client->request()->getBody();

        return $this->_parseBody($body);
    }

    /**
     * Parse the request response.
     *
     * @param string $body
     * @return array of object
     */
    protected function _parseBody($body) {
        $method = $this->getMethod();
        $parsedBody = array();

        if ($method == self::OUTPUT_JSON) {
            $json = json_decode($body);
            $parsedBody = $json->results;
        } else {
            $this->_error = null;
            set_error_handler(array($this, '_errorHandler')); // Warnings and errors are suppressed
            $xml = simplexml_load_string($body);
            restore_error_handler();

            // Check if there was a error while loading file
            if ($this->_error === null) {
                foreach ($xml->children() as $result) {
                    $stdClass = new stdClass();

                    foreach ($result->children() as $key => $value) {
                        $stdClass->{$key} = (string) $value[0];
                    }

                    $parsedBody[] = $stdClass;
                }
            }
        }

        return $parsedBody;
    }

    /**
     * Get Infobip http get commandes.
     *
     * @param string $command
     * @param string $output Default json
     * @return mixed
     */
    public function getCommand($command, $output = self::OUTPUT_JSON) {
        $client = new Zend_Http_Client();

        $client->setMethod(Zend_Http_Client::GET);
        $client->setUri($this->getCommandUrl());
        $client->setParameterGet(array(
            self::USERNAME => $this->getUsername(),
            self::PASSWORD => $this->getPassword(),
            self::CMD => (string) $command,
            self::OUTPUT => (string) $output
        ));

        return $client->request()->getBody();
    }

    /**
     * Get Delivery Report.
     *
     * @param array $messageid
     * @return array
     */
    public function getDeliveryReports(array $messageid = array()) {
        $client = new Zend_Http_Client();

        $client->setMethod(Zend_Http_Client::GET);
        $client->setUri($this->getDeliveryReportPullUrl());
        $client->setParameterGet(array(
            self::USER => $this->getUsername(),
            self::PASSWORD => $this->getPassword()
        ));

        if ($messageid) {
            $client->setParameterGet(self::MESSAGE_ID, implode(self::MESSAGE_ID_SEPARATOR, $messageid));
        }

        $body = $client->request()->getBody();
        print_r($body);
        $this->_error = null;
        set_error_handler(array($this, '_errorHandler')); // Warnings and errors are suppressed
        $xml = simplexml_load_string($body);
        restore_error_handler();
        $reports = array();

        // Check if there was a error while loading file
        if ($this->_error === null) {
            foreach ($xml->DeliveryReport->message as $message) {
                $stdClass = new stdClass();

                foreach ($message->attributes() as $key => $value) {
                    $stdClass->{$key} = (string) $value[0];
                }

                $reports[] = $stdClass;
            }
        }

        return $reports;
    }

    /**
     * Send asynchronous number context.
     *
     * @return array of object
     */
    public function sendAsynchronousNumberContext() {
        $client = new Zend_Http_Client();

        $client->setMethod(Zend_Http_Client::GET);
        $client->setUri($this->getAsynchronousNumberContextUrl());
        $client->setParameterGet(array(
            self::USER => $this->getUsername(),
            self::PASS => $this->getPassword(),
            self::DESTINATIONS => implode(self::DESTINATIONS_SEPARATOR, $this->getDestinations())
        ));

        $body = $client->request()->getBody();

        $response = explode("\n", $body);
        $results = array();

        if (self::STATUS_OK == $response[0]) {
            unset($response[0]);

            foreach ($response as $row) {
                if ($row) {
                    list($destination, $status, $messageid) = explode(';', $row);
                    $stdClass = new stdClass();

                    $stdClass->{self::DESTINATION} = $destination;
                    $stdClass->{self::STATUS} = $status;
                    $stdClass->{self::MESSAGE_ID} = $messageid;

                    $results[] = $stdClass;
                }
            }
        }

        return $results;
    }

    /**
     * Send synchronous number context.
     *
     * @param string $destination
     * @return array of object
     */
    public function sendSynchronousNumberContext($destination) {
        $client = new Zend_Http_Client();

        $client->setMethod(Zend_Http_Client::GET);
        $client->setUri($this->getSynchronousNumberContextUrl());
        $client->setParameterGet(array(
            self::USER => $this->getUsername(),
            self::PASS => $this->getPassword(),
            self::DESTINATION => $destination,
            self::OUTPUT => self::OUTPUT_JSON
        ));

        $body = $client->request()->getBody();
        $json = json_decode($body);

        return $json;
    }

    /**
     * Get Incomming Messages.
     *
     * @return array of object
     */
    public function getIncommingMessages() {
        $client = new Zend_Http_Client();

        $client->setMethod(Zend_Http_Client::GET);
        $client->setUri($this->getIncommingMessagesUrl());
        $client->setParameterGet(array(
            self::USER => $this->getUsername(),
            self::PASSWORD => $this->getPassword(),
            self::LIMIT => $this->getLimit(),
            self::RECEIVED_DATETIME => $this->getReceivedDateTime(),
            self::OUTPUT => self::OUTPUT_JSON
        ));

        $body = $client->request()->getBody();
        $json = json_decode($body);

        return $json;
    }

    /**
     * Error observer
     *
     * @return void
     */
    public function _errorHandler($errno, $errstr, $errfile, $errline) {
        ($errno);
        ($errstr);
        ($errfile);
        ($errline);

        if ($this->_error === null) {
            $this->_error = $errstr;
        } else {
            $this->_error .= (PHP_EOL . $errstr);
        }
    }

}
