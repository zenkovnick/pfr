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
      $data_fields = json_decode($this->getObject()->getInfo(), true);
      foreach($data_fields as $key => $data_field){
          if(!is_array($data_field)){
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
          } else {
              $index = 0;
              foreach($data_field as $risk_factor){
                  $this->setWidget("flight_risk_factor_{$index}", new sfWidgetFormChoice(array('choices' => $this->getObject()->getResponseOptionTitles($risk_factor))));
                  $this->setValidator("flight_risk_factor_{$index}", new sfValidatorChoice(array('choices' => $this->getObject()->getResponseOptionTitles($risk_factor))));
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
}
