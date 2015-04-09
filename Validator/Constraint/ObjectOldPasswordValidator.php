<?php

/*
 * This file is part of ValidatorBundle.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yan\Bundle\ValidatorBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Validator for changing passwords saved in a database
 *
 * @author  Yan Barreta
*/
class ObjectOldPassword extends Constraint
{
    public $message = 'Old password does not match any records';
    public $passwordField = 'password';
    public $encryption = 'sha256';

    /**
    * {@inheritDoc}
    */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getMessage(){
        return $this->message;
    }
}