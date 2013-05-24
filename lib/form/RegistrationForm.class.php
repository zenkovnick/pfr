<?php
/**
 * Created by JetBrains PhpStorm.
 * User: zenkovnick
 * Date: 24.05.13
 * Time: 12:24
 * To change this template use File | Settings | File Templates.
 */

class RegistrationForm extends sfGuardRegisterForm {
    public function configure(){
        $this->useFields(array(
            'name', 'username', 'password'
        ));

        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();

        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['username'] = new sfValidatorEmail(array('required' => true));
        $this->validatorSchema['password'] = new sfValidatorPass(array('required' => true));

    }

}
