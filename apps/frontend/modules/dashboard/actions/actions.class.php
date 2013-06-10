<?php

class dashboardActions extends sfActions {

    public function preExecute() {

    }

    public function executeIndex(sfWebRequest $request){

        $account_id = $request->getParameter('account_id');
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }


        if(!$this->checkConditions($this->account)){
            $this->form = $this->account->getRiskBuilders()->getFirst();  /* Change if account will have more than one risk assessment form */
            $this->setTemplate('firstTime');
        } else {
            $this->setFlightData($request, $this);
            //$this->avarage_risk = FlightTable::getAvarage
        }
    }

    public function executeSetFilter(sfWebRequest $request)
    {
        $this->setLayout(false);
        $top_controls = $request->getParameter('flight_filter', array());
        $old_filter = $this->getUser()->getAttribute('flight_filter', array('page' => 1));
        $top_controls['page'] = $old_filter['page'];
        $this->getUser()->setAttribute('flight_filter', $top_controls);
        $this->setFlightData($request, $this);
        echo json_encode(array('result' => 'OK', 'dashboard_data' => $this->getPartial('dashboard/dashboard_content', array('pager' => $this->pager))));
        return sfView::NONE;

    }

    private function setFlightData($request, &$obj){
        $account_id = $request->getParameter('account_id');
        $obj->account = Doctrine_Core::getTable('Account')->find($account_id);
        $flight_filter = $obj->getUser()->getAttribute('flight_filter', array('page' => 1));

        $obj->page = $request->getParameter('page', $flight_filter['page']);
        if ($obj->page != $flight_filter['page'])
        {
            $flight_filter['page'] = $obj->page;
        }

        $obj->filter = new FlightFormFilter($flight_filter, array('account' => $obj->account));

        $obj->pager = new sfDoctrinePager("Flight", 50);
        $obj->pager->setQuery($obj->filter->getQuery());
        $obj->pager->setPage($obj->page);
        $obj->pager->init();
        if (count($obj->pager->getResults()) == 0 && $obj->page > 1)
        {
            $obj->page = $obj->page - 1;
            $obj->pager->setPage($obj->page);
            $obj->pager->init();
        }
        if ($obj->pager->getLastPage() < $obj->page)
        {
            $obj->page = 1;
            $obj->pager->setPage($obj->page);
            $obj->pager->init();
        }
        $flight_filter['page'] = $obj->page;
        $obj->getUser()->setAttribute('flight_filter', $flight_filter);

        $obj->flights_count = Doctrine_Core::getTable('Flight')->findBy('account_id', $account_id)->count();
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

