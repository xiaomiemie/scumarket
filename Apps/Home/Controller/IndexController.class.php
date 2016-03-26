<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    if(cookie('nickname')){
      $nickname=cookie('nickname');
      $user = D('user');
      if($user->checkExisted($nickname)){
        session('nickname',$nickname);
      }else{
        cookie(null);
      }     
    }
    $this->display();
  
    }
    
    //type搜索
    public function typeSelect(){
      $good = M('goods');
      $type=I('type');
      $pageSize=I('pageSize');
      $pageNum=I('pageNum');
      $res = $good->where("goodtype='$type'")->order('good_id desc')->page($pageNum,$pageSize)->select();
      $r=$good->where("goodtype='$type'")->select();
      $info['totalCount']=count($r);    
       if($res!==false){
          $info['data']=$res;
          $this->ajaxReturn($info,'JSON');
       }else{
        $this->ajaxReturn(0,'JSON');
       }
    }
    //此处采用模糊查询 两个或和一个与条件
    public function search(){
      $good = M('goods');
      $type=I('type');
      $keyvalue=I('keyvalue');
      $pageSize=I('pageSize');
      $pageNum=I('pageNum');
      $where['gooddetail']=array('like',"%$keyvalue%");
      $where['goodname']=array('like',"%$keyvalue%");
      $where['_logic']='OR'; 
      $map['_complex'] = $where;
      if($type!=3){
        $map['businesstype']=array('eq',"$type");
      }     
      $res=$good->where($map)->order('good_id desc')->page($pageNum,$pageSize)->select();
      $r=$good->where($map)->select();
      $info['totalCount']=count($r);
      if($res!==false){
          $info['data']=$res;
          $this->ajaxReturn($info,'JSON');
       }else{
        $this->ajaxReturn(0,'JSON');
       }
    }
}