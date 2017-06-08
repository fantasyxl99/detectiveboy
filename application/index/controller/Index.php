<?php
namespace app\index\controller;
use think\Db;
class Index extends \think\Controller
{
    public function index()
    {
        
        $list    = Db::name('menu')->where('pid',0)->select();
        $list2   = Db::name('menu')->where('pid!=0')->select();
        $acticle = Db::name('acticle')->select();
        $author  = Db::name('user')->select();
        
        $ac_au   = array_merge($acticle,$author);
        // 模板变量赋值
        $this->assign([
            'menu'  => $list,
            'menu2' => $list2,
            'ac_au' => $ac_au
        ]);
        // 模板输出
        return $this->fetch();
        
    }
}
