<?php

/**
 * Plane form base class.
 *
 * @method Plane getObject() Returns the current form's model object
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlaneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'tail_number'   => new sfWidgetFormInputText(),
      'position'      => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'accounts_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Account')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tail_number'   => new sfValidatorInteger(array('required' => false)),
      'position'      => new sfValidatorInteger(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'accounts_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Account', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plane[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plane';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['accounts_list']))
    {
      $this->setDefault('accounts_list', $this->object->Accounts->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveAccountsList($con);

    parent::doSave($con);
  }

  public function saveAccountsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['accounts_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Accounts->getPrimaryKeys();
    $values = $this->getValue('accounts_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Accounts', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Accounts', array_values($link));
    }
  }

}
