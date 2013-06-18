<?php

/**
 * Plane filter form base class.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlaneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tail_number'   => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'accounts_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Account')),
    ));

    $this->setValidators(array(
      'tail_number'   => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'accounts_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Account', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plane_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addAccountsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('AccountPlane.plane_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Plane';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'tail_number'   => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'accounts_list' => 'ManyKey',
    );
  }
}
