<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class ItemController extends Controller {
  //首頁
    public function index(){
     if(!session('?nickname')){
        if(cookie('nickname')){
        $nickname=cookie('nickname');
        $user = D('user');
        if($user->checkExisted($nickname)){
          session('nickname',$nickname);
        }else{
          cookie('nickname',null); //设置cookie
          cookie('password',null); //设置cookie        
          cookie('realname',null); //设置cookie        
          cookie('phonenum',null); //设置cookie 
        }     
      }
     }
      $id=$_GET['id'];
      $good=M('goods');
      $user=D('User');
      $res = $good->where("good_id='$id'")->select();//查商品信息
      $r=$res[0];
      $nickname=$r['nickname'];
      $u=$user->where("nickname='$nickname'")->select();//用户信息
      $info['content']=$r;
      $info['user']=$u[0];
      for($i=1;$i<6;$i++){
        if($r['goodimg'.$i]){
          $imgs[$i]=$r['goodimg'.$i];
        }else{
          break;
        }
      }
      $info['imgs']=$imgs;
      //是否收藏夹
      $mes=$user->checkSession();
      if($mes){//已登录
      $col = M('collection');
        $res = $col->where("nickname='$nickname' and good_id = '$id'")->select();
        if($res){//收藏
          $info['collection']=true;
        }else{
          $info['collection']=false;
        }
      }else{
        $info['collection']=false;
      }
      
      if($info){
        $this->assign('res',$info);
        $this->display('item');
      }else{
        $this->display('页面执行错误');
      }
      
    }
    //添加收藏
    public function addCollection(){
      $col = M('collection');
      $u=D('user');
      $mes=$u->checkSession();
      if($mes){
        $nickname=session('nickname');
        $id=I('id');
        $data['good_id']=I('id');
        $data['nickname']=$nickname;
        $res = $col->where("nickname='$nickname' and good_id = '$id'")->select();
        if($res==null || $res==false){
          $r = $col->add($data);
          if($r){
            $info='1';
          }else{
            $info='0';
          }
        }else{
          $info='0';
        }
        $this->ajaxReturn($info,'JSON');
      }else{
        if(cookie('nickname')){
          $nickname=cookie('nickname');
          $user = D('user');
          if($user->checkExisted($nickname)){
            session('nickname',$nickname);
          }else{
            cookie('nickname',null); //设置cookie
            cookie('password',null); //设置cookie        
            cookie('realname',null); //设置cookie        
            cookie('phonenum',null); //设置cookie 
            $this->ajaxReturn('2','JSON');//没有登录
          }     
        }else{
          $this->ajaxReturn('2','JSON');//没有登录
        }
        
      }
 
    }
        //取消收藏
    public function delCollection(){
      $col = M('collection');
      $u=D('user');
      $mes=$u->checkSession();
      if($mes){
        $nickname=session('nickname');
        $id=I('id');
        $data['good_id']=I('id');
        $data['nickname']=$nickname;
        $res = $col->where("nickname='$nickname' and good_id = '$id'")->select();
        if($res){
          $r = $col->where("nickname='$nickname' and good_id = '$id'")->delete();
          if($r){
            $info='1';
          }else{
            $info='0';
          }
        }else{
          $info='0';
        }
        $this->ajaxReturn($info,'JSON');
      }else{
        $this->ajaxReturn('2','JSON');
      }
 
    }
}