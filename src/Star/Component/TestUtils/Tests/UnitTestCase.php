<?php
/**
 * This file is part of the WarlordGame.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\TestUtils\Tests;

/**
 * Class UnitTestCase
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\TestUtils\Tests
 */
class UnitTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Assert that the $attribute has setter and getter for $object.
     *
     * @param string $attribute The attribute name
     * @param object $object    The object to assert
     * @param mixed  $value     The value to assert
     * @param mixed  $default   The default value for the getter method
     */
    protected function assertSetterGetter($attribute, $object, $value, $default = null)
    {
        $setter = "set" . ucfirst($attribute);
        $getter = "get" . ucfirst($attribute);
        $fullClassName = get_class($object);
        $aClass = explode('\\', $fullClassName);
        $class  = array_pop($aClass);

        $this->assertSame(
            $default,
            $object->{$getter}(),
            "The default value for {$class}::{$getter}() is not as expected."
        );

        $this->assertMethodExists($object, $setter);
        $this->assertSame($object, $object->{$setter}($value), "The {$class}::{$setter}() should return self.");

        $this->assertMethodExists($object, $getter);
        $this->assertSame($value, $object->{$getter}(), "The {$class}::{$getter}() should return the same value.");

        if (is_bool($value)) {
            $this->assertMethodExists($object, $attribute);
            $this->assertSame($value, $object->{$attribute}(), "The {$class}::{$attribute}() should be a boolean.");
        }
    }

    /**
     * Assert that the $method exists for $object
     *
     * @param object $object
     * @param string $method
     */
    protected function assertMethodExists($object, $method)
    {
        $class = get_class($object);
        $this->assertTrue(method_exists($object, $method), "The '{$method}' should exists for object: {$class}.");
    }

    /**
     * Assert that the $method do not exists for $object
     *
     * @param object $object
     * @param string $method
     */
    protected function assertMethodDoNotExists($object, $method)
    {
        $class = get_class($object);
        $this->assertFalse(method_exists($object, $method), "The '{$method}' should not exists for object: {$class}.");
    }
}
