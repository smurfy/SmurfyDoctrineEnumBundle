<?php

/*
 * This file is part of the DoctrineEnumBundle package.
 *
 * (c) smurfy <https://github.com/smurfy>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Smurfy\DoctrineEnumBundle\Validator;

use Symfony\Component\Validator\Constraints\ChoiceValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * Doctrine Enum Type Validator
 */
class DoctrineEnumTypeValidator extends ChoiceValidator
{
    /**
     * Checks if the value is valid
     * 
     * @param string     $value      Value to validate
     * @param Constraint $constraint The Constraint executing this Validator
     * 
     * @return boolean
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint->entity) {
            throw new ConstraintDefinitionException('Entity not specified');
        }

        $entity = $constraint->entity;
        $constraint->choices = $entity::getChoices();
        return parent::validate($value, $constraint);
    }
}
