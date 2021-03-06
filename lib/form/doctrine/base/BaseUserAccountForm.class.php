<?php

/**
 * UserAccount form base class.
 *
 * @method UserAccount getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserAccountForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'   => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormInputHidden(),
      'is_manager'   => new sfWidgetFormInputCheckbox(),
      'role'         => new sfWidgetFormChoice(array('choices' => array('pic' => 'pic', 'sic' => 'sic', 'both' => 'both'))),
      'position'     => new sfWidgetFormInputText(),
      'invite_token' => new sfWidgetFormInputText(),
      'is_active'    => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'account_id'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('account_id')), 'empty_value' => $this->getObject()->get('account_id'), 'required' => false)),
      'user_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'is_manager'   => new sfValidatorBoolean(array('required' => false)),
      'role'         => new sfValidatorChoice(array('choices' => array(0 => 'pic', 1 => 'sic', 2 => 'both'), 'required' => false)),
      'position'     => new sfValidatorInteger(array('required' => false)),
      'invite_token' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'    => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('user_account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserAccount';
  }

}
