<?php
namespace app\demo\controller;

class Blog 
{
    public function index()
    {
        //$event = \think\Loader::controller('index/index', 'controller');
        echo action('Test/data','kkkkk','controller');
        //echo $event->index(); // 输出 update:5
    }

    public function add()
    {
        return 'add';
    }

    public function edit($id)
    {
        return 'edit:'.$id;
    }
}

