<?php

class RiskFactorOptionsForm extends RiskFactorFieldForm{
    public function configure()
    {
        $this->useFields(array('id'));
        $this->embedRelation("ResponseOptions");

    }

    public function addNewFields($number)
    {
        $new_response_options = new RiskFactorFieldForm();

        for($i=0; $i <= $number; $i+=1){
            $response_option = new ResponseOptionField();
            $response_option->setRiskFactorField($this->getObject());
            $response_option_form = new ResponseOptionFieldForm($response_option);

            $new_response_options->embedForm($i,$response_option_form);
        }

        $this->embedForm('new', $new_response_options);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null){
        if (isset($taintedValues['new']))
        {
            $new_response_options = new sfForm();
            foreach($taintedValues['new'] as $key => $new_occurrence){
                $response_option = new ResponseOptionField();
                $response_option->setRiskFactorField($this->getObject());
                $response_option_form = new RiskFactorFieldForm($response_option);

                $new_response_options->embedForm($key,$response_option_form);
            }

            $this->embedForm('new', $new_response_options);
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
