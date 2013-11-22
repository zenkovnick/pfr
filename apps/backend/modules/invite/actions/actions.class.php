<?php

require_once dirname(__FILE__).'/../lib/inviteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/inviteGeneratorHelper.class.php';

/**
 * invite actions.
 *
 * @package    blueprint
 * @subpackage invite
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inviteActions extends autoInviteActions
{
    public function executeListResend(sfWebRequest $request){
        $user_account = UserAccountTable::getUserAccount( $request->getParameter('user_id'), $request->getParameter('account_id'));
        $pilot = $user = $user_account->getUser();
        $account = $user_account->getAccount();
        $url = $this->generateUrl('signup_invite', array('token' => $user_account->getInviteToken()), true);
        $html = $this->getPartial('invite/invite_email', array(
            'initiator' => $this->getUser()->getGuardUser(),
            'guest' => $pilot,
            'url' => $url,
            'account' => $account
        ));

        $result = EmailNotification::sendInvites(
            $pilot, $html
        );
        $this->getUser()->setFlash('notice', "Email was resent");

        $this->redirect('@user_account');
    }
}
