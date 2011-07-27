<?php

/*
 * This file is part of the DoctrineEnumBundle package.
 *
 * (c) smurfy <https://github.com/smurfy>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Smurfy\DoctrineEnumBundle\Tests\Validation;

use Smurfy\DoctrineEnumBundle\Validator\DoctrineEnumTypeValidator;
use Smurfy\DoctrineEnumBundle\Validator\DoctrineEnumType;
use Smurfy\DoctrineEnumBundle\Tests\TestDoctrineEnumType;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

class DoctrineEnumTypeValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        $this->validator = new DoctrineEnumTypeValidator();
    }
    
    /**
     * @expectedException Symfony\Component\Validator\Exception\ConstraintDefinitionException
     */
    public function testExceptionEntityNotSpecified()
    {
        $constraint = new DoctrineEnumType();
        $this->validator->isValid(TestDoctrineEnumType::TEST_ONE, $constraint);
    }
    
    public function testValidType()
    {
        $constraint = new DoctrineEnumType(array('entity' => 'Smurfy\DoctrineEnumBundle\Tests\TestDoctrineEnumType'));
        $this->assertTrue($this->validator->isValid(TestDoctrineEnumType::TEST_ONE, $constraint));
    }
    
    public function testInvalidValidType()
    {
        $constraint = new DoctrineEnumType(array('entity' => 'Smurfy\DoctrineEnumBundle\Tests\TestDoctrineEnumType'));
        $this->assertFalse($this->validator->isValid('SOMETHINGELSE', $constraint));
    }
   
}
