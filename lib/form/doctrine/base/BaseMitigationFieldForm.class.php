<?php

/**
 * MitigationField form base class.
 *
 * @method MitigationField getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMitigationFieldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'risk_builder_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RiskBuilder'), 'add_empty' => true)),
      'type'            => new sfWidgetFormInputText(),
      'message'         => new sfWidgetFormInputText(),
      'instructions'    => new sfWidgetFormInputText(),
      'min_value'       => new sfWidgetFormInputText(),
      'max_value'       => new sfWidgetFormInputText(),
      'chief_notify'    => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'risk_builder_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RiskBuilder'), 'required' => false)),
      'type'            => new sfValidatorPass(array('required' => false)),
      'message'         => new sfValidatorPass(array('required' => false)),
      'instructions'    => new sfValidatorPass(array('required' => false)),
      'min_value'       => new sfValidatorInteger(array('required' => false)),
      'max_value'       => new sfValidatorInteger(array('required' => false)),
      'chief_notify'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('mitigation_field[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MitigationField';
  }

}
