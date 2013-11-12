<?php

/**
 * Flight form.
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FlightForm extends BaseFormDoctrine
{
  public function setup()
  {
      $this->setWidget('id', new sfWidgetFormInputHidden());
      $this->setValidator('id', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('risk_factor_sum', new sfWidgetFormInputHidden());
      $this->setValidator('risk_factor_sum', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('mitigation_sum', new sfWidgetFormInputHidden());
      $this->setValidator('mitigation_sum', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('plane_id', new sfWidgetFormInputHidden());
      $this->setValidator('plane_id', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('pic_id', new sfWidgetFormInputHidden());
      $this->setValidator('pic_id', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('sic_id', new sfWidgetFormInputHidden());
      $this->setValidator('sic_id', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('time_str', new sfWidgetFormInput());
      $this->setValidator('time_str', new sfValidatorString(array('required' => true, 'max_length' => 4)));
      if($this->isNew()){
          $data_fields = json_decode(Flight::generateFromDB($this->getOption('account')), true);
      } else {
          $data_fields = json_decode($this->getObject()->getInfo(), true);
      }

      foreach($data_fields as $key => $data_field){
          if(!is_array($data_field) && $key != "form_name" && $key != "form_instructions" && !$this->startsWith($key, 'mitigation')){
              if($key == "airport_to") {
                  $this->setWidget("{$key}_id", new sfWidgetFormInputHidden());
                  $this->setValidator("{$key}_id", new sfValidatorPass());
                  $this->setWidget("{$key}_name", new sfWidgetFormInput());
                  $this->setValidator("{$key}_name", new sfValidatorString(array("required" => true, 'min_length' => 4, 'max_length' => 4)));
                  if($this->getObject()->getAirportToId()){
                      $this->setDefault("{$key}_id", $this->getObject()->getAirportTo()->getId());
                      $this->setDefault("{$key}_name", $this->getObject()->getAirportTo()->getICAO());
                  }

              } else if($key == "airport_from"){
                  $this->setWidget("{$key}_id", new sfWidgetFormInputHidden());
                  $this->setValidator("{$key}_id", new sfValidatorPass());
                  $this->setWidget("{$key}_name", new sfWidgetFormInput());
                  $this->setValidator("{$key}_name", new sfValidatorString(array("required" => true, 'min_length' => 4, 'max_length' => 4)));
                  if($this->getObject()->getAirportFromId()){
                      $this->setDefault("{$key}_id", $this->getObject()->getAirportFrom()->getId());
                      $this->setDefault("{$key}_name", $this->getObject()->getAirportFrom()->getICAO());
                  }

              } else {

                  $this->setWidget($key, new sfWidgetFormInput());
                  $this->setValidator($key, new sfValidatorString(array("required" => true)));
                  if(!$this->isNew()){
                      if($key == "departure_date"){
                          $this->setDefault($key, date('Y-m-d', strtotime($this->getObject()->getDepartureDate())));
                      } else if($key == "departure_time"){
                          $this->setDefault($key, date('H:i', strtotime($this->getObject()->getDepartureDate())));
                      }
                  } else {
                      if($key == "departure_date"){
                          $this->setDefault($key, date('Y-m-d', time()));
                      } else if($key == "departure_time"){
                          $this->setDefault($key, date('H:i', time()));
                      }
                  }
              }

          } else if($key == "flight_information") {
              foreach($data_field as $fi){
                  $key = $this->getObject()->generateKeyByTitle($fi['name']);
                  if($key == "trip_number"){
                      $is_required = $this->getOption('account')->getRiskBuilders()->getFirst()->getFlightInformationFieldTripNumber();
                      if($is_required){
                          $class = 'required_trip_number';
                      }else{
                          $class = null;
                      }

                      $this->setWidget($key, new sfWidgetFormInput(array(), array('class' => $class.' '.'trip-number')));
                      $this->setValidator($key, new sfValidatorString(array("required" => $is_required)));
                  } else if($key == "plane"){
                      $this->setWidget($key, new sfWidgetFormDoctrineChoiceCustom(array(
                          'model' => 'Plane',
                          'table_method' => 'getPlanes',
                          'table_method_parameters' => array('account' => $this->getOption('account')),
                          'renderer_class' => 'sfWidgetFormList'
                      )));
                      $this->setValidator($key, new sfValidatorDoctrineChoice(array('model' => 'Plane',"required" => true)));
                      if(!$this->isNew()){
                          $this->setDefault($key, $this->getObject()->getPlane()->getId());
                      }
                  } else if($key == 'pilot_in_command'){
                      $this->setWidget($key, new sfWidgetFormDoctrineChoiceCustom(array(
                          'model' => 'sfGuardUser',
                          'table_method' => 'getUsers',
                          'table_method_parameters' => array('account' => $this->getOption('account')),
                          'method' => 'getUserTitle',
                          'method_parameters' => array('curr_user' => $this->getOption('user')),
                          'renderer_class' => 'sfWidgetFormList'
                      )));
                      $this->setValidator($key, new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser',"required" => true)));
                      if(!$this->isNew()){
                          $this->setDefault($key, $this->getObject()->getPIC()->getId());
                      } else {
                          $this->setDefault($key, $this->getOption('user')->getId());
                      }
                  } else {
                      $this->setWidget($key, new sfWidgetFormDoctrineChoiceCustom(array(
                          'model' => 'sfGuardUser',
                          'table_method' => 'getUsersWithMore',
                          'table_method_parameters' => array('account' => $this->getOption('account')),
                          'method' => 'getUserTitle',
                          'method_parameters' => array('curr_user' => $this->getOption('user')),
                          'renderer_class' => 'sfWidgetFormList'
                      )));
                      $this->setValidator($key, new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser',"required" => true)));
                      $this->setWidget("{$key}_custom", new sfWidgetFormInput());
                      $this->setValidator("{$key}_custom", new sfValidatorPass());
                      if(!$this->isNew()){
                          if($this->getObject()->getSicId()){
                              $this->setDefault($key, $this->getObject()->getSIC()->getId());
                          } elseif($this->getObject()->getSicCustom()) {
                              $this->setDefault($key, 0);
                              $this->setDefault("{$key}_custom", $this->getObject()->getSicCustom());
                          }
                      } else {
                          $this->setDefault($key, sfGuardUserTable::getDefaultUserIdByAccount($this->getOption('account'), $this->getOption('user')));
                      }
                  }
              }
          } else if($key == 'risk_analysis'){
              $index = 0;
              foreach($data_field as $risk_factor){

                      $options = $this->getObject()->getResponseOptionTitles($risk_factor);
                      $this->setWidget("flight_risk_factor_{$index}", new sfWidgetFormChoice(array('choices' => $options, 'renderer_class' => 'sfWidgetFormList')));
                  if($risk_factor['section_title'] == false)
                  {
                      $this->setValidator("flight_risk_factor_{$index}", new sfValidatorChoice(array('choices' => array_keys($options))));
                  }
                      if(!is_null($risk_factor['selected_response'])){
                          $this->setDefault("flight_risk_factor_{$index}", $risk_factor['selected_response']);
                      } else {
                          reset($options);
                          $this->setDefault("flight_risk_factor_{$index}", key($options));
                      }
                      $this->widgetSchema->setLabel("flight_risk_factor_{$index}", $risk_factor['question']);
                      $index++;
                  }
              }
          }

      if(!is_null($this->getObject()->getStatus() == 'assess')){
          $this->setWidget('mitigation_note', new sfWidgetFormTextarea());
          $this->setValidator('mitigation_note', new sfValidatorString(array('required' => false)));
      }
      $this->setWidget('flight_note', new sfWidgetFormTextarea());
      $this->setValidator('flight_note', new sfValidatorString(array('required' => false)));
      $this->disableCSRFProtection();

      $this->widgetSchema->setNameFormat('flight[%s]');

      $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

      $this->setupInheritance();
      $this->mergePostValidator(new sfValidatorSchemaCompare(
          'pilot_in_command', sfValidatorSchemaCompare::NOT_EQUAL, 'second_in_command', array(), array('invalid' => 'PIC and SIC cannot be the same person')));
      $this->mergePostValidator(new sfValidatorSchemaCompareCustom(
          'airport_from_id', sfValidatorSchemaCompareCustom::NOT_EQUAL, 'airport_to_id', array(), array('invalid' => 'Airport From ID and Airport To ID cannot be the same airport')));

      parent::setup();
  }

    public function getModelName()
    {
        return 'Flight';
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null){
        if($this->isNew()){
            $data_fields = json_decode(Flight::generateFromDB($this->getOption('account')), true);
        } else {
            $data_fields = json_decode($this->getObject()->getInfo(), true);
        }
        $total_score = 0;
        if($this->getObject()->getStatus() == 'assess'){
            $mitigation_sum = is_null($this->getObject()->getMitigationSum()) ? 0 : $this->getObject()->getMitigationSum();
        }

        $taintedValues['departure_date'] = date('Y-m-d H:i', strtotime($taintedValues['departure_date']) +
            (strtotime($taintedValues['departure_time']) - strtotime(date('Y-m-d', time()))));
        $data_fields['departure_date']= date('Y-m-d', strtotime($taintedValues['departure_time']));
        $data_fields['departure_time']= date('H:i', strtotime($taintedValues['departure_time']));
        foreach($data_fields as $key => $data_field){
            if($key == "risk_analysis"){
                for($i = 0; $i < count($data_field); $i++){
                    if($data_fields['risk_analysis'][$i]['section_title'] == false)
                    {
                        if($this->getObject()->getStatus() == 'assess'){
                            $mitigation_score = $data_field[$i]['response_options'][$data_fields['risk_analysis'][$i]['selected_response']]['value'] - $data_field[$i]['response_options'][$taintedValues["flight_risk_factor_{$i}"]]['value'];;
                            $data_fields['risk_analysis'][$i]['mitigation'] = $data_fields['risk_analysis'][$i]['mitigation'] + $mitigation_score;
                            $mitigation_sum +=  $mitigation_score;
                        }
                        $data_fields['risk_analysis'][$i]['selected_response'] =  $taintedValues["flight_risk_factor_{$i}"];
                        $total_score += $data_field[$i]['response_options'][$taintedValues["flight_risk_factor_{$i}"]]['value'];
                    }

                }
            }
        }
        $taintedValues['plane_id'] = $taintedValues['plane'];
        $taintedValues['pic_id'] = $taintedValues['pilot_in_command'];
        if(isset($taintedValues['second_in_command'])){
            $schema = $this->getValidatorSchema();
            $fields = $schema->getFields();
            $fields['second_in_command']->setOption('required', false);
            if(intval($taintedValues['second_in_command']) === 0){
                $taintedValues['sic_id'] = null;
                $taintedValues['second_in_command'] = null;

            } else {
                $taintedValues['sic_id'] = $taintedValues['second_in_command'];
            }
        }


        if($this->getObject()->getStatus() == 'assess'){
            $taintedValues['mitigation_sum'] = $mitigation_sum >= 0 ? $mitigation_sum : 0;
        }
        $taintedValues['risk_factor_sum'] = $total_score;
        $this->getObject()->setInfo(json_encode($data_fields));
        if($this->getOption('drafted')){
            $schema = $this->getValidatorSchema();
            foreach($schema->getFields() as $validator){
                $validator->setOption('required', false);
                if($validator instanceof sfValidatorInteger) {
                    $validator->setOption('min', 0);
                    $validator->setOption('max', 9999999);
                } else if($validator instanceof sfValidatorString) {
                    $validator->setOption('min_length', 0);
                    $validator->setOption('max_length', 255);
                }

            }
        }

        parent::bind($taintedValues, $taintedFiles);
    }

    private function startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    public function processValues($values = null)
    {
        if (isset($values['airport_from_name']) && $values['airport_from_name'] != '')
        {
            $airport = Doctrine_Core::getTable("Airport")->findOneBy('ICAO', $values['airport_from_name']);
            if (!$airport)
            {
                $airport = new Airport();
                $airport->setICAO(strtoupper($values['airport_from_name']));
                $airport->save();
                //Notifications::NewNotValidCompanyCreated($company);
            }
            $values['airport_from_id'] = $airport->getId();
        } else {
            $values['airport_from_id'] = null;
        }

        if (isset($values['airport_to_name']) && $values['airport_to_name'] != '')
        {
            $airport = Doctrine_Core::getTable("Airport")->findOneBy('ICAO', $values['airport_to_name']);
            if (!$airport)
            {
                $airport = new Airport();
                $airport->setICAO(strtoupper($values['airport_to_name']));
                $airport->save();
                //Notifications::NewNotValidCompanyCreated($company);
            }
            $values['airport_to_id'] = $airport->getId();
        } else {
            $values['airport_to_id'] = null;
        }

        if(!$values['sic_id'] && $values['second_in_command_custom'] != ""){
            $values['sic_custom'] = $values['second_in_command_custom'];
        } else {
            $values['sic_custom'] = null;
        }
        return $values;
    }
}
