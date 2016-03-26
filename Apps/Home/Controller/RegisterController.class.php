<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {
    public function index(){      
      // U('show',array('uid'=>1),'',1);die;
      // $user = new \Model\UserModel();  //1
      $this->display('register');
    }
    //昵称查重
    public function nickCheck(){
      $data = I('nickName');
      $user = M('User');
      $info = $user -> where("nickname = '$data'")->select();
      $res=true;
      if($info!=null){
        $res=false;//被占用了
      }
      $this->ajaxReturn($res, 'JSON');
    }
    //注册
    public function register(){
      // echo THINK_VERSION;
      $user = M('User');
      
      $user->realname = I(realname);
      $user->nickname = I(nickname);
      $user->password = I(password);
      $user->phonenum = I(phonenum);
      $res = $user->add();
      if ($res){
      // 成功后返回客户端新增的用户ID，并返回提示信息和操作状态
        $I = M('Info');
        $I->info_text='欢迎您注册使用川大跳蚤市场，小咩祝您在这里拍出称心价格，觅得心爱之物！';
        $I->nickname = I(nickname);
         $r=$I->add();
        $this->ajaxReturn(1,'JSON');
       }else{
          // 错误后返回错误的操作状态和提示信息
          $this->ajaxReturn(0,'JSON');
       }
 
           

    }
}