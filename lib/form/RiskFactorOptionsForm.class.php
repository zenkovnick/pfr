<?php

class RiskFactorOptionsForm extends RiskFactorFieldForm{
    public function configure()
    {
        parent::configure();
        $this->embedRelation("ResponseOptions");
        $this->disableCSRFProtection();
    }

    public function addNewFields($number, $type = 'new')
    {
        $new_response_options = new RiskFactorFieldForm();

        for($i=0; $i <= $number; $i+=1){
            $response_option = new ResponseOptionField();
            if($type == 'default_no'){
                $response_option->setResponseText('No');
                $response_option->setResponseValue(0);
            } else if($type == 'default_yes'){
                $response_option->setResponseText('Yes');
                $response_option->setResponseValue(3);
            }
            $response_option->setRiskFactorField($this->getObject());
            $response_option_form = new ResponseOptionFieldForm($response_option);

            $new_response_options->embedForm($i,$response_option_form);
        }

        $this->embedForm('new-response', $new_response_options);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null){
        if (isset($taintedValues['new-response']))
        {
            $new_response_options = new sfForm();
            foreach($taintedValues['new-response'] as $key => $new_occurrence){
                $response_option = new ResponseOptionField();
                $response_option->setRiskFactorField($this->getObject());
                $response_option_form = new ResponseOptionFieldForm($response_option);

                $new_response_options->embedForm($key,$response_option_form);
            }

            $this->embedForm('new-response', $new_response_options);
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
