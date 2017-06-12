<?php
/**
 * Created by PhpStorm.
 * User: jpd
 * Date: 12/06/17
 * Time: 22:21
 */

namespace test5;

use \Mockery as m;
use PHPUnit\Framework\TestCase;

class applicationTest extends TestCase
{
    /** @var \pspell_new|\Mockery\MockInterface */
    protected $dict;
    /** @var application */
    protected $object;

    protected function setUp()
    {
        $this->object = new application();
    }

    protected function tearDown()
    {
        m::close();
    }

    public function testCountWords()
    {
        $string = 'Hello World!';
        $this->object->countWords($string);
        $result = $this->object->getTopWords();
        $this->assertTrue(is_array($result));
        $this->assertEquals(count($result), 2, 'Should have two words in it');
        $this->assertArrayHasKey('Hello', $result);
        $this->assertArrayHasKey('World', $result);
        $this->assertEquals($result['Hello'], 1);
        $this->assertEquals($result['World'], 1);
    }

    public function testCountWordsNoWords()
    {
        $string = '!';
        $this->object->countWords($string);
        $result = $this->object->getTopWords();
        $this->assertTrue(is_array($result));
        $this->assertEquals(count($result), 0, 'Should have no words in it');
    }
}
