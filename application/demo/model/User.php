<?php
namespace app\demo\model;

use think\Model;

class User extends Model
{
    public function index() {
        $user           = new User;
        $user->name     = 'thinkphp';
        $user->email    = 'thinkphp@qq.com';
        $user->save();
    }
}