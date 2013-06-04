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
      $this->setWidget('risk_factor_mitigation', new sfWidgetFormInputHidden());
      $this->setValidator('risk_factor_mitigation', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('plane_id', new sfWidgetFormInputHidden());
      $this->setValidator('plane_id', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('pic_id', new sfWidgetFormInputHidden());
      $this->setValidator('pic_id', new sfValidatorInteger(array('required' => false)));
      $this->setWidget('sic_id', new sfWidgetFormInputHidden());
      $this->setValidator('sic_id', new sfValidatorInteger(array('required' => false)));
      if($this->isNew()){
          $data_fields = json_decode(Flight::generateFromDB($this->getOption('account')), true);
      } else {
          $data_fields = json_decode($this->getObject()->getInfo(), true);
      }
      foreach($data_fields as $key => $data_field){
          if(!is_array($data_field) && $key != "form_name" && $key != "form_instructions"){
              $this->setWidget($key, new sfWidgetFormInput());
              $this->setValidator($key, new sfValidatorString());
          } else if($key == "flight_information") {
              foreach($data_field as $fi){
                  $key = $this->getObject()->generateKeyByTitle($fi['name']);
                  if($key == "trip_number"){
                      $this->setWidget($key, new sfWidgetFormInput());
                      $this->setValidator($key, new sfValidatorString());
                  } else if($key == "plane"){
                      $this->setWidget($key, new sfWidgetFormDoctrineChoice(array(
                          'model' => 'Plane',
                          /*'table_method' => 'getPlanes'*/
                          ))
                      );
                      $this->setValidator($key, new sfValidatorDoctrineChoice(array('model' => 'Plane')));
                  } else if($key == 'pilot_in_command'){
                      $this->setWidget($key, new sfWidgetFormDoctrineChoiceCustom(array(
                          'model' => 'sfGuardUser',
                          'table_method' => 'getUsers',
                          'table_method_parameters' => array('account' => $this->getOption('account')),
                          'method' => 'getUserTitle',
                          'method_parameters' => array('curr_user' => $this->getOption('user'))
                      )));
                      $this->setValidator($key, new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser')));
                      $this->setDefault($key, $this->getOption('user')->getId());
                  } else {
                      $this->setWidget($key, new sfWidgetFormDoctrineChoiceCustom(array(
                          'model' => 'sfGuardUser',
                          'table_method' => 'getUsers',
                          'table_method_parameters' => array('account' => $this->getOption('account')),
                          'method' => 'getUserTitle',
                          'method_parameters' => array('curr_user' => $this->getOption('user'))
                      )));
                      $this->setValidator($key, new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser')));
                  }
              }
          } else if($key == 'risk_analysis'){
              $index = 0;
              foreach($data_field as $risk_factor){
                  $this->setWidget("flight_risk_factor_{$index}", new sfWidgetFormChoice(array('choices' => $this->getObject()->getResponseOptionTitles($risk_factor))));
                  $this->setValidator("flight_risk_factor_{$index}", new sfValidatorChoice(array('choices' => array_keys($this->getObject()->getResponseOptionTitles($risk_factor)))));
                  if(!is_null($risk_factor['selected_response'])){
                      $this->setDefault("flight_risk_factor_{$index}", $risk_factor['selected_response']);
                  }
                  $this->widgetSchema->setLabel("flight_risk_factor_{$index}", $risk_factor['question']);
                  $index++;
              }
          }
      }

      $this->disableCSRFProtection();

      $this->widgetSchema->setNameFormat('flight[%s]');

      $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

      $this->setupInheritance();

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
        if($this->getObject()->getCompleted()){
            $mitigation_score = 0;
        }
        $taintedValues['departure_date'] = date('Y m d H:i',strtotime($taintedValues['departure_date']) + strtotime($taintedValues['departure_time']));
        foreach($data_fields as $key => $data_field){
            if($key == "risk_analysis"){
                for($i = 0; $i < count($data_field); $i++){
                    if($this->getObject()->getCompleted()){
                        $mitigation_score += $data_field[$i]['response_options'][$data_fields['risk_analysis'][$i]['selected_response']]['value'] - $data_field[$i]['response_options'][$taintedValues["flight_risk_factor_{$i}"]]['value'];;
                    }
                    $data_fields['risk_analysis'][$i]['selected_response'] =  $taintedValues["flight_risk_factor_{$i}"];
                    $total_score += $data_field[$i]['response_options'][$taintedValues["flight_risk_factor_{$i}"]]['value'];
                }
            }
        }
        $taintedValues['plane_id'] = $taintedValues['plane'];
        $taintedValues['pic_id'] = $taintedValues['pilot_in_command'];
        if(isset($taintedValues['second_in_command'])){
            $taintedValues['sic_id'] = $taintedValues['second_in_command'];
        }
        if($this->getObject()->getCompleted()){
            $taintedValues['risk_factor_mitigation'] = $mitigation_score;
        }
        $taintedValues['risk_factor_sum'] = $total_score;
        $this->getObject()->setInfo(json_encode($data_fields));
        if($this->getOption('drafted')){
            $schema = $this->getValidatorSchema();
            foreach($schema->getFields() as $validator){
                $validator->setOption('required', false);
            }
        }

        parent::bind($taintedValues, $taintedFiles);
    }
}
