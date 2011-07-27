<?php

/*
 * This file is part of the DoctrineEnumBundle package.
 *
 * (c) smurfy <https://github.com/smurfy>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Smurfy\DoctrineEnumBundle\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * DoctrineEnumTypeAbstract
 */
abstract class DoctrineEnumTypeAbstract extends Type
{
     protected $type = 'DoctrineEnumTypeAbstract';

    /**
     * Returns the SQL Declaration
     * 
     * @param array            $fieldDeclaration Array of the FieldDeclaration
     * @param AbstractPlatform $platform         Platform (mysql, oracle...)
     * 
     * @return string
     */
    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * Converts the value to a PHP supported datatype
     * 
     * @param mixed            $value    The Value
     * @param AbstractPlatform $platform Platform (mysql, orcale...)
     * 
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    /**
     * Will be called before persisting to the database
     * Checks if value is correct
     * 
     * @param string           $value    The Value
     * @param AbstractPlatform $platform Platform (mysql, orcale...)
     * 
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, $this->getChoices())) {
            throw new \InvalidArgumentException("Invalid value for Enum");
        }
        return $value;
    }

    /**
     * Gets the name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->type;
    }
    
    /**
     * Gets all possible choices
     * 
     * @return array
     */
    public static function getChoices()
    {
        //$array = array();
        //return array_combine($array, $array);
        return array();
    }
}
