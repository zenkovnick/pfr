<?php

/**
 * RiskBuilder
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    blueprint
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class RiskBuilder extends BaseRiskBuilder
{
    public function createDefaultForm($account){

        if(file_exists(sfConfig::get('sf_root_dir')."/web/files/defaultForm.json")){
            $json_data = file_get_contents(sfConfig::get('sf_root_dir')."/web/files/defaultForm.json");
            $data_array = json_decode($json_data, true);
            $this->setFormName($data_array['form_name']);
            $this->setFormInstructions($data_array['form_instructions']);
            $flight_information_collection = new Doctrine_Collection('FlightInformationField');
            foreach($data_array['flight_informations'] as $flight_information_data){
                $flight_information = new FlightInformationField();
                $flight_information->setInformationName($flight_information_data['information_name']);
                $flight_information->setPosition($flight_information_data['position']);
                $flight_information->setHiddable($flight_information_data['hiddable']);
                $flight_information->setRiskBuilder($this);
                $flight_information_collection->add($flight_information);
            }
            $this->setFlightInformationFields($flight_information_collection);

            $this->setMitigationLowMessage($data_array['mitigation_low_message']);
            $this->setMitigationLowInstructions($data_array['mitigation_low_instructions']);
            $this->setMitigationLowMin($data_array['mitigation_low_min']);
            $this->setMitigationLowMax($data_array['mitigation_low_max']);
            $this->setMitigationLowNotify($data_array['mitigation_low_notify']);
            $this->setMitigationMediumMessage($data_array['mitigation_medium_message']);
            $this->setMitigationMediumInstructions($data_array['mitigation_medium_instructions']);
            $this->setMitigationMediumMin($data_array['mitigation_medium_min']);
            $this->setMitigationMediumMax($data_array['mitigation_medium_max']);
            $this->setMitigationMediumNotify($data_array['mitigation_medium_notify']);
            $this->setMitigationMediumRequireDetails($data_array['mitigation_medium_require_details']);
            $this->setMitigationHighMessage($data_array['mitigation_high_message']);
            $this->setMitigationHighInstructions($data_array['mitigation_high_instructions']);
            $this->setMitigationHighMin($data_array['mitigation_high_min']);
            $this->setMitigationHighMax($data_array['mitigation_high_max']);
            $this->setMitigationHighNotify($data_array['mitigation_high_notify']);
            $this->setMitigationHighPreventFlight($data_array['mitigation_high_prevent_flight']);
            $this->setAccount($account);
            $this->save();

        }
    }
}
