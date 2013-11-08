<?php

/**
 * BasesfGuardRequestForgotPasswordForm for requesting a forgot password email
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardRequestForgotPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class ForgotPasswordForm extends BaseForm
{
    public function setup()
    {
        $this->widgetSchema['username'] = new sfWidgetFormInput();
        $this->validatorSchema['username'] = new sfValidatorString();

        $this->widgetSchema->setNameFormat('forgot_password[%s]');
    }

    public function isValid()
    {
        $valid = parent::isValid();
        if ($valid)
        {
            $values = $this->getValues();
            $this->user = Doctrine_Core::getTable('sfGuardUser')
                ->createQuery('u')
                ->where('u.username = ?', $values['username'])
                ->fetchOne();

            if ($this->user)
            {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}