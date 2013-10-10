<?php

class dashboardActions extends sfActions {

    public function preExecute() {

    }

    public function executeIndex(sfWebRequest $request){

        $account_id = $request->getParameter('account_id');
        $user_id = $this->getUser()->getGuardUser()->getId();
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        if(!sfGuardUserTable::checkUserAccountAccess($account_id, $user_id)){
            $this->redirect("@select_account");
        }
        $user_account = UserAccountTable::getUserAccount($user_id, $account_id);
        $this->can_manage = $user_account->getIsManager();


        if(!$this->checkConditions($this->account)){
            $this->form = $this->account->getRiskBuilders()->getFirst();  /* Change if account will have more than one risk assessment form */
            $this->setTemplate('firstTime');
        } else {
            $this->setFlightData($request, $this);
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
        $chart = new FlightChart($this->flights_for_chart);

        $user_account = UserAccountTable::getUserAccount($this->getUser()->getGuardUser()->getId(), $this->account->getId());

        $dashboard_content = $this->getPartial('dashboard/dashboard_content', array(
            'account' => $this->account,
            'pager' => $this->pager,
            'additional_info' => $this->additional_info,
            'can_manage' => $user_account->getIsManager()
        ));
        if($this->flights_for_chart->count() > 1) {
            $this->chart_markup = $chart->getChartMarkup();
            echo json_encode(array('result' => "OK", 'flight_chart' => $this->chart_markup, 'dashboard_data' => $dashboard_content));
        } else if ($this->flights_for_chart->count() == 1){
            $markup = $this->getPartial('dashboard/one_entity_placeholder');
            echo json_encode(array('result' => "one_data", 'markup' => $markup, 'dashboard_data' => $dashboard_content));
        } else {
            $markup = $this->getPartial('dashboard/no_data_placeholder');
            echo json_encode(array('result' => "no_data", 'markup' => $markup, 'dashboard_data' => $dashboard_content));
        }

        return sfView::NONE;

    }

    public function executeGetPageContent(sfWebRequest $request){

        $this->setLayout(false);
        $account_id = $request->getParameter('account_id');
        $this->account = Doctrine_Core::getTable('Account')->find($account_id);
        $this->setFlightData($request, $this);
        echo json_encode(array('result' => 'OK', 'dashboard_data' => $this->getPartial('dashboard/flight_list', array(
            'account' => $this->account,
            'pager' => $this->pager,
        ))));
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

        $obj->pager = new sfDoctrinePager("Flight", sfConfig::get('app_dashboard_limit'));
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

        $non_drafted_flights = $obj->filter->getQuery()->andWhere('f.drafted = 0')->execute();
        $flights = $obj->filter->getQuery()->execute();
        $additional_info = array();
        $additional_info['flights_count'] = $flights->count();
        $additional_info['average_risk'] = Flight::getAverageRisk($non_drafted_flights);
        $additional_info['average_mitigation'] = Flight::getAverageMitigation($non_drafted_flights);
        $obj->flights_for_chart = FlightTable::getFlightsForChart($obj->filter->getQuery());
        $obj->additional_info = $additional_info;

    }

    public function executeChartInit(sfWebRequest $request){
        $this->setLayout(false);
        $this->setFlightData($request, $this);
        $chart = new FlightChart($this->flights_for_chart);
        if($this->flights_for_chart->count() > 1) {
            $this->chart_markup = $chart->getChartMarkup();
            echo json_encode(array('result' => "OK", 'flight_chart' => $this->chart_markup));
        } else if ($this->flights_for_chart->count() == 1){
            $flight = $this->flights_for_chart->getFirst();
            $markup = $this->getPartial('dashboard/one_entity_placeholder');
            echo json_encode(array('result' => "one_data", 'markup' => $markup));
        } else {
            $markup = $this->getPartial('dashboard/no_data_placeholder');
            echo json_encode(array('result' => "no_data", 'markup' => $markup));
        }
        return sfView::NONE;

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

    public function executeViewFlight(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        if($this->flight->getStatus() == 'complete'){
            $flight_data = json_decode($this->flight->getInfo(), true);
            $this->high_risk_factors = array();
            foreach($flight_data['risk_analysis'] as $key => $risk_factor){
                $selected_response = $risk_factor['response_options'][$risk_factor['selected_response']];
                if($selected_response['value'] > 0){
                    $this->high_risk_factors[$key]['question'] = $risk_factor['question'];
                    $this->high_risk_factors[$key]['answer'] = $selected_response['text'];
                    $this->high_risk_factors[$key]['risk'] = $selected_response['value'];
                }
            }
            $this->mitigation_info = $this->flight->getMitigationInfo();

        } else {
            $this->redirect("@dashboard?account_id={$this->account_id}");
        }
    }

    public function executeSendEmail(sfWebRequest $request){
        $this->setLayout(false);
        $emails = $request->getParameter('emails');

        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('flight_id'));
        if($this->flight->getStatus() == 'complete'){
            $flight_data = json_decode($this->flight->getInfo(), true);
            $this->high_risk_factors = array();
            foreach($flight_data['risk_analysis'] as $key => $risk_factor){
                $selected_response = $risk_factor['response_options'][$risk_factor['selected_response']];
                if($selected_response['value'] > 0){
                    $this->high_risk_factors[$key]['question'] = $risk_factor['question'];
                    $this->high_risk_factors[$key]['answer'] = $selected_response['text'];
                    $this->high_risk_factors[$key]['risk'] = $selected_response['value'];
                }
            }
            $this->mitigation_info = $this->flight->getMitigationInfo();
            $email_subject = "Flight: {$this->flight->getAirportFrom()->getICAO()} to {$this->flight->getAirportTo()->getICAO()} in ".
                "{$this->flight->getPlane()->getTailNumber()} (".ucfirst($this->mitigation_info['type'])." risk)";
            $content  =                $this->getPartial('flight/assessment_email', array(
                'flight' => $this->flight,
                'high_risk_factors' => $this->high_risk_factors,
                'mitigation_info' => $this->mitigation_info
            ));

            $result = EmailNotification::sendFromDashboard(
                $emails,
                $content,
                $email_subject
            );
            if($result){
                echo json_encode(array('result' => "OK"));
            } else {
                echo json_encode(array('result' => "Can't send email"));
            }
        } else {
            echo json_encode(array('result' => "Flight is not complete"));
        }



        return sfView::NONE;
    }
}

