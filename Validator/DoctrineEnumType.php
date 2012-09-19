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

use Symfony\Component\Validator\Constraints\Choice;

/**
 * Doctrine Enum Type Constraint
 * @Annotation
 */
class DoctrineEnumType extends Choice
{
    public $entity;

    /**
     * Gets the required Options
     * 
     * @return array
     */
    public function requiredOptions()
    {
        return array('entity');
    }

    /**
     * Gets the Default Options
     * 
     * @return string
     */
    public function getDefaultOption()
    {
        return 'choices';
    }
}
