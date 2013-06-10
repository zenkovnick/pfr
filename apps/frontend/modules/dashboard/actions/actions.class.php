<?php

class dashboardActions extends sfActions {

    public function preExecute() {

    }

    public function executeIndex(sfWebRequest $request){
        $account_id = $request->getParameter('account_id');
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        if(!$this->checkConditions($this->account)){
            $this->form = $this->account->getRiskBuilders()->getFirst();  /* Change if account will have more than one risk assessment form */
            $this->setTemplate('firstTime');
        } else {
            $this->flights = Doctrine_Core::getTable('Flight')->findBy('account_id', $account_id);
            $this->flights_count = $this->flights->count();
            //$this->avarage_risk = FlightTable::getAvarage
        }
    }


    private function checkConditions($account) {
        $valid = true;

        $valid = $this->getUser()->getGuardUser() ? true : false;

        if(AccountPlaneTable::getPlanesByAccount($account->getId())->count() > 0) {
            $account->setHasPlane(true);
        } else {
            $valid = false;
            $account->setHasPlane(false);
        }

        if(!$account->getHasSkippedPilot()){
            if(UserAccountTable::getPilotsByAccount($account->getId())->count() > 1){
                $account->setHasPilot(true);
            } else {
                $account->setHasPilot(false);
                $valid = false;

            }
        }

        if(!$account->getHasModifiedForm()){
            $valid = false;
        }

        if(!$account->getHasFlight()){
            $valid = false;
        }

        /*if(Doctrine_Core::getTable('Flight')->findOneBy('account_id', $account->getId())) {
            $account->setHasFlight(true);
        } else {
            $valid = false;
            $account->setHasFlight(false);
        }*/

        $account->save();
        return $valid;

    }

    public function executeSkipPilotCondition(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id')));
        $this->account->setHasSkippedPilot(true);
        $this->account->save();
        echo json_encode(array('result'=>'OK'));
        return sfView::NONE;
    }
}