<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorInteger validates an integer. It also converts the input value to an integer.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorInteger.class.php 22018 2009-09-14 16:56:28Z fabien $
 */
class sfValidatorZip extends sfValidatorInteger
{
    /**
     * Configures the current validator.
     *
     * Available options:
     *
     *  * max: The maximum value allowed
     *  * min: The minimum value allowed
     *
     * Available error codes:
     *
     *  * max
     *  * min
     *
     * @param array $options   An array of options
     * @param array $messages  An array of error messages
     *
     * @see sfValidatorBase
     */
    protected function configure($options = array(), $messages = array())
    {
        $this->setMessage('invalid', '"%value%" is not valid zip code.');
    }

    /**
     * @see sfValidatorBase
     */
    protected function doClean($value)
    {
        parent::doClean($value);
        $clean = intval($value);

        if (!preg_match('/[0-9]{5}/', $value))
        {
            throw new sfValidatorError($this, 'invalid', array('value' => $value));
        }

        return $clean;
    }
}
