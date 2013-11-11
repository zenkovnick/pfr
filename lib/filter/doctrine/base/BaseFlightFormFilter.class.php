<?php

/**
 * Flight filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFlightFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => true)),
      'plane_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plane'), 'add_empty' => true)),
      'pic_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PIC'), 'add_empty' => true)),
      'sic_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SIC'), 'add_empty' => true)),
      'sic_custom'       => new sfWidgetFormFilterInput(),
      'trip_number'      => new sfWidgetFormFilterInput(),
      'airport_from_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AirportFrom'), 'add_empty' => true)),
      'airport_to_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AirportTo'), 'add_empty' => true)),
      'departure_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'risk_factor_sum'  => new sfWidgetFormFilterInput(),
      'risk_factor_type' => new sfWidgetFormChoice(array('choices' => array('' => '', 'low' => 'low', 'medium' => 'medium', 'high' => 'high'))),
      'mitigation_sum'   => new sfWidgetFormFilterInput(),
      'info'             => new sfWidgetFormFilterInput(),
      'drafted'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'           => new sfWidgetFormChoice(array('choices' => array('' => '', 'new' => 'new', 'assess' => 'assess', 'complete' => 'complete'))),
      'time_str'         => new sfWidgetFormFilterInput(),
      'mitigation_note'  => new sfWidgetFormFilterInput(),
      'flight_note'      => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'account_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Account'), 'column' => 'id')),
      'plane_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plane'), 'column' => 'id')),
      'pic_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PIC'), 'column' => 'id')),
      'sic_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SIC'), 'column' => 'id')),
      'sic_custom'       => new sfValidatorPass(array('required' => false)),
      'trip_number'      => new sfValidatorPass(array('required' => false)),
      'airport_from_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AirportFrom'), 'column' => 'id')),
      'airport_to_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AirportTo'), 'column' => 'id')),
      'departure_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'risk_factor_sum'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'risk_factor_type' => new sfValidatorChoice(array('required' => false, 'choices' => array('low' => 'low', 'medium' => 'medium', 'high' => 'high'))),
      'mitigation_sum'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'info'             => new sfValidatorPass(array('required' => false)),
      'drafted'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'           => new sfValidatorChoice(array('required' => false, 'choices' => array('new' => 'new', 'assess' => 'assess', 'complete' => 'complete'))),
      'time_str'         => new sfValidatorPass(array('required' => false)),
      'mitigation_note'  => new sfValidatorPass(array('required' => false)),
      'flight_note'      => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('flight_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Flight';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'account_id'       => 'ForeignKey',
      'plane_id'         => 'ForeignKey',
      'pic_id'           => 'ForeignKey',
      'sic_id'           => 'ForeignKey',
      'sic_custom'       => 'Text',
      'trip_number'      => 'Text',
      'airport_from_id'  => 'ForeignKey',
      'airport_to_id'    => 'ForeignKey',
      'departure_date'   => 'Date',
      'risk_factor_sum'  => 'Number',
      'risk_factor_type' => 'Enum',
      'mitigation_sum'   => 'Number',
      'info'             => 'Text',
      'drafted'          => 'Boolean',
      'status'           => 'Enum',
      'time_str'         => 'Text',
      'mitigation_note'  => 'Text',
      'flight_note'      => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
