<?php
class UserPasswordValidator extends sfValidatorBase
{
    public function configure($options = array(), $messages = array())
    {
        $this->addOption('username', '');
        $this->addOption('password_field', 'password');
        $this->addOption('throw_global_error', false);

        $this->setMessage('invalid', 'The username and/or password is invalid.');
    }

    protected function doClean($values)
    {
        $username = $this->getOption('username');
        $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';
        // don't allow to sign in with an empty username
        if ($username)
        {
            $user = $this->getTable()->retrieveByUsername($username);
            // user exists?
            if($user)
            {
                // password is ok?
                if ($user->getIsActive() && $user->checkPassword($password))
                {
                    return array_merge($values, array('user' => $user));
                }
            }
        }

        if ($this->getOption('throw_global_error'))
        {
            throw new sfValidatorError($this, 'invalid');
        }

        throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
    }

    protected function getTable()
    {
        return Doctrine::getTable('sfGuardUser');
    }
}
