<?php

class RiskFactorBuilderForm extends RiskBuilderForm {
    public function configure()
    {
        //$this->useFields(array('id'));
        $this->embedRelation("RiskFactorFields");

    }

    public function addNewFields($number)
    {
        $new_risk_factors = new RiskBuilderForm();

        for($i=0; $i <= $number; $i+=1){
            $risk_factor = new RiskFactorField();
            $risk_factor->setRiskBuilder($this->getObject());
            $risk_factor_form = new RiskFactorFieldForm($risk_factor);

            $new_risk_factors->embedForm($i,$risk_factor_form);
        }

        $this->embedForm('new', $new_risk_factors);
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null){
        if (isset($taintedValues['new']))
        {
            $new_risk_factors = new sfForm();
            foreach($taintedValues['new'] as $key => $new_occurrence){
                $risk_factor = new RiskFactorField();
                $risk_factor->setRiskBuilder($this->getObject());
                $risk_factor_form = new RiskFactorFieldForm($risk_factor);

                $new_risk_factors->embedForm($key,$risk_factor_form);
            }

            $this->embedForm('new', $new_risk_factors);
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}