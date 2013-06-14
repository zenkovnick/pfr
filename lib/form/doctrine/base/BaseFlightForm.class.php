<?php

/**
 * Flight form base class.
 *
 * @method Flight getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFlightForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'account_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => true)),
      'plane_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plane'), 'add_empty' => true)),
      'pic_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PIC'), 'add_empty' => true)),
      'sic_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SIC'), 'add_empty' => true)),
      'trip_number'      => new sfWidgetFormInputText(),
      'airport_from_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AirportFrom'), 'add_empty' => true)),
      'airport_to_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AirportTo'), 'add_empty' => true)),
      'departure_date'   => new sfWidgetFormInputText(),
      'risk_factor_sum'  => new sfWidgetFormInputText(),
      'risk_factor_type' => new sfWidgetFormChoice(array('choices' => array('low' => 'low', 'medium' => 'medium', 'high' => 'high'))),
      'mitigation_sum'   => new sfWidgetFormInputText(),
      'info'             => new sfWidgetFormInputText(),
      'drafted'          => new sfWidgetFormInputCheckbox(),
      'status'           => new sfWidgetFormChoice(array('choices' => array('new' => 'new', 'assess' => 'assess', 'complete' => 'complete'))),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'account_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'required' => false)),
      'plane_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plane'), 'required' => false)),
      'pic_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PIC'), 'required' => false)),
      'sic_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SIC'), 'required' => false)),
      'trip_number'      => new sfValidatorPass(array('required' => false)),
      'airport_from_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AirportFrom'), 'required' => false)),
      'airport_to_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AirportTo'), 'required' => false)),
      'departure_date'   => new sfValidatorPass(array('required' => false)),
      'risk_factor_sum'  => new sfValidatorInteger(array('required' => false)),
      'risk_factor_type' => new sfValidatorChoice(array('choices' => array(0 => 'low', 1 => 'medium', 2 => 'high'), 'required' => false)),
      'mitigation_sum'   => new sfValidatorInteger(array('required' => false)),
      'info'             => new sfValidatorPass(array('required' => false)),
      'drafted'          => new sfValidatorBoolean(array('required' => false)),
      'status'           => new sfValidatorChoice(array('choices' => array(0 => 'new', 1 => 'assess', 2 => 'complete'), 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

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
