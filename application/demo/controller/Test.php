<?php
namespace app\demo\controller;

use \think\Request;
use think\Controller;
class Test extends Controller
{
    public function hello()
    {
        $request = Request::instance();
        echo '请求方法：' . $request->method() . '<br/>';
        echo '资源类型：' . $request->type() . '<br/>';
        echo '访问地址：' . $request->ip() . '<br/>';
        echo '是否AJax请求：' . var_export($request->isAjax(), true) . '<br/>';
        echo '请求参数：';
        dump($request->param());
        echo '请求参数：仅包含name';
        dump($request->only(['name']));
        echo '请求参数：排除name';
        dump($request->except(['name']));
    }

}