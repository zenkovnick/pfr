<?php

/**
 * Account filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAccountFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'photo'             => new sfWidgetFormFilterInput(),
      'chief_pilot_email' => new sfWidgetFormFilterInput(),
      'chief_pilot_name'  => new sfWidgetFormFilterInput(),
      'managed_by_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Manager'), 'add_empty' => true)),
      'has_modified_form' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_plane'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_pilot'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_skipped_pilot' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'has_flight'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'planes_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plane')),
      'users_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'title'             => new sfValidatorPass(array('required' => false)),
      'photo'             => new sfValidatorPass(array('required' => false)),
      'chief_pilot_email' => new sfValidatorPass(array('required' => false)),
      'chief_pilot_name'  => new sfValidatorPass(array('required' => false)),
      'managed_by_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Manager'), 'column' => 'id')),
      'has_modified_form' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_plane'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_pilot'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_skipped_pilot' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'has_flight'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'planes_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plane', 'required' => false)),
      'users_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPlanesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.AccountPlane AccountPlane')
      ->andWhereIn('AccountPlane.account_id', $values)
    ;
  }

  public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.UserAccount UserAccount')
      ->andWhereIn('UserAccount.account_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Account';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'title'             => 'Text',
      'photo'             => 'Text',
      'chief_pilot_email' => 'Text',
      'chief_pilot_name'  => 'Text',
      'managed_by_id'     => 'ForeignKey',
      'has_modified_form' => 'Boolean',
      'has_plane'         => 'Boolean',
      'has_pilot'         => 'Boolean',
      'has_skipped_pilot' => 'Boolean',
      'has_flight'        => 'Boolean',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'planes_list'       => 'ManyKey',
      'users_list'        => 'ManyKey',
    );
  }
}
