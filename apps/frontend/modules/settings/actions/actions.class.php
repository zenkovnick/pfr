<?php

class settingsActions extends sfActions {
    public function executeIndex(sfWebRequest $request){
        $account_id = $request->getParameter('account_id');
        $user = $this->getUser()->getGuardUser();
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $user->getId())){
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        $this->account_form = new AccountForm($this->account);
        $this->user_form = new MyInformationSettingsForm($user);
    }
}