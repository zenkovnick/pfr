<?php

class PilotForm extends sfGuardUserForm {

    private $roles = array('pic' => "PIC", 'sic' => "SIC", 'both' => 'PIC and SIC');
    public function  configure() {
        $this->useFields(array(
            'first_name', 'username'
        ));
        $this->validatorSchema['first_name'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['username'] = new sfValidatorEmail(array('required' => true));
        $this->validatorSchema->setPostValidator(new sfValidatorPass());
        $this->setWidget('can_manage', new sfWidgetFormInputCheckbox());
        $this->setValidator('can_manage', new sfValidatorBoolean());

        $this->setWidget('role', new sfWidgetFormChoice(array('expanded' => true, 'multiple' => false, 'choices' => $this->roles, 'default' => 'pic')));
        $this->setValidator('role', new sfValidatorChoice(array('choices' => array_keys($this->roles))));
        $this->widgetSchema->setLabels(array(
            'can_manage' => 'Allow pilot to manage account settings',
        ));
        $this->disableCSRFProtection();
    }
}