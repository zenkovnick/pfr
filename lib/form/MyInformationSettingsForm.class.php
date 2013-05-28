<?php

class MyInformationSettingsForm extends sfGuardUserForm {

    public function  configure() {
        $this->useFields(array(
            'first_name', 'username', 'photo'
        ));

        $this->widgetSchema['photo'] = new sfWidgetFormInputFile();
        $this->validatorSchema['photo'] = new sfValidatorString(array('required' => false));

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

        if($this->getValue('uploaded_photo') != '')
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