<?php

/**
 * reports actions.
 *
 * @package    blueprint
 * @subpackage reports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      $account_id = $request->getParameter('account_id');
      if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
          $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }
      $this->account = Doctrine_Core::getTable('Account')->find($account_id);
      $user_account = UserAccountTable::getUserAccount($this->getUser()->getGuardUser()->getId(), $account_id);
      $this->can_manage = $user_account->getIsManager();
  }

}
