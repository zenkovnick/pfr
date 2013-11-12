<?php

class EmailNotification {
    public static function sendInvites($initiator, $guest, $url, $account){
        $text = '';
        $text .= "You have been invited to {$account->getTitle()} account by ";
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
        return MCSendMail::getInstance()->sendMail(true);
    }

    public static function sendAccountApprove($initiator, $guest, $url, $account){
        $text = '';
        $text .= "You have been invited to {$account->getTitle()} account by ";
        if($initiator->getFirstName()){
            $text .= "{$initiator->getFirstName()}({$initiator->getUsername()})";
        } else {
            $text .= $initiator->getUsername();
        }
        $text .= "\n\r";
        $text .= "Please, visit this link to approve your membership in this account: {$url}";

        MCSendMail::getInstance()->setMessageText($text);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_notification_from_email', 'support@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_notification_from_name', 'PreFlightRisk'));
        MCSendMail::getInstance()->setMessageSubject(sfConfig::get('app_email_notification_title', 'Invite to PreFlightRisk'));
        MCSendMail::getInstance()->setMessageAddTo(array('email'=>$guest->getUsername(), 'name' => $guest->getFirstName() ? $guest->getFirstName() : null));
        return MCSendMail::getInstance()->sendMail(true);
    }

    public static function sendChiefInvite($initiator, $guest, $url, $account){
        $text = '';
        $text .= "You have been invited to {$account->getTitle()} account as chief pilot by ";
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
        return MCSendMail::getInstance()->sendMail(true);
    }

    public static function cancelChiefInvite($guest, $account){
        $text = '';
        $text .= "Sorry, but Your invitation to {$account->getTitle()} account as chief pilot was canceled.";

        MCSendMail::getInstance()->setMessageText($text);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_notification_from_email', 'support@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_notification_from_name', 'PreFlightRisk'));
        MCSendMail::getInstance()->setMessageSubject(sfConfig::get('app_email_notification_cancel_title', 'Cancel invitation to PreFlightRisk'));
        MCSendMail::getInstance()->setMessageAddTo(array('email'=>$guest->getUsername(), 'name' => $guest->getFirstName() ? $guest->getFirstName() : null));
        return MCSendMail::getInstance()->sendMail(true);
    }

    public static function sendChiefAccountApprove($initiator, $guest, $url, $account){
        $text = '';
        $text .= "You have been invited to {$account->getTitle()} account as chief pilot by ";
        if($initiator->getFirstName()){
            $text .= "{$initiator->getFirstName()}({$initiator->getUsername()})";
        } else {
            $text .= $initiator->getUsername();
        }
        $text .= "\n\r";
        $text .= "Please, visit this link to approve your membership in this account: {$url}";

        MCSendMail::getInstance()->setMessageText($text);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_notification_from_email', 'support@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_notification_from_name', 'PreFlightRisk'));
        MCSendMail::getInstance()->setMessageSubject(sfConfig::get('app_email_notification_title', 'Invite to PreFlightRisk'));
        MCSendMail::getInstance()->setMessageAddTo(array('email'=>$guest->getUsername(), 'name' => $guest->getFirstName() ? $guest->getFirstName() : null));
        return MCSendMail::getInstance()->sendMail(true);
    }

    public static function sendAssessment($mail_to, $chief_pilot = null, $html, $subject){

        MCSendMail::getInstance()->setMessageHTML($html);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_assessment_from_email', 'mitigators@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_assessment_from_name', 'Pre Flight Risk'));
        MCSendMail::getInstance()->setMessageSubject($subject);
        if(!is_null($chief_pilot)){
            MCSendMail::getInstance()->setMessageAddTo(array('email'=>$chief_pilot->getUsername(), 'name' => $chief_pilot->getFirstName() ? $chief_pilot->getFirstName() : null));
        }
        MCSendMail::getInstance()->setMessageAddTo(array('email'=>$mail_to->getUsername(), 'name' => $mail_to->getFirstName() ? $mail_to->getFirstName() : null));
        return MCSendMail::getInstance()->sendMail(true);
    }

    public static function sendEmailsAssessment($mail_to, $chief_pilot = null, $html, $subject){

        MCSendMail::getInstance()->setMessageHTML($html);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_assessment_from_email', 'mitigators@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_assessment_from_name', 'Pre Flight Risk'));
        MCSendMail::getInstance()->setMessageSubject($subject);
        MCSendMail::getInstance()->clearMessageTo();
        $emails = array();
        if($mail_to){
            $emails = explode(',', $mail_to);
        }
        if(!is_null($chief_pilot)){
            $emails[] = $chief_pilot;
        }
        foreach($emails as $email){
            if(trim($email)){
                MCSendMail::getInstance()->setMessageAddTo(array('email'=>trim($email), 'name' => null));
                MCSendMail::getInstance()->sendMail(true);
                MCSendMail::getInstance()->clearMessageTo();
            }
        }

        return true;
    }

    public static function sendHighRiskNotify($mail_to, $chief_pilot = null, $html, $subject){

        MCSendMail::getInstance()->setMessageHTML($html);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_assessment_from_email', 'mitigators@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_assessment_from_name', 'Pre Flight Risk'));
        MCSendMail::getInstance()->setMessageSubject($subject);
        MCSendMail::getInstance()->clearMessageTo();
        $emails = array();
        if($mail_to){
            $emails = explode(',', $mail_to);
        }
        if(!is_null($chief_pilot)){
            $emails[] = $chief_pilot;
        }
        foreach($emails as $email){
            if(trim($email)){
                MCSendMail::getInstance()->setMessageAddTo(array('email'=>trim($email), 'name' => null));
                MCSendMail::getInstance()->sendMail(true);
                MCSendMail::getInstance()->clearMessageTo();
            }
        }

        return true;
    }

    public static function sendPasswordRecovery($email, $html, $subject){
        MCSendMail::getInstance()->setMessageHTML($html);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_assessment_from_email', 'mitigators@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_assessment_from_name', 'Pre Flight Risk'));
        MCSendMail::getInstance()->setMessageSubject($subject);
        MCSendMail::getInstance()->clearMessageTo();
        if(trim($email)){
            MCSendMail::getInstance()->setMessageAddTo(array('email'=>trim($email), 'name' => null));
            MCSendMail::getInstance()->sendMail(true);
            MCSendMail::getInstance()->clearMessageTo();
        }

        return true;
    }

    public static function sendInvitesSMTP($initiator, $guest, $url, $account){
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

        $text = '';
        $text .= "You have been invited to {$account->getTitle()} account by ";
        if($initiator->getFirstName()){
            $text .= "{$initiator->getFirstName()}({$initiator->getUsername()})";
        } else {
            $text .= $initiator->getUsername();
        }
        $text .= "\n\r";
        $text .= "Please, visit this link to signup in PreFlightRisk: {$url}";

        /** @var Swift_Mailer $mailer  */
        $mailer = sfContext::getInstance()->getMailer();

        /** @var Swift_Message $email  */
        $email = $mailer->compose(
            sfConfig::get('app_email_notification_from_email', 'support@preflightrisk.com'),
            $guest->getUsername(),
            sfConfig::get('app_email_notification_title', 'Invite to PreFlightRisk'),
            $text
        );
        if ($mailer->send($email))
        {

        }
        else
        {
            sfContext::getInstance()->getLogger()->err("User registered email not sended");
        }
    }

    public static function sendAccountApproveSMTP($initiator, $guest, $url, $account){
        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

        $text = '';
        $text .= "You have been invited to {$account->getTitle()} account by ";
        if($initiator->getFirstName()){
            $text .= "{$initiator->getFirstName()}({$initiator->getUsername()})";
        } else {
            $text .= $initiator->getUsername();
        }
        $text .= "\n\r";
        $text .= "Please, visit this link to approve your membership in this account: {$url}";

        /** @var Swift_Mailer $mailer  */
        $mailer = sfContext::getInstance()->getMailer();

        /** @var Swift_Message $email  */
        $email = $mailer->compose(
            sfConfig::get('app_email_notification_from_email', 'support@preflightrisk.com'),
            $guest->getUsername(),
            sfConfig::get('app_email_notification_title', 'Invite to PreFlightRisk'),
            $text
        );
        if ($mailer->send($email))
        {

        }
        else
        {
            sfContext::getInstance()->getLogger()->err("User registered email not sended");
        }
    }


    public static function sendFromDashboard($emails, $html, $subject){

        MCSendMail::getInstance()->setMessageHTML($html);
        MCSendMail::getInstance()->setMessageFromEmail(sfConfig::get('app_email_assessment_from_email', 'mitigators@preflightrisk.com'));
        MCSendMail::getInstance()->setMessageFromName(sfConfig::get('app_email_assessment_from_name', 'Pre Flight Risk'));
        MCSendMail::getInstance()->setMessageSubject($subject);
        $emails = explode(',', $emails);
        foreach($emails as $email){
            if(trim($email)){
                MCSendMail::getInstance()->setMessageAddTo(array('email'=>trim($email), 'name' => null));
            }
        }
        return MCSendMail::getInstance()->sendMail(true);
    }
}