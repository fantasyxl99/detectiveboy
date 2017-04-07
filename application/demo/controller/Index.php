<?php
namespace app\demo\controller;

//use \think\Request;
use \think\View;
use think\Controller;


class Index extends Controller
{
    public function Index(){
       // 模板变量赋值
        $this->assign('name','ThinkPHP');
        $this->assign('email','thinkphp@qq.com');
        // 或者批量赋值
        $this->assign([
            'name'  => 'ThinkPHP',
            'email' => 'thinkphp@qq.com'
        ]);
        // 模板输出
        
        return $this->fetch('index');
    }
    public function read()
    {
        $view = new View();
        return $view->fetch('admin@index');
        
    }

    public function archive($year='2016',$month='01')
    {
        return 'year='.$year.'&month='.$month;
    }
}
