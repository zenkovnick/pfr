<?php

class MyInformationSettingsForm extends sfGuardUserForm {

    public function  configure() {
        $this->useFields(array(
            'name', 'username', 'photo'
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