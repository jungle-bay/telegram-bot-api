<?php

namespace TelegramBotAPI\Tests\Supports\Validator;


use ReflectionClass;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_Error_Warning;
use TelegramBotAPI\Supports\Validator;

class ValidatorTest extends TestCase {

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testCheckLimit() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkLimit');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, 300);

        $this->assertEquals(Validator::LIMIT_MAX, $res);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testCheckLocal() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkLocal');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, 50);

        $this->assertEquals(Validator::LOCATION_MIN, $res);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testCheckCaptionLimit() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkCaptionLimit');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, null);

        $this->assertNull($res);
    }

    public function testCheckKeyboardTypeNull() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkKeyboardType');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, null);

        $this->assertNull($res);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testCheckActionType() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkActionType');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, null);

        $this->assertNull($res);
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testCheckParseModeType() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkParseModeType');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, 'asdsa');

        $this->assertNull($res);
    }

    public function testCheckValue() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkValue');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, array(), 'roma', 'bla');

        $this->assertNull($res);
    }

    public function testCheckObj() {

        $class = new ReflectionClass(Validator::class);
        $method = $class->getMethod('checkObj');
        $method->setAccessible(true);
        $obj = new Validator();

        $res = $method->invoke($obj, array(
            'roma' => 'roma'
        ), 'roma', array(
            'type'     => 'bla',
            'required' => Validator::CHECK_NO_REQUIRED
        ));

        $this->assertEquals('roma', $res);
    }
}
