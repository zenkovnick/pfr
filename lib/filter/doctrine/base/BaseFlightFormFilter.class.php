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
      'account_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Account'), 'add_empty' => true)),
      'plane_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plane'), 'add_empty' => true)),
      'pic_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PIC'), 'add_empty' => true)),
      'sic_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SIC'), 'add_empty' => true)),
      'trip_number'     => new sfWidgetFormFilterInput(),
      'airport_from'    => new sfWidgetFormFilterInput(),
      'airport_to'      => new sfWidgetFormFilterInput(),
      'departure_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'risk_factor_sum' => new sfWidgetFormFilterInput(),
      'mitigation_sum'  => new sfWidgetFormFilterInput(),
      'info'            => new sfWidgetFormFilterInput(),
      'drafted'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'status'          => new sfWidgetFormChoice(array('choices' => array('' => '', 'new' => 'new', 'assess' => 'assess', 'complete' => 'complete'))),
    ));

    $this->setValidators(array(
      'account_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Account'), 'column' => 'id')),
      'plane_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Plane'), 'column' => 'id')),
      'pic_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PIC'), 'column' => 'id')),
      'sic_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SIC'), 'column' => 'id')),
      'trip_number'     => new sfValidatorPass(array('required' => false)),
      'airport_from'    => new sfValidatorPass(array('required' => false)),
      'airport_to'      => new sfValidatorPass(array('required' => false)),
      'departure_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'risk_factor_sum' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mitigation_sum'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'info'            => new sfValidatorPass(array('required' => false)),
      'drafted'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'status'          => new sfValidatorChoice(array('required' => false, 'choices' => array('new' => 'new', 'assess' => 'assess', 'complete' => 'complete'))),
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
      'id'              => 'Number',
      'account_id'      => 'ForeignKey',
      'plane_id'        => 'ForeignKey',
      'pic_id'          => 'ForeignKey',
      'sic_id'          => 'ForeignKey',
      'trip_number'     => 'Text',
      'airport_from'    => 'Text',
      'airport_to'      => 'Text',
      'departure_date'  => 'Date',
      'risk_factor_sum' => 'Number',
      'mitigation_sum'  => 'Number',
      'info'            => 'Text',
      'drafted'         => 'Boolean',
      'status'          => 'Enum',
    );
  }
}
