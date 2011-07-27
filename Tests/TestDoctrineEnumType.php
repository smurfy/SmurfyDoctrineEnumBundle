<?php

/*
 * This file is part of the DoctrineEnumBundle package.
 *
 * (c) smurfy <https://github.com/smurfy>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Smurfy\DoctrineEnumBundle\Tests;

use Smurfy\DoctrineEnumBundle\DBAL\Types\DoctrineEnumTypeAbstract;

/**
 * TestDoctrineEnumType
 */
class TestDoctrineEnumType extends DoctrineEnumTypeAbstract
{
    protected $type = 'TestDoctrineEnumType';
    const TEST_ONE = 'one';
    const TEST_TWO = 'two';
    const TEST_THREE = 'three';
    
    /**
     * Gets all possible choices
     * 
     * @return array
     */
    public static function getChoices()
    {
        $array = array(self::TEST_ONE, self::TEST_TWO, self::TEST_THREE);
        return array_combine($array, $array);
    }
}
