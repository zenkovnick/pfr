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
        if(!$this->checkConditions($this->account)){
            $this->setTemplate('firstTime');
        }
    }


    private function checkConditions($account) {
        $valid = true;

        if(AccountPlaneTable::getPlanesByAccount($account->getId())->count() > 0) {
            $account->setHasPlane(true);
        } else {
            $valid = false;
            $account->setHasPlane(false);
        }

        /*if(Doctrine_Core::getTable('Flight')->findOneBy('account_id', $account->getId())) {
            $account->setHasFlight(true);
        } else {
            $valid = false;
            $account->setHasFlight(false);
        }*/

        return $valid;

    }
}