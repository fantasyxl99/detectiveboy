<?php
namespace app\index\controller\one;

use think\Controller;

class Blog extends Controller
{
    public function index()
    {
        return $this->fetch();
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

