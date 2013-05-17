<?php
class Worker1
{
    /**
     * reverse work handler
     *
     * @param GearmanJob $job Gearman job
     * @return string         Result sent to client
     */
    public static function adduser($job, $worker)
    {
        // sfGearman worker is passed as the 2nd parameter of the method
        // notifyEventJob() displays a trace in symfony task output
        // if --verbose is set, workload is logged too
        $worker->notifyEventJob($job);
        $data = unserialize($job->workload());
        $tree_obj = Doctrine_Core::getTable('sfGuardUser')->getTree();
        $user = $data['user'];
        if(!is_null($data['referal_id'])){
            $parent_user = Doctrine_Core::getTable('sfGuardUser')->find($data['referal_id']);
            $user->getNode()->insertAsLastChildOf($parent_user);
        } else {
            $tree_obj->createRoot($user);
        }
        self::sendNotification($user, $data['password']);

    }

    private function sendNotification($user, $password)
    {
        $text = '';
        $text .= "You have registered in TheSolution.org\n\r";
        $text .= "Your password in system is: {$password}";

        $mailer = sfContext::getInstance()->getMailer();
        $message = $mailer->compose(
            array(sfConfig::get('app_email_notification_from_email', 'no-reply@thesolution.org') => sfConfig::get('app_email_notification_from_name', 'TheSolution')),
            $user->getUsername(),
            sfConfig::get('app_email_notification_title', 'Registration instructions'),
            $text
        );

        try {
            $mailer->send($message);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}