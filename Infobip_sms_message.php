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
class Infobip_sms_message {
    /**
     * Message type.
     */

    const BOOKMARK = 'bookmark';
    const LONG_SMS = 'longSMS';
    const N_SMS = 'nSMS';

    /**
     * Datacoding value.
     */
    const GSM7 = 1;
    const ISO8859_1 = 3;
    const BINARY = 4;
    const UNICODE = 8;
    const UNICODE_FLASH = 24;
    const FLASH = 240;
    const WAP_PUSH = 245;

    /**
     * Dynamic message sender ID.
     *
     * @var string
     */
    protected $_sender = 'Boorgeon';

    /**
     * Message body.
     *
     * @var string
     */
    protected $_text;

    /**
     * Flash | 0 send a normal SMS, 1 send a flash SMS.
     *
     * @var bool
     */
    protected $_flash = 0;

    /**
     * Message type.
     *
     * To send WAP bookmarks: "bookmark"
     * To send concatenated SMS: "longSMS"
     * To send notification SMS: "nSMS"
     *
     * @var string
     */
    protected $_type;

    /**
     * WAP Push content.
     *
     * @var string
     */
    protected $_wapurl;

    /**
     * Binary content, using hexadecimal format. Cannot be used with "text" parameter.
     *
     * @var string
     */
    protected $_binary;

    /**
     * Data coding Default 0.
     *
     * @var int
     */
    protected $_datacoding = 0;

    /**
     * Esm_class parameter.
     *
     * @var int
     */
    protected $_esmclass = 0;

    /**
     * Source - ton parameter.
     *
     * @var int
     */
    protected $_srcton;

    /**
     * Source - npi parameter
     *
     * @var int
     */
    protected $_srcnpi;

    /**
     * Destination  - ton parameter.
     *
     * @var int
     */
    protected $_destton;

    /**
     * Destination  - npi parameter.
     *
     * @var int
     */
    protected $_destnpi;

    /**
     * Validity of a message.
     *
     * @var string
     */
    protected $_validityPeriod;

    /**
     * Used for scheduled SMS.
     *
     * @var string
     */
    protected $_sendDateTime;

    /**
     * Delievery reports for application.
     *
     * @var string
     */
    protected $_appid;

    /**
     * Push url.
     *
     * @var string
     */
    protected $_pushurl;

    /**
     * No push.
     *
     * @var string
     */
    protected $_nopush;

    /**
     * Recipients.
     *
     * @var array
     */
    protected $_recipients = array();

    /**
     * Constructor method.
     * Optionally configuration array.
     *
     */
    public function __construct() {
        
    }

    /**
     * Get Dynamic message sender ID.
     *
     * @return string
     */
    public function getSender() {
        return $this->_sender;
    }

    /**
     * Set Dynamic message sender ID.
     *
     * <i>Possible values:</i>
     *
     * <code>
     * <b>Alphanumeric</b> max. Length 11 characters
     * </code>
     *
     * <code>
     * <b>Numeric</b> max. Length 14 characters
     * </code>
     *
     * @param string $sender Sender
     * @return Infobip_sms_message
     */
    public function setSender($sender) {
        $this->_sender = $sender;
        return $this;
    }

    /**
     * Get Message body
     *
     * @return string
     */
    public function getText() {
        return $this->_text;
    }

    /**
     * Set Message body at the moment 160 characters.
     *
     * @param $text Message
     * @return Infobip_sms_message
     */
    public function setText($text) {
        $this->_text = $text;
        return $this;
    }

    /**
     * Get Message style
     *
     * @return int
     */
    public function getFlash() {
        return $this->_flash;
    }

    /**
     * Set Message style when delievered to mobile phone.
     *
     * <i>Possible values:</i>
     *
     * <code>
     * <b>0</b> sends a normal SMS
     * </code>
     *
     * <code>
     * <b>1</b> sends Flash SMS
     * </code>
     *
     * @param boolean $flash Flash
     * @return Infobip_sms_message
     */
    public function setFlash($flash) {
        $this->_flash = (int) $flash;
        return $this;
    }

    /**
     * Get Message type.
     *
     * @return string
     */
    public function getType() {
        return $this->_type;
    }

    /**
     * Set Message type, optional parameter.
     *
     * <i>Possible values:</i>
     *
     * <code>
     * <b>bookmark</b> To send WAP bookmarks
     * </code>
     *
     * <code>
     * <b>longSMS</b> To send concatenated SMS
     * </code>
     *
     * <code>
     * <b>nSMS</b> To send notification SMS
     * </code>
     *
     * @param string $type Type
     * @return Infobip_sms_message
     */
    public function setType($type) {
        $this->_type = $type;
        return $this;
    }

    /**
     * Get WAP Push content.
     *
     * @return string
     */
    public function getWapUrl() {
        return $this->_wapurl;
    }

    /**
     * Set WAP Push content.
     *
     * <code>
     * <b>Example:</b> www.infobiiip.com/something.jpq
     * </code>
     *
     * @param string $wapurl WAP Push url
     * @return Infobip_sms_message
     */
    public function setWapUrl($wapurl) {
        $this->_wapurl = $wapurl;
        return $this;
    }

    /**
     * Get Binary content.
     *
     * @return string
     */
    public function getBinary() {
        return $this->_binary;
    }

    /**
     * Set Binary content, using hexadecimal format.
     *
     * Cannot be used together with text parameter
     *
     * <code>
     * <b>Example:</b> 410A0D4243
     * </code>
     *
     * @param string $binary Binary
     * @return Infobip_sms_message
     */
    public function setBinary($binary) {
        $this->_binary = $binary;
        return $this;
    }

    /**
     * Get Data coding.
     *
     * @return int
     */
    public function getDatacoding() {
        return $this->_datacoding;
    }

    /**
     * Set Data coding parameter.
     *
     * Default value: 0
     *
     * <code>
     * <b>Example:</b> 8 (Unicode data)
     * </code>
     *
     * @param int $datacoding Data coding
     * @return Infobip_sms_message
     */
    public function setDatacoding($datacoding) {
        $this->_datacoding = (int) $datacoding;
        return $this;
    }

    /**
     * Get Data coding.
     *
     * @return int
     */
    public function getEsmClass() {
        return $this->_esmclass;
    }

    /**
     * Set Esm_class parameter
     *
     * Default value: 0
     *
     * @param int $esmclass Esm_class
     * @return Infobip_sms_message
     */
    public function setEsmClass($esmclass) {
        $this->_esmclass = (int) $esmclass;
        return $this;
    }

    /**
     * Get Source - ton.
     *
     * @return int
     */
    public function getSrcTon() {
        return $this->_srcton;
    }

    /**
     * Set Source - ton parameter
     *
     * @param string $srcton Source - ton
     * @return Infobip_sms_message
     */
    public function setSrcTon($srcton) {
        $this->_srcton = (int) $srcton;
        return $this;
    }

    /**
     * Get Source - npi.
     *
     * @return int
     */
    public function getSrcNpi() {
        return $this->_srcnpi;
    }

    /**
     * Set Source - npi parameters
     *
     * @param string $srcnpi Source - npi
     * @return Infobip_sms_message
     */
    public function setSrcNpi($srcnpi) {
        $this->_srcnpi = (int) $srcnpi;
        return $this;
    }

    /**
     * Get Destination - ton.
     *
     * @return int
     */
    public function getDestTon() {
        return $this->_destton;
    }

    /**
     * Set Destination - ton parameter
     *
     * @param string $destton Destination - ton
     * @return Infobip_sms_message
     */
    public function setDestTon($destton) {
        $this->_destton = (int) $destton;
        return $this;
    }

    /**
     * Get Destination - npi.
     *
     * @return int
     */
    public function getDestNpi() {
        return $this->_destnpi;
    }

    /**
     * Set Destination - npi parameter
     *
     * @param string $destnpi Destination - npi
     * @return Infobip_sms_message
     */
    public function setDestNpi($destnpi) {
        $this->_destnpi = (int) $destnpi;
        return $this;
    }

    /**
     * Get Validity of a message.
     *
     * @return string
     */
    public function getValidityPeriod() {
        return $this->_validityPeriod;
    }

    /**
     * Set Validity of a message.
     *
     * Validity period longer then 48h is not supported (it will be automatically set to 48h in that case).
     *
     * <code>
     * <b>Validity Period pattern:</b> HH:mm
     * </code>
     *
     * @param string $validityperiod Validity
     * @return Infobip_sms_message
     */
    public function setValidityPeriod($validityperiod) {
        $this->_validityPeriod = $validityperiod;
        return $this;
    }

    /**
     * Get scheduled SMS.
     *
     * @return string
     */
    public function getSendDateTime() {
        return $this->_sendDateTime;
    }

    /**
     * Set Used for scheduled SMS (SMS not sent immediately but at scheduled time).
     *
     * <code>
     * <b>Example:</b> 4d3h2m1s message will be sent 4 days, 3 hours, 2 minutes and 1 second from now.
     * </code>
     *
     * You're allowed to use any combination and leave out unnecessary variables.
     *
     * @param string $senddatetime scheduled SMS
     * @return Infobip_sms_message
     */
    public function setSendDateTime($senddatetime) {
        $this->_sendDateTime = $senddatetime;
        return $this;
    }

    /**
     * Get Delievery reports.
     *
     * @return string
     */
    public function getAppId() {
        return $this->_appid;
    }

    /**
     * Set Delievery reports for application.
     *
     * <i>Possible options:</i>
     *
     * <code>
     * <b>Value is not recieved</b> all DLR-s without appid will be sent when client send putt request with no appid specified.
     * </code>
     *
     * <code>
     * <b>Value is recieved</b> only DLR-s with given appid will be delivered when client pulls reports for that appid.
     * </code>
     *
     * @param string $appid Delievery reports
     * @return Infobip_sms_message
     */
    public function setAppId($appid) {
        $this->_appid = $appid;
        return $this;
    }

    /**
     * Get Push url.
     *
     * @return string
     */
    public function getPushUrl() {
        return $this->_pushurl;
    }

    /**
     * Set Where should delievery reports be pushed.
     *
     * <i>Possible options:</i>
     *
     * <code>
     * <b>Value is not recieved / Value is no push</b> all DLR-s without pushurl will be pushed to default URL set for your account.
     * </code>
     *
     * <code>
     * <b>Value is recieved</b> all DLR is sent to the given IJRL (sent as pushurl value), rather than to the default one set for your account.
     * </code>
     *
     * @param string $pushurl Push url
     * @return Infobip_sms_message
     */
    public function setPushUrl($pushurl) {
        $this->_pushurl = $pushurl;
        return $this;
    }

    /**
     * Get No push url.
     *
     * @return string
     */
    public function getNoPush() {
        return $this->_nopush;
    }

    /**
     * Set Where should delievery reports be pushed.
     *
     * <i>Possible options:</i>
     *
     * <code>
     * <b>Value not recieved / Value is 0</b> all DLR-s with nopush=0 will be pushed, as usual.
     * </code>
     *
     * <code>
     * <b>Value is recieved / Value is 1</b> all DLR-s with nopush=1 wilt not be pushed. and will be available for pull.
     * </code>
     *
     * @param string $nopush No Push url
     * @return Infobip_sms_message
     */
    public function setNoPush($nopush) {
        $this->_nopush = $nopush;
        return $this;
    }

    /**
     * Get recipients.
     *
     * @return array
     */
    public function getRecipients() {
        return $this->_recipients;
    }

    /**
     * Set Message destination address and / or Registered delivery - messageID set by client.
     *
     *
     * <code>
     * <b>Example</b> 41793026727
     * </code>
     *
     * @param string $gsm Message destination address, must be in international (format without leading 0 or +)
     * @param string $messageId|null Message ID
     * @return Infobip_sms_message
     */
    public function setRecipients($gsm, $messageId = null) {
        $recipient = new stdClass();
        $recipient->{Infobip_sms_api::GSM} = $gsm;
        $recipient->{Infobip_sms_api::MESSAGEID} = $messageId;

        $this->_recipients[] = $recipient;

        return $this;
    }

}
