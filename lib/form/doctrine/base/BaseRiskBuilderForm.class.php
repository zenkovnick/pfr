<?php

/**
 * RiskBuilder form base class.
 *
 * @method RiskBuilder getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRiskBuilderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                => new sfWidgetFormInputHidden(),
      'account_id'                        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => true)),
      'form_name'                         => new sfWidgetFormInputText(),
      'form_instructions'                 => new sfWidgetFormInputText(),
      'mitigation_low_message'            => new sfWidgetFormInputText(),
      'mitigation_low_instructions'       => new sfWidgetFormInputText(),
      'mitigation_low_min'                => new sfWidgetFormInputText(),
      'mitigation_low_max'                => new sfWidgetFormInputText(),
      'mitigation_low_notify'             => new sfWidgetFormInputCheckbox(),
      'mitigation_medium_message'         => new sfWidgetFormInputText(),
      'mitigation_medium_instructions'    => new sfWidgetFormInputText(),
      'mitigation_medium_min'             => new sfWidgetFormInputText(),
      'mitigation_medium_max'             => new sfWidgetFormInputText(),
      'mitigation_medium_notify'          => new sfWidgetFormInputCheckbox(),
      'mitigation_medium_require_details' => new sfWidgetFormInputCheckbox(),
      'mitigation_high_message'           => new sfWidgetFormInputText(),
      'mitigation_high_instructions'      => new sfWidgetFormInputText(),
      'mitigation_high_min'               => new sfWidgetFormInputText(),
      'mitigation_high_max'               => new sfWidgetFormInputText(),
      'mitigation_high_notify'            => new sfWidgetFormInputCheckbox(),
      'mitigation_high_prevent_flight'    => new sfWidgetFormInputCheckbox(),
      'created_at'                        => new sfWidgetFormDateTime(),
      'updated_at'                        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'account_id'                        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'required' => false)),
      'form_name'                         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'form_instructions'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mitigation_low_message'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mitigation_low_instructions'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mitigation_low_min'                => new sfValidatorInteger(array('required' => false)),
      'mitigation_low_max'                => new sfValidatorInteger(array('required' => false)),
      'mitigation_low_notify'             => new sfValidatorBoolean(array('required' => false)),
      'mitigation_medium_message'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mitigation_medium_instructions'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mitigation_medium_min'             => new sfValidatorInteger(array('required' => false)),
      'mitigation_medium_max'             => new sfValidatorInteger(array('required' => false)),
      'mitigation_medium_notify'          => new sfValidatorBoolean(array('required' => false)),
      'mitigation_medium_require_details' => new sfValidatorBoolean(array('required' => false)),
      'mitigation_high_message'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mitigation_high_instructions'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mitigation_high_min'               => new sfValidatorInteger(array('required' => false)),
      'mitigation_high_max'               => new sfValidatorInteger(array('required' => false)),
      'mitigation_high_notify'            => new sfValidatorBoolean(array('required' => false)),
      'mitigation_high_prevent_flight'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'                        => new sfValidatorDateTime(),
      'updated_at'                        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('risk_builder[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RiskBuilder';
  }

}
