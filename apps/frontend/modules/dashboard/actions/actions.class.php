<?php

class dashboardActions extends sfActions {

    public function preExecute() {

    }

    public function executeIndex(sfWebRequest $request){
        $account_id = $request->getParameter('account_id');
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
            $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
        }
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);

    }


    private function checkConditions($account_id) {
        $this->check_conditions = array();
        $this->check_conditions['signup'] = $this->getUser()->getGuardUser() ? true : false;
        $this->check_conditions['plane'] = AccountPlaneTable::getPlanesByAccount($account_id) > 0;
        $risk_builder = Doctrine_Core::getTable('RiskBuilder')->findOneBy('account_id', $account_id);
        $this->check_conditions['form'] = !$risk_builder->getIsDefault();
        $this->check_conditions['signup'] = $this->getUser()->getGuardUser() ? true : false;
        $this->check_conditions['signup'] = $this->getUser()->getGuardUser() ? true : false;

    }
}