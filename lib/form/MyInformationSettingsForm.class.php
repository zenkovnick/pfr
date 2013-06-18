<?php

class MyInformationSettingsForm extends sfGuardUserForm {

    public function  configure() {
        $this->useFields(array(
            'first_name', 'username', 'photo'
        ));
        $this->widgetSchema['photo'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['photo'] = new sfValidatorPass();

        $this->widgetSchema['photo_widget'] = new sfWidgetFormInputFile();
        $this->validatorSchema['photo_widget'] = new sfValidatorString(array('required' => false));


        $this->validatorSchema['first_name'] = new sfValidatorString(array('required' => true));

        $this->widgetSchema['uploaded_photo'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['uploaded_photo'] = new sfValidatorPass();

        $this->setWidget('new_password', new sfWidgetFormInputPassword());
        $this->setWidget('new_password_confirm', new sfWidgetFormInputPassword());

        $this->setValidator('new_password', new sfValidatorPass(array('required' => false)));
        $this->setValidator('new_password_confirm', new sfValidatorPass(array('required' => false)));

        $this->mergePostValidator(new sfValidatorSchemaCompare('new_password', sfValidatorSchemaCompare::EQUAL, 'new_password_confirm', array(), array('invalid' => "Passwords don't match")));

    }

    protected function doSave($con = null)
    {
        if($this->getValue('new_password') && $this->getValue('new_password_confirm')){
            $this->getObject()->setPassword($this->getValue('new_password'));
        }

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