<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
      $m=D('Manager');
      $r=$m->checkSession();
      if($r){
        $this->display('index');
      }else{
        $this->show('<a href="{:U("Login/index/")}">请先登录</a>');
      }
      
    }
    //信息
    public function searchInfo(){
      $m=D('Manager');
      $r=$m->checkSession();
      if($r){
        $pageSize=I('pageSize');
        $pageNum=I('pageNum');
        $keyvalue=I('keyvalue');
        $good=M('goods');
        $where['gooddetail']=array('like',"%$keyvalue%");
        $where['goodname']=array('like',"%$keyvalue%");
        $where['_logic']='OR'; 
        $map['_complex'] = $where;
        $info= $good->where($map)->order('good_id desc')->page($pageNum,$pageSize)->select();
        $count=count($good->where($map)->select());
        if($info!==false){
          $res[data]=$info;
          $res[totalCount]=$count;
          
        }else {
          $res=0;
        }
      }else{
        $res=1;
      }
      
      $this->ajaxReturn($res,'JSON');
    }
    
    
    public function delInfo(){
      $m=D('Manager');
      $r=$m->checkSession();
      if($r){
        $good_id=I('goodid');
         $good=M('goods');
         $info=$good->where("good_id='$good_id'")->delete();
          if($info!==false){
            $col=M('collection');
            $col->where("good_id='$good_id'")->delete();
            $res=1;
          }else{
            $res='err';
          }
      }else{
        $res='2';
      }
     
     $this->ajaxReturn($res,'JSON');
    }
    //用户搜索
   public function searchUser(){
      $m=D('Manager');
      $r=$m->checkSession();
      if($r){
         $pageSize=I('pageSize');
        $pageNum=I('pageNum');
        $keyvalue=I('keyvalue');
        $u=M('user');
        $where['nickname']=array('like',"%$keyvalue%");
        $where['realname']=array('like',"%$keyvalue%");
        $where['_logic']='OR'; 
        $map['_complex'] = $where;
        $info=$u->where($map)->order('user_id desc')->page($pageNum,$pageSize)->select();
        $count=count($u->where($map)->select());
       if($info!==false){
         $res[data]=$info;
          $res[totalCount]=$count;
        }else{
          $res='0';
        }
          
       
      }else{
        $res=1;
      }
    
      $this->ajaxReturn($res,'JSON');
     
   }
   //删除用户
    public function delUser(){
      $m=D('Manager');
      $r=$m->checkSession();
      if($r){
        $u=M('user');
        $good=M('goods');
        $info=M('info');
        $nick=I('id');
        $col=M('collection');
        $res1=$u->where("nickname='$nick'")->delete();//如果删了不存在的 返回0
        $res2=$good->where("nickname='$nick'")->delete();
        $res4=$col->where("nickname='$nick'")->delete();
        $res3=$info->where("nickname='$nick'")->delete();
        if($res1!==false && $res2!==false && $res3!==false && $res4!==false){
        // if($res1!==false && $res2!==false){
          $res=1;
        }else{
          $res=0;
        }
      }else{
        $res='err';//没登录
      }     
      $this->ajaxReturn($res,'JSON');
    }
    
    //发送消息
    public function sendMsg(){
       $m=D('Manager');
      $r=$m->checkSession();
      if($r){
        $info=M('info');
        $info->info_text=I('text');
        $info->nickname=I('nickname');
        $r=$info->add();
        if($r){
          $res=$r;
        }else{
          $res=0;
        }
      }else{
        $res='err';
      }
      $this->ajaxReturn($res,'JSON');
    }
    
}