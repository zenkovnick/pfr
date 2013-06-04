<?php

class flightActions extends sfActions {

    public function executeNew(sfWebRequest $request){
        $this->account = Doctrine_Core::getTable('Account')->find($request->getParameter('account_id'));
        $this->flight = new Flight();
        $this->data_fields = $this->flight->generateFromDB($this->account);
        $this->form = new FlightForm($this->flight);

    }

    public function executeMitigate(sfWebRequest $request){

    }
}