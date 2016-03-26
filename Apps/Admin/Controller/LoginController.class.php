<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
      $this->display('login');
    }
    public function login(){
       $mng=D('Manager');
       $info = $mng->checkNamePwd(I('username'),I('password'));
       if($info==false){
         $this->ajaxReturn($info,'JSON');
       }else{
          session('username',I('username'));
          $this->ajaxReturn($info,'JSON');
       }    
    }
    
    public function logout(){
      session('username',null);
      $this->redirect('Login/index');
    }
}