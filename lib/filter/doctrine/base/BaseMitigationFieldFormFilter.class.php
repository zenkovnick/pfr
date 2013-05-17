<?php

/**
 * MitigationField filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMitigationFieldFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'risk_builder_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RiskBuilder'), 'add_empty' => true)),
      'type'            => new sfWidgetFormFilterInput(),
      'message'         => new sfWidgetFormFilterInput(),
      'instructions'    => new sfWidgetFormFilterInput(),
      'min_value'       => new sfWidgetFormFilterInput(),
      'max_value'       => new sfWidgetFormFilterInput(),
      'chief_notify'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'risk_builder_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RiskBuilder'), 'column' => 'id')),
      'type'            => new sfValidatorPass(array('required' => false)),
      'message'         => new sfValidatorPass(array('required' => false)),
      'instructions'    => new sfValidatorPass(array('required' => false)),
      'min_value'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_value'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'chief_notify'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('mitigation_field_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MitigationField';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'risk_builder_id' => 'ForeignKey',
      'type'            => 'Text',
      'message'         => 'Text',
      'instructions'    => 'Text',
      'min_value'       => 'Number',
      'max_value'       => 'Number',
      'chief_notify'    => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
