<?php

/**
 * Account form base class.
 *
 * @method Account getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAccountForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'title'             => new sfWidgetFormInputText(),
      'photo'             => new sfWidgetFormInputText(),
      'managed_by_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Manager'), 'add_empty' => true)),
      'chief_pilot_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ChiefPilot'), 'add_empty' => true)),
      'has_modified_form' => new sfWidgetFormInputCheckbox(),
      'has_plane'         => new sfWidgetFormInputCheckbox(),
      'has_pilot'         => new sfWidgetFormInputCheckbox(),
      'has_skipped_pilot' => new sfWidgetFormInputCheckbox(),
      'has_flight'        => new sfWidgetFormInputCheckbox(),
      'is_active'         => new sfWidgetFormInputCheckbox(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'planes_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plane')),
      'users_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'             => new sfValidatorPass(),
      'photo'             => new sfValidatorPass(array('required' => false)),
      'managed_by_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Manager'), 'required' => false)),
      'chief_pilot_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ChiefPilot'), 'required' => false)),
      'has_modified_form' => new sfValidatorBoolean(array('required' => false)),
      'has_plane'         => new sfValidatorBoolean(array('required' => false)),
      'has_pilot'         => new sfValidatorBoolean(array('required' => false)),
      'has_skipped_pilot' => new sfValidatorBoolean(array('required' => false)),
      'has_flight'        => new sfValidatorBoolean(array('required' => false)),
      'is_active'         => new sfValidatorBoolean(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'planes_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plane', 'required' => false)),
      'users_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['planes_list']))
    {
      $this->setDefault('planes_list', $this->object->Planes->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['users_list']))
    {
      $this->setDefault('users_list', $this->object->Users->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePlanesList($con);
    $this->saveUsersList($con);

    parent::doSave($con);
  }

  public function savePlanesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['planes_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Planes->getPrimaryKeys();
    $values = $this->getValue('planes_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Planes', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Planes', array_values($link));
    }
  }

  public function saveUsersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['users_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Users->getPrimaryKeys();
    $values = $this->getValue('users_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Users', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Users', array_values($link));
    }
  }

}
