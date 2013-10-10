<?php

/**
 * UserAccount filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserAccountFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_manager'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'role'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'pic' => 'pic', 'sic' => 'sic', 'both' => 'both'))),
      'position'     => new sfWidgetFormFilterInput(),
      'invite_token' => new sfWidgetFormFilterInput(),
      'is_active'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'is_manager'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'role'         => new sfValidatorChoice(array('required' => false, 'choices' => array('pic' => 'pic', 'sic' => 'sic', 'both' => 'both'))),
      'position'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invite_token' => new sfValidatorPass(array('required' => false)),
      'is_active'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_account_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserAccount';
  }

  public function getFields()
  {
    return array(
      'account_id'   => 'Number',
      'user_id'      => 'Number',
      'is_manager'   => 'Boolean',
      'role'         => 'Enum',
      'position'     => 'Number',
      'invite_token' => 'Text',
      'is_active'    => 'Boolean',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
