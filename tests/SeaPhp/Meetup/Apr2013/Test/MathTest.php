<?php

namespace SeaPhp\Meetup\Apr2013\Test;

use SeaPhp\Meetup\Apr2013\Math;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public function dataForInvalidCheckTest()
    {
        return array(
            array(-1),
            array('foo'),
            array(null),
            array(new \stdClass),
        );
    }

    /**
     * @dataProvider dataForInvalidCheckTest
     * @expectedException \InvalidArgumentException
     */
    public function testThrowsExceptionOnInvalidInput($input)
    {
        Math::factorial($input);
    }

    public function dataForFactorialEvaluations()
    {
        return array(
            array(0, 1),
            array(1, 1),
            array(3, 6),
            array(5, 120),
        );
    }

    /**
     * @dataProvider dataForFactorialEvaluations
     */
    public function testCanEvaluateFactorial($input, $expectedOutput)
    {
        $this->assertEquals($expectedOutput, Math::factorial($input));
    }


}
