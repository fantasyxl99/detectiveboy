<?php
namespace app\demo\controller\one;

use think\Controller;

class Blog extends Controller
{
    public function index()
    {
        return 111;
    }

    public function add()
    {
        return $this->fetch();
    }

    public function edit($id)
    {
        return $this->fetch();
    }
}

