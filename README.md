Provides a Enum Doctrine2 data type for your Symfony2 Project.

Features
========

- Working with doctrine:schema:update
- With Validators
- Works with Form
- Unit tests

Info
====

There is a known Bug with the doctrine:schema:update.
It always alter the field in the table, despite its already correct.

Implementation
==============

The new Type works like the Enum Type in Doctrine 1, for the database its just a varchar field, but inside your
code you use it like an enum. So it should work with all Doctrine 2 supported Databases, i tested only MySql.

Installation
============

Add SmurfyDoctrineEnumBundle to your vendor/bundles/ dir
---------------------------------------------

Using the vendors script

Add the following lines in your ``deps`` file::

    [SmurfyDoctrineEnumBundle]
        git=git://github.com/smurfy/SmurfyDoctrineEnumBundle.git
        target=bundles/Smurfy/DoctrineEnumBundle

Run the vendors script::

    ./bin/vendors install

Using submodules

    $ git submodule add git://github.com/smurfy/SmurfyDoctrineEnumBundle.git vendor/bundles//Smurfy/DoctrineEnumBundle

Add the Smurfy namespace to your autoloader
----------------------------------------

    // app/autoload.php
    $loader->registerNamespaces(array(
        'Smurfy' => __DIR__.'/../vendor/bundles',
        // your other namespaces
    );

Add UserBundle to your application kernel
-----------------------------------------

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            // ...
            new Smurfy\DoctrineEnumBundle\SmurfyDoctrineEnumBundle(),
            // ...
        );
    }

Usage
=====

Create your own class, lets say for salutation

    use Smurfy\DoctrineEnumBundle\DBAL\Types\DoctrineEnumTypeAbstract;

    class SalutationType extends DoctrineEnumTypeAbstract
    {
        protected $type = 'SalutationType';
        const SALUTATION_MR = 'mr';
        const SALUTATION_MS = 'ms';
        const SALUTATION_COMPANY = 'company';

        public static function getChoices()
        {
            $array = array(self::SALUTATION_MR, self::SALUTATION_MS, self::SALUTATION_COMPANY);
            return array_combine($array, $array);
        }
    }

Thats it.

You now can use the type (and its validator) inside your other Entities.

    use Smurfy\DoctrineEnumBundle\Validator as EnumAssert;
    ...
    /**
     * @ORM\Column(type="SalutationType")
     * @EnumAssert\DoctrineEnumType(
     *    entity="Namespace\YourOwnBundle\Entity\SalutationType"
     * )
     * @var string
     */
    protected $salutation;
    ...

You now can set values in you Entity.

    $entity->setSalutation(SalutationType::SALUTATION_MR);

If you try setting it to something else and you validate the Entity, an error will be raised.

You also can use it in your forms

    $builder->add('salutation', 'choice', array('choices' => SalutationType::getChoices()));
