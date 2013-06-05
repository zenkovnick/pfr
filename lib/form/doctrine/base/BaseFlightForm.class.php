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
      'id'              => new sfWidgetFormInputHidden(),
      'account_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => true)),
      'plane_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plane'), 'add_empty' => true)),
      'pic_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PIC'), 'add_empty' => true)),
      'sic_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SIC'), 'add_empty' => true)),
      'trip_number'     => new sfWidgetFormInputText(),
      'airport_from'    => new sfWidgetFormInputText(),
      'airport_to'      => new sfWidgetFormInputText(),
      'departure_date'  => new sfWidgetFormInputText(),
      'risk_factor_sum' => new sfWidgetFormInputText(),
      'mitigation_sum'  => new sfWidgetFormInputText(),
      'info'            => new sfWidgetFormInputText(),
      'completed'       => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'account_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'required' => false)),
      'plane_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plane'), 'required' => false)),
      'pic_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PIC'), 'required' => false)),
      'sic_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SIC'), 'required' => false)),
      'trip_number'     => new sfValidatorPass(array('required' => false)),
      'airport_from'    => new sfValidatorPass(array('required' => false)),
      'airport_to'      => new sfValidatorPass(array('required' => false)),
      'departure_date'  => new sfValidatorPass(array('required' => false)),
      'risk_factor_sum' => new sfValidatorInteger(array('required' => false)),
      'mitigation_sum'  => new sfValidatorInteger(array('required' => false)),
      'info'            => new sfValidatorPass(array('required' => false)),
      'completed'       => new sfValidatorBoolean(array('required' => false)),
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
