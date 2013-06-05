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
                $this->form->save();
                $this->form->getObject()->setAccount($this->account);
                if(!$request->getParameter('drafted')){
                    $this->form->getObject()->setCompleted(true);
                }
                $this->form->getObject()->save();
                $this->redirect("@dashboard?account_id={$this->account->getId()}");
            }
        }
    }

    public function executeComplete(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->flight = Doctrine_Core::getTable('Flight')->find($request->getParameter('id'));
        $this->data_fields = json_decode($this->flight->generateFromDB($this->account), true);
        $this->users = sfGuardUserTable::getPilotsByAccountArray($this->account->getId());
        $this->form = new FlightForm($this->flight, array('user' => $this->getUser()->getGuardUser(), 'account' => $this->account, 'drafted' => !$this->flight->getCompleted()));
        if($request->isMethod('POST')){
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid()){
                $this->form->save();
                $this->form->getObject()->setAccount($this->account);
                if(!$request->getParameter('drafted')){
                    $this->form->getObject()->setCompleted(true);
                }
                $this->form->getObject()->save();
                $this->redirect("@dashboard?account_id={$this->account->getId()}");
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

    public function executeMitigate(sfWebRequest $request){

    }

    public function executeGetRisk(sfWebRequest $request){
        $this->setLayout(false);
        $this->forward404Unless($request->isXmlHttpRequest());
        $response_option = Doctrine_Core::getTable('ResponseOptionField')->find($request->getParameter('id'));
        echo json_encode(array(
            'result'=>'OK',
            'risk' => $response_option->getResponseValue() > 0 ? $response_option->getResponseValue() : null,
            'note' => $response_option->getResponseValue() > 0 ? $response_option->getNote() : null
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