<?php
class homeComponents extends sfComponents
{


    public function executeSignin_form()
    {
        $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
        $this->form = new $class();
    }
}