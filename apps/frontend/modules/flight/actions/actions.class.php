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
                    $flight->save();
                    $this->redirect("@dashboard?account_id={$this->account->getId()}");
                }
            }
        }
    }

    public function executeEdit(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        $this->data_fields = json_decode($this->flight->generateFromDB($this->account), true);
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
                    $this->redirect("@dashboard?account_id={$this->account->getId()}");
                }
            }
        }
    }


    public function executeProcessSaveFlight(sfWebRequest $request){
        $this->forward404Unless($this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id')));
        //$this->forward404Unless($this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id')));
        //$this->form = new FlightForm($this->flight, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account));
        $this->form = new FlightForm(null, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account));
        if($request->isMethod('POST')){
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid()){

            }
        }

    }

    public function executeAssessment(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
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
            if($this->mitigation_info['notify']){
                $email_subject = "New Flight: {$this->flight->getAirportFrom()} to {$this->flight->getAirportTo()} in ".
                "{$this->flight->getPlane()->getTailNumber()} (".ucfirst($this->mitigation_info['type'])." risk)";
                $result = EmailNotification::sendAssessment(
                    $this->getUser()->getGuardUser(),
                    $this->getPartial('flight/assessment_email', array(
                        'flight' => $this->flight,
                        'high_risk_factors' => $this->high_risk_factors,
                        'mitigation_info' => $this->mitigation_info
                    )),
                    $email_subject
                );
            }
        } else {
            $this->redirect("@dashboard?account_id={$this->account->getId()}");
        }
    }


    /*public function executeMitigate(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        $this->data_fields = json_decode($this->flight->generateFromDB($this->account), true);
        $this->users = sfGuardUserTable::getPilotsByAccountArray($this->account->getId());
        $this->form = new FlightForm($this->flight, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account, 'drafted' => !$this->flight->getCompleted()));
        if($request->isMethod('POST')){
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid()){
                $flight = $this->form->save();
                $flight->save();
                $this->redirect("@risk_assessment?account_id={$this->account->getId()}&id={$flight->getId()}");
            }
        }
    }*/

    public function executeComplete(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        $this->mitigation_info = $this->flight->getMitigationInfo();
        if($this->flight->getStatus() == 'assess' && $this->mitigation_info['type'] != 'high'){
            $this->flight->setStatus('complete');
            $this->flight->setDrafted(false);
            $this->flight->save();
            if(!$this->account->getHasFlight()){
                $this->account->setHasFlight(true);
                $this->account->save();
            }
            $this->redirect("@dashboard?account_id={$this->account->getId()}");
        } else {
            $this->redirect("@edit_flight?account_id={$this->account->getId()}&id={$this->flight->getId()}");
        }
    }

    public function executeGetRisk(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $response_option = Doctrine_Core::getTable('ResponseOptionField')->find($request->getParameter('id'));
        echo json_encode(array(
            'result'=>'OK',
            'risk' => $response_option->getResponseValue(),
            'note' => $response_option->getNote()
        ));
        return sfView::NONE;
    }

    public function executeGetUser(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $user = Doctrine_Core::getTable('sfGuardUser')->find($request->getParameter('id'));
        $user_data = $this->getPartial('flight/avatar', array('user' => $user));
        echo json_encode(array(
            'result'=> 'OK',
            'user_data' => $user_data
        ));
        return sfView::NONE;
    }
}