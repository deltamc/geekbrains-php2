<?php

trait Singleton
{
    protected static $instance;

    public static function getInstance()
    {
        if(static::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct() {}
    private function __clone(){}
    private function __wakeup(){}

}

class MySingleton {
    use Singleton;

}
