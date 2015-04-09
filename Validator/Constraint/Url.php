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
 * Overrides/wrap Symfony's built-in url constraint validator, accepting urls(domain) without protocols.
 *
 * @author  Yan Barreta
*/
class Url extends Constraint
{
    public $message = 'This value is not a valid URL.';
    public $protocols = array('http', 'https');
}