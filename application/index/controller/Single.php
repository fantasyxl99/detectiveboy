<?php
namespace app\index\controller;
use think\Db;
use \think\Request;
class Single extends \think\Controller
{
    public function index()
    {
        $list    = Db::name('menu')->where('pid',0)->select();
        $list2   = Db::name('menu')->where('pid!=0')->select();
        $active  = Request::instance()->get('a');
        $id      = Request::instance()->get('id');
        if($active=='ac'){
            $acticle = Db::name('acticle')->where('id',$id)->find();
            $author  = Db::name('user')->where('id',$acticle['uid'])->find();
            $this->assign('acticle',$acticle);
            $this->assign('author',$author);
        }else if($active=='au'){
            $author  = Db::name('user')->where('id',$id)->find();
            $acticle = Db::name('acticle')->where('uid',$author['id'])->select();
            $this->assign('author',$author);
            $this->assign('acticle',$acticle);
        }
        
        // 模板变量赋值      
        $this->assign([
            'menu'  => $list,
            'menu2' => $list2,
        ]);
        // 模板输出
        return $this->fetch();
        
    }
    public function test(){
        //富文本编辑器
        return $this->fetch();
    }
}
