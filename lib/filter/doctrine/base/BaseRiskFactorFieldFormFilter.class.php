<?php

/**
 * RiskFactorField filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRiskFactorFieldFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'risk_builder_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RiskBuilder'), 'add_empty' => true)),
      'question'        => new sfWidgetFormFilterInput(),
      'help_message'    => new sfWidgetFormFilterInput(),
      'position'        => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'risk_builder_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RiskBuilder'), 'column' => 'id')),
      'question'        => new sfValidatorPass(array('required' => false)),
      'help_message'    => new sfValidatorPass(array('required' => false)),
      'position'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('risk_factor_field_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RiskFactorField';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'risk_builder_id' => 'ForeignKey',
      'question'        => 'Text',
      'help_message'    => 'Text',
      'position'        => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
