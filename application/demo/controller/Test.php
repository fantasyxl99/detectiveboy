<?php
namespace app\demo\controller;

class Test
{
    public function index()
    {
        return 'index';
    }

    public function hello($name)
    {
        return 'Hello,'.$name;
    }
}