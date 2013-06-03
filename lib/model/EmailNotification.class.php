<?php

class EmailNotification {
    public static function sendInvites($initiator, $guest, $url){
        $text = '';
        $text .= "You have been invited by ";
        if($initiator->getFirstName()){
            $text .= "{$initiator->getFirstName()}({$initiator->getUsername()})";
        } else {
            $text .= $initiator->getUsername();
        }
        $text .= "\n\r";
        $text .= "Please, visit this link to signup in PreFlightRisk: {$url}";

        MCSendMail::getInstance()->setMessageText($text);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_notification_from_email', 'support@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_notification_from_name', 'PreFlightRisk'));
        MCSendMail::getInstance()->setMessageSubject(sfConfig::get('app_email_notification_title', 'Invite to PreFlightRisk'));
        MCSendMail::getInstance()->setMessageAddTo(array('email'=>$guest->getUsername(), 'name' => $guest->getFirstName() ? $guest->getFirstName() : null));
        MCSendMail::getInstance()->sendMail(true);
    }
}