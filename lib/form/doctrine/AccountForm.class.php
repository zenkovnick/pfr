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
          'title', 'photo', 'chief_pilot_name', 'chief_pilot_email'
      ));

      $this->widgetSchema['photo'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['photo'] = new sfValidatorPass();

      $this->widgetSchema['photo_widget'] = new sfWidgetFormInputFile();
      $this->validatorSchema['photo_widget'] = new sfValidatorString(array('required' => false));

      $this->widgetSchema['uploaded_photo'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['uploaded_photo'] = new sfValidatorPass();


  }

    protected function doSave($con = null)
    {

        parent::doSave($con);

        if($this->getValue('uploaded_photo') != ''){
            if($this->getObject()->getPhoto()){
                unlink(sfConfig::get('sf_upload_dir')."/avatar/{$this->getObject()->getPhoto()}");
            }
            $this->getObject()->setPhoto($this->getValue('uploaded_photo'));
            $this->getObject()->save();

        }
    }
}
