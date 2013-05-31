<?php

class PilotForm extends sfGuardUserForm {

    public function  configure() {
        $this->useFields(array(
            'first_name', 'username'
        ));
        $this->validatorSchema['first_name'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['username'] = new sfValidatorEmail(array('required' => true));

        $this->disableCSRFProtection();
    }
}