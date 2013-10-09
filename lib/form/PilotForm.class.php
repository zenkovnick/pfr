<?php

class PilotForm extends sfGuardUserForm {

    public function  configure() {
        $this->useFields(array(
            'first_name', 'username'
        ));
        $this->validatorSchema['first_name'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['username'] = new sfValidatorEmail(array('required' => true));
        $this->validatorSchema->setPostValidator(new sfValidatorPass());
        $this->setWidget('can_manage', new sfWidgetFormInputCheckbox());
        $this->setValidator('can_manage', new sfValidatorBoolean());
        $this->setWidget('is_pic', new sfWidgetFormInputCheckbox());
        $this->setValidator('is_pic', new sfValidatorBoolean());
        $this->setWidget('is_sic', new sfWidgetFormInputCheckbox());
        $this->setValidator('is_sic', new sfValidatorBoolean());

        $this->widgetSchema->setLabels(array(
            'can_manage' => 'Allow pilot to manage account settings',
            'is_pic' => 'PIC',
            'is_sic' => 'SIC'
        ));
        $this->disableCSRFProtection();
    }
}