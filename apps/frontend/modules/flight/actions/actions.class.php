<?php

/**
 * article actions.
 *
 * @package    blueprint
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class flightActions extends sfActions {

    public function executeNew(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        if(!sfGuardUserTable::checkUserAccountAccess($this->account->getId(), $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }
        $this->flight = new Flight();
        $this->data_fields = json_decode($this->flight->generateFromDB($this->account), true);
        //$this->form = new FlightForm($this->flight, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account));
        $this->users = sfGuardUserTable::getPilotsByAccountArray($this->account->getId());
        $this->form = new FlightForm(null, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account, 'drafted' => $request->getParameter('drafted')));
        if($request->isMethod('POST')){
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid()){
                $flight = $this->form->save();
                $flight->setAccount($this->account);
                if(!$request->getParameter('drafted')){
                    $flight->setStatus('assess');
                    $flight->save();
                    $this->redirect("@risk_assessment?account_id={$this->account->getId()}&id={$flight->getId()}");
                } else {
                    $flight->setDrafted(true);
                    if(!$this->account->getHasFlight()){
                        $this->account->setHasFlight(true);
                        $this->account->save();
                    }
                    $mitigation = $flight->getMitigationInfo();
                    $flight->setRiskFactorType($mitigation['type']);
                    $flight->save();
                    $this->redirect("@dashboard?account_id={$this->account->getId()}");
                }
            }
        }
    }

    public function executeEdit(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        if(!sfGuardUserTable::checkUserAccountAccess($this->account->getId(), $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        $this->data_fields = json_decode($this->flight->getInfo(), true);
        $this->users = sfGuardUserTable::getPilotsByAccountArray($this->account->getId());
        $this->form = new FlightForm($this->flight, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account, 'drafted' => $this->flight->getDrafted()));
        if($request->isMethod('POST')){
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid()){
                $flight = $this->form->save();
                if(!$request->getParameter('drafted')){
                    $flight->setStatus('assess');
                    $flight->save();
                    $this->redirect("@risk_assessment?account_id={$this->account->getId()}&id={$flight->getId()}");
                } else {
                    $flight->setDrafted(true);
                    $mitigation = $flight->getMitigationInfo();
                    $flight->setRiskFactorType($mitigation['type']);
                    $flight->save();
                    if(!$this->account->getHasFlight()){
                        $this->account->setHasFlight(true);
                        $this->account->save();
                    }
                    $this->redirect("@dashboard?account_id={$this->account->getId()}");
                }
            }
        }
    }


    public function executeAssessment(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        if(!sfGuardUserTable::checkUserAccountAccess($this->account->getId(), $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        if($this->flight->getStatus() == 'assess'){
            $flight_data = json_decode($this->flight->getInfo(), true);
            $this->high_risk_factors = array();
            $arr = array();
            $i = -1;
            $ii = -1;
            foreach($flight_data['risk_analysis'] as $key => $risk_factor)
            {
                if($risk_factor['section_title']){
                    $i++;
                    $this->high_risk_factors [$i]['title'] = $risk_factor['question'];
                }
                elseif($risk_factor['response_options'][$risk_factor['selected_response']]['value']>0){
                    $arr['question'] = $risk_factor['question'];
                    $arr['answer'] = $risk_factor['response_options'][$risk_factor['selected_response']]['text'];
                    $arr['risk'] =  $risk_factor['response_options'][$risk_factor['selected_response']]['value'];

                    $ii++;
                    $this->high_risk_factors[$i]['question'][$ii] = $arr;
                }
            }
            $this->mitigation_info = $this->flight->getMitigationInfo();
        } else {
            $this->redirect("@dashboard?account_id={$this->account->getId()}");
        }
    }

    public function executeComplete(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        if(!sfGuardUserTable::checkUserAccountAccess($this->account->getId(), $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        $this->mitigation_info = $this->flight->getMitigationInfo();
        $this->with_high_risk = false;
        if($this->flight->getStatus() == 'assess' && !($this->mitigation_info['type'] == 'high' && $this->mitigation_info['prevent_flight'])){
            $this->flight->setRiskFactorType($this->mitigation_info['type']);
            $this->flight->setStatus('complete');
            $this->flight->setDrafted(false);
            $this->flight->save();
            if(!$this->account->getHasFlight()){
                $this->account->setHasFlight(true);
                $this->account->save();
            }
             //* send email to owner*//
            $flight_data = json_decode($this->flight->getInfo(), true);
            $this->high_risk_factors = array();
            $arr = array();
            $i = -1;
            $ii = -1;
            foreach($flight_data['risk_analysis'] as $key => $risk_factor)
            {
                if($risk_factor['section_title']){
                    $i++;
                    $this->high_risk_factors [$i]['title'] = $risk_factor['question'];
                }
                elseif($risk_factor['response_options'][$risk_factor['selected_response']]['value']>0){
                    $arr['question'] = $risk_factor['question'];
                    $arr['answer'] = $risk_factor['response_options'][$risk_factor['selected_response']]['text'];
                    $arr['risk'] =  $risk_factor['response_options'][$risk_factor['selected_response']]['value'];

                    $ii++;
                    $this->high_risk_factors[$i]['question'][$ii] = $arr;
                    if($risk_factor['response_options'][$risk_factor['selected_response']]['value'] >= sfConfig::get('app_email_notification_high_risk_factor_val')) {
                        $this->with_high_risk = true;
                    }
                }
            }
            $this->mitigation_info = $this->flight->getMitigationInfo();
            $email_subject = "New Flight: {$this->flight->getAirportFrom()->getICAO()} to {$this->flight->getAirportTo()->getICAO()} in ".
                "{$this->flight->getPlane()->getTailNumber()} (".ucfirst($this->mitigation_info['type'])." risk)";
            $result = EmailNotification::sendAssessment(
                $this->getUser()->getGuardUser(),
                ($this->account->getChiefPilot()->getId() && $this->mitigation_info['notify'])? $this->account->getChiefPilot() : null,
                $this->getPartial('flight/assessment_email', array(
                    'flight' => $this->flight,
                    'high_risk_factors' => $this->high_risk_factors,
                    'mitigation_info' => $this->mitigation_info
                )),
                $email_subject
            );

            //* Send emails to more peaple *//
            $this->risk_builder = Doctrine_Core::getTable('RiskBuilder')->findOneBy('account_id', $request->getParameter('account_id'));
            $this->emails = null;
            if($this->risk_builder->getMitigationLowNotify())
            {
                $this->emails = $this->risk_builder->getMitigationLowEmail();

                if($this->emails){
                    EmailNotification::sendEmailsAssessment(
                        $this->emails,
                        null,
                        $this->getPartial('flight/assessment_email', array(
                            'flight' => $this->flight,
                            'high_risk_factors' => $this->high_risk_factors,
                            'mitigation_info' => $this->mitigation_info
                        )),
                        $email_subject
                    );
                }
            }elseif($this->risk_builder->getMitigationMediumNotify() &&  $this->flight->getRiskFactorSum() >= $this->risk_builder->getMitigationMediumMin())
            {
                $this->emails = $this->risk_builder->getMitigationMediumEmail();

                if($this->emails){
                    EmailNotification::sendEmailsAssessment(
                        $this->emails,
                        null,
                        $this->getPartial('flight/assessment_email', array(
                            'flight' => $this->flight,
                            'high_risk_factors' => $this->high_risk_factors,
                            'mitigation_info' => $this->mitigation_info
                        )),
                        $email_subject
                    );
                }
            }elseif($this->risk_builder->getMitigationHighNotify()  && $this->flight->getRiskFactorSum() >= $this->risk_builder->getMitigationHighMin())
            {
                $this->emails = $this->risk_builder->getMitigationHighEmail();

                if($this->emails){
                    EmailNotification::sendEmailsAssessment(
                        $this->emails,
                        null,
                        $this->getPartial('flight/assessment_email', array(
                            'flight' => $this->flight,
                            'high_risk_factors' => $this->high_risk_factors,
                            'mitigation_info' => $this->mitigation_info
                        )),
                        $email_subject
                    );
                }
            }

            /* Send emails if high risk factor notify */
            if($this->risk_builder->getHighRiskFactorNotify() && $this->with_high_risk){
                EmailNotification::sendHighRiskNotify(
                    $this->risk_builder->getHighRiskFactorEmail(),
                    $this->account->getChiefPilot()->getId() ? $this->account->getChiefPilot() : null,
                    $this->getPartial('flight/high_risk_factor_email', array()),
                    'High risk factor notification'
                );

            }


            $this->redirect("@dashboard?account_id={$this->account->getId()}");
        } else {
            $this->redirect("@edit_flight?account_id={$this->account->getId()}&id={$this->flight->getId()}");
        }
    }

    public function executeGetRisk(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        if($this->getUser()->isAuthenticated()){
            $response_option = Doctrine_Core::getTable('ResponseOptionField')->find($request->getParameter('id'));
            echo json_encode(array(
                'result'=>'OK',
                'risk' => $response_option->getResponseValue(),
                'note' => $response_option->getNote()
            ));

        } else {
            echo json_encode(array('result'=>'login'));
        }
        return sfView::NONE;
    }

    public function executeGetUser(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        if($this->getUser()->isAuthenticated()){
            $user = Doctrine_Core::getTable('sfGuardUser')->find($request->getParameter('id'));
            $user_data = $this->getPartial('flight/avatar', array('user' => $user));
            echo json_encode(array(
                'result'=> 'OK',
                'user_data' => $user_data
            ));
        } else {
            echo json_encode(array('result'=>'login'));
        }
        return sfView::NONE;
    }

    public function executeAutocompleteAirport(sfWebRequest $request) {
        $this->setLayout(false);
        $result = AirportTable::getInstance()
            ->getAirportsByName($request['term']);
        $array = array();
        foreach($result as $airport){
            $record['id'] = $airport->getId();
            $record['value'] = $airport->getICAO();
            $array[] = $record;
        }
           // ->toKeyValueArray('id','name');
        return $this->renderText(json_encode($array));
    }

    public function executeGetAirports(sfWebRequest $request){
        $this->setLayout(false);
        $header = array('id','name', 'city', 'country', 'IATA_FAA', 'ICAO', 'latitude', 'longitude', 'altitude', 'timezone', 'DST');
        $airports = Flight::csvToArray(sfConfig::get('app_airports_url'), ',', $header);
        echo AirportTable::getInstance()->pushAirports($airports) ? "Success" : "Failed";
        return sfView::NONE;
    }

    public function executeAssessmentEmails(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        if(!sfGuardUserTable::checkUserAccountAccess($this->account->getId(), $this->getUser()->getGuardUser()->getId())){
            $this->redirect("@select_account");
        }

        $this->risk_builder = Doctrine_Core::getTable('RiskBuilder')->findOneBy('account_id', $request->getParameter('account_id'));
        $this->emails = null;
        if($this->risk_builder->getMitigationLowNotify())
        {
            $this->emails = $this->risk_builder->getMitigationLowEmail();
        }elseif($this->risk_builder->getMitigationMediumNotify())
        {
            $this->emails = $this->risk_builder->getMitigationMediumEmail();
        }elseif($this->risk_builder->getMitigationHighNotify())
        {
            $this->emails = $this->risk_builder->getMitigationHighEmail();
        }

        if($this->emails){
            $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
            if($this->flight->getStatus() == 'assess'){
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
                $email_subject = "New Flight: {$this->flight->getAirportFrom()->getICAO()} to {$this->flight->getAirportTo()->getICAO()} in ".
                    "{$this->flight->getPlane()->getTailNumber()} (".ucfirst($this->mitigation_info['type'])." risk)";
                $result = EmailNotification::sendEmailsAssessment(
                   $this->emails,
                    null,
                    $this->getPartial('flight/assessment_email', array(
                        'flight' => $this->flight,
                        'high_risk_factors' => $this->high_risk_factors,
                        'mitigation_info' => $this->mitigation_info
                    )),
                    $email_subject
                );
            }
            return sfView::NONE;
        }

    }

    public function executeGetDeletePopup(sfWebRequest $request){
        $this->setLayout(false);
        $flight = FlightTable::getInstance()->find($request->getParameter('id'));
        $this->renderPartial('delete_popup', array('flight' => $flight));
        return sfView::NONE;
    }

    public function executeDeleteRiskAssessment(sfWebRequest $request){
        $this->setLayout(false);
        $flight = FlightTable::getInstance()->find($request->getParameter('id'));
        if($flight){
            if($flight->delete()){
                echo json_encode(array('result' => 'OK'));
            } else {
                echo json_encode(array('result' => 'Failed', 'error' => 'Can\'t delete flight'));
            }
        } else {
            echo json_encode(array('result' => 'Failed', 'error' => 'Can\'t find flight'));
        }
        return sfView::NONE;
    }
}