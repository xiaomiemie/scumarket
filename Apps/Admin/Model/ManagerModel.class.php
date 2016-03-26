<?php

//user模型model

namespace Admin\Model;
use Think\Model;

//父类Model thinkpp/lib
class ManagerModel extends Model{
  //制作方法校验用户名和密码 先查询用户名，返回null 或者一维数组
   function checkNamePwd($name,$pwd){
    $info = $this->getByusername($name);
    if($info != null){
      if($info['password']!=$pwd){
        return false;
      }else{
        return $info;
      }
    }else{
      return false;
    }
  }
  
  function checkSession(){
    if(session('?username')){
      return true;
    }else{
      return false;
    }
  }
  
  
}