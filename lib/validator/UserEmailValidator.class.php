<?php
class UserEmailValidator extends sfValidatorBase
{
    public function configure($options = array(), $messages = array())
    {
        $this->addOption('email_field', 'username');
        $this->addOption('throw_global_error', false);

        $this->setMessage('invalid', 'No such email in database.');
    }

    protected function doClean($values)
    {
        $email = isset($values[$this->getOption('email_field')]) ? $values[$this->getOption('email_field')] : '';

        // don't allow to sign in with an empty username
        if ($email)
        {
            $user = $this->getTable()->findOneBy('username', $email);
            // user exists?
            if($user)
            {
                return $values;
            }
        }

        if ($this->getOption('throw_global_error'))
        {
            throw new sfValidatorError($this, 'invalid');
        }

        throw new sfValidatorErrorSchema($this, array($this->getOption('email_field') => new sfValidatorError($this, 'invalid')));
    }

    protected function getTable()
    {
        return Doctrine::getTable('sfGuardUser');
    }
}
