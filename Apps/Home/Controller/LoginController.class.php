<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){      
             $this->display('login');
    }
   
    //登录
    public function login(){
      $user = D('User');
      // $user = new \Home\Model\UserModel();  //这个也可以
      $res = $user->checkNamePwd(I(nickname),I(password));
      if($res==false){
        $this->ajaxReturn($res,'JSON');
      }else{
          if(I('flag')){
            $time =time()+60*60*24*7;
             cookie('nickname',$res['nickname'],time); //设置cookie
             cookie('password',$res['password'],time); //设置cookie
             cookie('realname',$res['realname'],time);
             cookie('phonenum',$res['phonenum'],time);        
          }else{
             cookie('nickname',null); //设置cookie
             cookie('password',null); //设置cookie        
             cookie('realname',null); //设置cookie        
             cookie('phonenum',null); //设置cookie        
          }         
        session('nickname',$res['nickname']);
        session('realname',$res['realname']);
        session('password',$res['password']);
        session('phonenum',$res['phonenum']);
        $this->ajaxReturn($res,'JSON');      
      }
    }
    
    //退出
    public function logout(){
      session(null);
      session('[destroy]'); // 销毁session
      cookie('nickname',null); //设置cookie
      cookie('password',null); //设置cookie        
      cookie('realname',null); //设置cookie        
      cookie('phonenum',null); //设置cookie 
      $this->redirect('Index/index');
    }
}