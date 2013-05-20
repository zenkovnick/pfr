<?php

/**
 * RiskBuilder filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRiskBuilderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'form_name'                         => new sfWidgetFormFilterInput(),
      'form_instructions'                 => new sfWidgetFormFilterInput(),
      'mitigation_low_message'            => new sfWidgetFormFilterInput(),
      'mitigation_low_instructions'       => new sfWidgetFormFilterInput(),
      'mitigation_low_min'                => new sfWidgetFormFilterInput(),
      'mitigation_low_max'                => new sfWidgetFormFilterInput(),
      'mitigation_low_notify'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mitigation_medium_message'         => new sfWidgetFormFilterInput(),
      'mitigation_medium_instructions'    => new sfWidgetFormFilterInput(),
      'mitigation_medium_min'             => new sfWidgetFormFilterInput(),
      'mitigation_medium_max'             => new sfWidgetFormFilterInput(),
      'mitigation_medium_notify'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mitigation_medium_require_details' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mitigation_high_message'           => new sfWidgetFormFilterInput(),
      'mitigation_high_instructions'      => new sfWidgetFormFilterInput(),
      'mitigation_high_min'               => new sfWidgetFormFilterInput(),
      'mitigation_high_max'               => new sfWidgetFormFilterInput(),
      'mitigation_high_notify'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'mitigation_high_prevent_flight'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'                        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'form_name'                         => new sfValidatorPass(array('required' => false)),
      'form_instructions'                 => new sfValidatorPass(array('required' => false)),
      'mitigation_low_message'            => new sfValidatorPass(array('required' => false)),
      'mitigation_low_instructions'       => new sfValidatorPass(array('required' => false)),
      'mitigation_low_min'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mitigation_low_max'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mitigation_low_notify'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mitigation_medium_message'         => new sfValidatorPass(array('required' => false)),
      'mitigation_medium_instructions'    => new sfValidatorPass(array('required' => false)),
      'mitigation_medium_min'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mitigation_medium_max'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mitigation_medium_notify'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mitigation_medium_require_details' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mitigation_high_message'           => new sfValidatorPass(array('required' => false)),
      'mitigation_high_instructions'      => new sfValidatorPass(array('required' => false)),
      'mitigation_high_min'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mitigation_high_max'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mitigation_high_notify'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'mitigation_high_prevent_flight'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'                        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('risk_builder_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RiskBuilder';
  }

  public function getFields()
  {
    return array(
      'id'                                => 'Number',
      'form_name'                         => 'Text',
      'form_instructions'                 => 'Text',
      'mitigation_low_message'            => 'Text',
      'mitigation_low_instructions'       => 'Text',
      'mitigation_low_min'                => 'Number',
      'mitigation_low_max'                => 'Number',
      'mitigation_low_notify'             => 'Boolean',
      'mitigation_medium_message'         => 'Text',
      'mitigation_medium_instructions'    => 'Text',
      'mitigation_medium_min'             => 'Number',
      'mitigation_medium_max'             => 'Number',
      'mitigation_medium_notify'          => 'Boolean',
      'mitigation_medium_require_details' => 'Boolean',
      'mitigation_high_message'           => 'Text',
      'mitigation_high_instructions'      => 'Text',
      'mitigation_high_min'               => 'Number',
      'mitigation_high_max'               => 'Number',
      'mitigation_high_notify'            => 'Boolean',
      'mitigation_high_prevent_flight'    => 'Boolean',
      'created_at'                        => 'Date',
      'updated_at'                        => 'Date',
    );
  }
}
