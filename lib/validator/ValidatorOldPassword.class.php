<?php
/**
 * Created by JetBrains PhpStorm.
 * User: chaosin
 * Date: 02.10.12
 * Time: 9:25
 * To change this template use File | Settings | File Templates.
 */
class ValidatorOldPassword extends sfValidatorSchema
{
    public function __construct($newpass, $oldpass, $options = array(), $messages = array())
    {
        $this->addOption('newpass', $newpass);
        $this->addOption('oldpass', $oldpass);

        $this->addOption('throw_global_error', false);

        parent::__construct(null, $options, $messages);
    }

    /**
     * @see sfValidatorBase
     */
    protected function doClean($values)
    {
        if (is_null($values))
        {
            $values = array();
        }

        if (!is_array($values))
        {
            throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
        }

        $newpass = isset($values[$this->getOption('newpass')]) ? $values[$this->getOption('newpass')] : null;
        $oldpass = isset($values[$this->getOption('oldpass')]) ? $values[$this->getOption('oldpass')] : null;

        $valid = false;

        if( $newpass != '' && $newpass != null)
        {
            if ($oldpass != null && $oldpass != '')
            {
                $user = sfContext::getInstance()->getUser()->getGuardUser();
                if (!$user->checkPassword($oldpass))
                {
                    $error = new sfValidatorError($this, 'Invalid password', array('oldpass'  => $oldpass));

                    if ($this->getOption('throw_global_error'))
                    {
                        throw $error;
                    }

                    throw new sfValidatorErrorSchema($this, array($this->getOption('oldpass') => $error));
                }
            }
            else
            {
                $error = new sfValidatorError($this, 'Required', array('oldpass'  => $oldpass));

                if ($this->getOption('throw_global_error'))
                {
                    throw $error;
                }

                throw new sfValidatorErrorSchema($this, array($this->getOption('oldpass') => $error));
            }

        }
        return $values;
    }
}
