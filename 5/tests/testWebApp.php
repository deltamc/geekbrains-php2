<?php

class testWebApp extends PHPUnit_Framework_TestCase
{
    public function test_testWebApp()
    {
        $content = file_get_contents('http://localhost/index.php?page=admin');
        $this->assertTrue(strpos($content, '<!DOCTYPE html>') === 0);
    }
}