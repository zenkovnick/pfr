<?php

/**
 * Account form.
 *
 * @package    blueprint
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AccountForm extends BaseAccountForm
{
  public function configure()
  {
      $this->useFields(array(
          'title', 'photo', 'chief_pilot_email'
      ));

      $this->widgetSchema['photo'] = new sfWidgetFormInputFile();
      $this->validatorSchema['photo'] = new sfValidatorString(array('required' => false));

      $this->widgetSchema['uploaded_photo'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['uploaded_photo'] = new sfValidatorPass();


  }

    protected function doSave($con = null)
    {
        if($this->getObject()->isNew() && $this->getValue('uploaded_photo') != '')
        {
            $reset_avatar = true;
        }
        parent::doSave($con);

        if($reset_avatar)
        {
            $this->getObject()->setPhoto($this->getValue('uploaded_photo'));
            $this->getObject()->save();
        }
        else
        {
            $this->getObject()->setPhoto(null);
            $this->getObject()->save();
        }
    }
}