<?php

/**
 * ResponseOtionsField form base class.
 *
 * @method ResponseOtionsField getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResponseOtionsFieldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'risk_factor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RiskFactorField'), 'add_empty' => true)),
      'response_text'  => new sfWidgetFormInputText(),
      'response_value' => new sfWidgetFormInputText(),
      'note'           => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'risk_factor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RiskFactorField'), 'required' => false)),
      'response_text'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'response_value' => new sfValidatorInteger(array('required' => false)),
      'note'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('response_otions_field[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ResponseOtionsField';
  }

}
