<?php

/**
 * AccountPlane form base class.
 *
 * @method AccountPlane getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountPlaneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id' => new sfWidgetFormInputHidden(),
      'plane_id'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'account_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('account_id')), 'empty_value' => $this->getObject()->get('account_id'), 'required' => false)),
      'plane_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('plane_id')), 'empty_value' => $this->getObject()->get('plane_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_plane[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountPlane';
  }

}
