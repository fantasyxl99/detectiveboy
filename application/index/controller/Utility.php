<?php
namespace app\index\controller;
//use think\Loader;
use think\Db;
class Utility extends \think\Controller
{
    public function index()
    {                

        $this->user_check();

        
    }
    public function code_check(){
        $code = input('get.code');
        if($code){
            $user_email = Db::name('code')->where('code',$code)->value('email');
            $activated=Db::name('user')->where('account',$user_email)->value('is_activated');
            if($activated==1){
                echo '该用户已经激活';
            }else {
                $password = mt_rand(111111,999999);
                $user = Db::name('user')->where('account',$user_email)->update(['is_activated' => '1','password'=>md5($password)]);
                echo "邮箱激活成功,你的初始密码为".$password."-请尽快完善个人信息";
            }
        
        }
    }
    public function  user_check(){
        
        
        $smtpusermail = "fantasyxl99@163.com";//SMTP服务器的用户邮箱---发件人
        $toemail = input('post.email'); //收件人邮箱
        $actcodes =MD5($toemail.mt_rand(111111,999999));//验证码
        $mailsubject = "Welcome to detectiveboy";//邮件主题
        $mailtype = "html";//邮件格式（HTML/TXT）,TXT为文本邮件
        $mmsg = "您已经注册成功,请将点击以下链接激活您的账号： <a href='http://localhost:8080/detectiveboy/index.php/index/Utility/code_check?code=".$actcodes."'>点击激活</a>";
        
        $user = Db::name('user')->where('account',$toemail)->find();
        if($user['is_activated']==='1'){
            echo "该账号已激活";
            exit();
        }else if ($user['is_activated']==='0'){
            echo "该账号未激活";
            exit();
        }else if ($user===null){
            //插入验证码
            $data = ['code' => $actcodes, 'email' => $toemail];
            $code = Db::name('code')->insert($data);
            //插入用户
            $data = ['password' => md5(123456),'account' => $toemail, 'uname' => $toemail,'creattime'=>time(),'is_activated'=>0];
            $user = Db::name('user')->insert($data);
            if($code == 1){
                $smtp = $this->smtp_fig();//连接smtp服务器
                $smtp->sendmail($toemail, $smtpusermail,$mailsubject, $mmsg,$mailtype);   //发送邮件
                // 模板输出
                return $this->redirect('index/index');
            }else {
                echo '发送失败！';
                exit;
            }
        }
 
    }
    public function smtp_fig(){
        require_once ('Smtp.php');
        //Loader::import('email', EXTEND_PATH, '.class.php');
        //##########################################
        /*
         * 注：QQ要使用ssl连接即--- ssl://smtp.qq.com，并且端口号维465或587
         * 其余邮箱使用正常连接如--- smtp.163.com,端口号为25
         * 测试过程中发现163邮箱会因部分网络端口限制无法正常发送邮件，而其他如qq,sohu则正常，是故先检查下网络端口
         *
        */
        $smtpserver = "smtp.163.com";//SMTP服务器163/126/sohu/qq/xinlang
        $smtpserverport =25;//SMTP服务器端口
        $smtpusermail = "fantasyxl99@163.com";//SMTP服务器的用户邮箱
        $smtpuser = "fantasyxl99@163.com";//SMTP服务器的用户帐号
        $smtppass = "Email290401";//SMTP服务器的用户密码
        
        
        ##########################################
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        return $smtp;
    }
}
