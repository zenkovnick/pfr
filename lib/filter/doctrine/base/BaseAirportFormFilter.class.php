<?php

/**
 * Airport filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAirportFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormFilterInput(),
      'city'      => new sfWidgetFormFilterInput(),
      'country'   => new sfWidgetFormFilterInput(),
      'IATA_FAA'  => new sfWidgetFormFilterInput(),
      'ICAO'      => new sfWidgetFormFilterInput(),
      'latitude'  => new sfWidgetFormFilterInput(),
      'longitude' => new sfWidgetFormFilterInput(),
      'altitude'  => new sfWidgetFormFilterInput(),
      'timezone'  => new sfWidgetFormFilterInput(),
      'DST'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'E' => 'E', 'A' => 'A', 'S' => 'S', 'O' => 'O', 'Z' => 'Z', 'N' => 'N', 'U' => 'U'))),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorPass(array('required' => false)),
      'city'      => new sfValidatorPass(array('required' => false)),
      'country'   => new sfValidatorPass(array('required' => false)),
      'IATA_FAA'  => new sfValidatorPass(array('required' => false)),
      'ICAO'      => new sfValidatorPass(array('required' => false)),
      'latitude'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitude' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'altitude'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'timezone'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'DST'       => new sfValidatorChoice(array('required' => false, 'choices' => array('E' => 'E', 'A' => 'A', 'S' => 'S', 'O' => 'O', 'Z' => 'Z', 'N' => 'N', 'U' => 'U'))),
    ));

    $this->widgetSchema->setNameFormat('airport_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Airport';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'name'      => 'Text',
      'city'      => 'Text',
      'country'   => 'Text',
      'IATA_FAA'  => 'Text',
      'ICAO'      => 'Text',
      'latitude'  => 'Number',
      'longitude' => 'Number',
      'altitude'  => 'Number',
      'timezone'  => 'Number',
      'DST'       => 'Enum',
    );
  }
}
