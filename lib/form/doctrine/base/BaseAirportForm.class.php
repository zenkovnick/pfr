<?php

/**
 * Airport form base class.
 *
 * @method Airport getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAirportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'city'      => new sfWidgetFormInputText(),
      'country'   => new sfWidgetFormInputText(),
      'IATA_FAA'  => new sfWidgetFormInputText(),
      'ICAO'      => new sfWidgetFormInputText(),
      'latitude'  => new sfWidgetFormInputText(),
      'longitude' => new sfWidgetFormInputText(),
      'altitude'  => new sfWidgetFormInputText(),
      'timezone'  => new sfWidgetFormInputText(),
      'DST'       => new sfWidgetFormChoice(array('choices' => array('E' => 'E', 'A' => 'A', 'S' => 'S', 'O' => 'O', 'Z' => 'Z', 'N' => 'N', 'U' => 'U'))),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'country'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'IATA_FAA'  => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'ICAO'      => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'latitude'  => new sfValidatorNumber(array('required' => false)),
      'longitude' => new sfValidatorNumber(array('required' => false)),
      'altitude'  => new sfValidatorInteger(array('required' => false)),
      'timezone'  => new sfValidatorInteger(array('required' => false)),
      'DST'       => new sfValidatorChoice(array('choices' => array(0 => 'E', 1 => 'A', 2 => 'S', 3 => 'O', 4 => 'Z', 5 => 'N', 6 => 'U'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('airport[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Airport';
  }

}
