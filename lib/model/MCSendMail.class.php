<?php

class MCSendMail {
    private $mailchimp_api_key = null;
    private $mandrill_api_key = null;
    private $message = array();
    private static $instance = null;
    private function __construct() {
        $this->mailchimp_api_key = sfConfig::get('app_mailchimp_api_key');
        $this->mandrill_api_key = sfConfig::get('app_mandrill_api_key');
    }

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new MCSendMail();
        }
        return self::$instance;
    }

    public function sendMail($async = false) {
        sfConfig::set('sf_escaping_strategy', false);
        $data = array();
        $data['key'] = $this->mandrill_api_key;
        $this->message['headers'] = array('X-MC-PreserveRecipients' => false);
        $data['message'] = $this->message;
        $data['async'] = $async;
        $json_data = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            print curl_error($ch);
        } else {
            curl_close($ch);
        }
        return $result;

    }

    public function setMessageText($text){
        $this->message['text'] = $text;
    }
    public function getMessageText(){
        return $this->message['text'];
    }

    public function setMessageHTML($html){
        $this->message['html'] = $html;
    }
    public function getMessageHTML(){
        return $this->message['html'];
    }

    public function setMessageSubject($subject){
        $this->message['subject'] = $subject;
    }
    public function getMessageSubject(){
        return $this->message['subject'];
    }

    public function setMessageFromEmail($email){
        $this->message['from_email'] = $email;
    }
    public function getMessageFromEmail(){
        return $this->message['from_email'];
    }

    public function setMessageFromName($name){
        $this->message['from_name'] = $name;
    }
    public function getMessageFromName(){
        return $this->message['from_name'];
    }

    public function setMessageAddTo(array $to){
        $this->message['to'][] = $to;
    }
    public function getMessageToList(){
        return $this->message['to'];
    }
    public function addAttachment($type, $name, $file){
        if(file_exists($file)){
            $attachment = array();
            $attachment['type'] = $type;
            $attachment['name'] = $name;
            $content = base64_encode(file_get_contents($file));
            $attachment['content'] = $content;
            $this->message['attachments'][] = $attachment;
        }

    }

    public function setBCC($emails){
        $this->message['bcc_address'] = $emails;
    }
    public function getBCC(){
        return $this->message['bcc_address'];
    }


}
