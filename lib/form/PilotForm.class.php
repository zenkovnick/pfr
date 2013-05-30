<?php

class PilotForm extends sfGuardUserForm {

    public function  configure() {
        $this->useFields(array(
            'first_name', 'username'
        ));

    }
}