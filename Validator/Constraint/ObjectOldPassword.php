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

use \BasePeer;
use \DateTime;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validator for changing passwords saved in a database
 *
 * @author  Yan Barreta
*/

class ObjectOldPasswordValidator extends ConstraintValidator
{
    public function validate($object, Constraint $constraint)
    {
    	$passwordField = $constraint->passwordField;
    	$encryption = $constraint->encryption;

        $class = get_class($object);
        $peerClass = $class . 'Peer';
        $queryClass = $class . 'Query';

    	$query = $queryClass::create()
    		->filterById($object->getId());
    		
		$query->filterBy(
            $peerClass::translateFieldName($passwordField, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME),
            $this->getEncryptedValue($object->getByName($passwordField, BasePeer::TYPE_FIELDNAME), $constraint)
        );

		$count = $query->count();
        
        if ($count == 0) {
        	$this->context->addViolationAt($passwordField, $constraint->message);
        }
    }

    /**
	* @todo Add more encryption types
	**/
    private function getEncryptedValue($password, Constraint $constraint)
    {
    	if ($constraint->encryption == 'sha256') {
    		return hash('sha256', $password);
    	}
    }
}