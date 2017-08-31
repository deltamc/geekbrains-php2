<?php

class testSample extends PHPUnit_Framework_TestCase
{
    public function test_firstTest()
    {
        $a = true;
        $this->assertTrue($a);
    }

    protected function getNumber($a) {
        if ($a < 0) {
            $a *= -1;
        }
        return $a;
    }

    public function test_testNumbers()
    {
        $this->assertGreaterThanOrEqual(0, $this->getNumber(-43));
    }
}