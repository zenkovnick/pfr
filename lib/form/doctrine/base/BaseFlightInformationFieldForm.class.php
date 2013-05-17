<?php

/**
 * FlightInformationField form base class.
 *
 * @method FlightInformationField getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFlightInformationFieldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'risk_builder_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RiskBuilder'), 'add_empty' => true)),
      'information_name' => new sfWidgetFormInputText(),
      'position'         => new sfWidgetFormInputText(),
      'hiddable'         => new sfWidgetFormInputCheckbox(),
      'is_hide'          => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'risk_builder_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RiskBuilder'), 'required' => false)),
      'information_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'position'         => new sfValidatorInteger(array('required' => false)),
      'hiddable'         => new sfValidatorBoolean(array('required' => false)),
      'is_hide'          => new sfValidatorBoolean(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('flight_information_field[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FlightInformationField';
  }

}
