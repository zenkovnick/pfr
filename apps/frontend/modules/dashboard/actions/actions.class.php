<?php

class dashboardActions extends sfActions {

    public function executeIndex(sfWebRequest $request){
        $account_id = $request->getParameter('account_id');
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
    }
}