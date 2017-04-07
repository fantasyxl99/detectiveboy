<?php
namespace app\index\controller;
use think\Db;
class Index extends \think\Controller
{
    public function index()
    {
        
        $list = Db::name('menu')->where('pid',0)->select();
        $list2 = Db::name('menu')->where('pid!=0')->select();
        // 模板变量赋值
        //$this->menu  =$list;
        $a = array(1,2,3,4,5);
        $this->assign('menu',$list);
        $this->assign('menu2',$list2);
        $this->assign('email','thinkphp@qq.com');
        // 或者批量赋值
        $this->assign([
            'name'  => 'ThinkPHP',
            'email' => 'thinkphp@qq.com'
        ]);
        // 模板输出
        return $this->fetch();
        
    }
}
