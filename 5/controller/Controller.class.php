<?php

class Controller
{
    public $view = 'index';
    public $title;

    function __construct()
    {
        $this->title = Config::get('sitename');
    }

    public function index($data) {
        return array();
    }
}