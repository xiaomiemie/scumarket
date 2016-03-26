<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;

class PersonalController extends Controller {
  //1基本信息
    public function index(){
      if(!session('?nickname')){//判断session是否已经被设置
        if(cookie('nickname')){//如果用户之前保存了cookie
          $nickname=cookie('nickname');
          $user = D('user');
          if($user->checkExisted($nickname)){//查询数据库监测该用户是否还存在
            session('nickname',$nickname);
          }else{
            cookie('nickname',null); //设置cookie
            cookie('password',null); //设置cookie        
            cookie('realname',null); //设置cookie        
            cookie('phonenum',null); //设置cookie 
          }     
        }  
      }      
      if(session('?nickname')){
        $nick=session('nickname');
          $info=M('info');
          $r=$info->where("nickname='$nick'")->order('info_time desc')->select();
          if($r!==false){
            $count=count($r);
            if($count>0){
              $res['res']=$r;
              $f=$info->where("nickname='$nick' and info_flag='0'")->select();
              $res['flag']=count($f);
            }else{
              $res['flag']=0;
              $arr['info_text']='暂时没有系统私信';
              $res['res']=[$arr];
            }
          }else{
            $res['flag']=0;
              $res['res']=[];
          }
          $this->assign('res',$res);
        $this->display('personal');
      }else{
        $this->show('<a href="{:U("Login/index")}">请先登录</a>');
      }      
    }
    //1、改变手机号
    public function changePhoneNum(){
      $user = D('User');
      $flag = $user->checkSession();
      if($flag){
        $nickname = session('nickname');
      $data['phonenum']=I('phonenum');
      $res = $user->where("nickname='$nickname'")->save($data); // 根据条件更新记录
      if($res!== false){
        $info='1';
      }else{
        $info='0';
      }
      }else{
        $info='err';
      }
        
        $this->ajaxReturn($info,'JSON');
    }
    
    //2.我的货单
    public function myGoodList(){
      $user = D('User');
      $flag = $user->checkSession();
      if($flag){
        $goods = M('goods');
        $nickname = session('nickname');
        $list = $goods->where("nickname='$nickname'")->order('good_id desc')->page(I('pageNum'),I('pageSize'))->select();
        $count = $goods->where("nickname='$nickname'")->count();
        $res['list']=$list;
        $res['totalCount']=$count;
        if($res){
          $this->ajaxReturn($res,'JSON');
        }else{
          $this->ajaxReturn('0','JSON');//异常数据库操作
        }
      }else{
        $this->ajaxReturn('1','JSON');//未登录
      }
     
    }
    //2.1 下架商品
    public function underGood(){
      $user = D('User');
      $flag = $user->checkSession();
       if($flag){
          $goods = M('goods');
          $data['status']=I('status');
          $id=I('id');
          $res = $goods->where("good_id='$id'")->save($data);
          if($res!==false){
            $info=$goods->where("good_id='$id'")->select();
            $this->ajaxReturn($info,'JSON');
          }else{
            $this->ajaxReturn('0','JSON');
          }
       }else{
         $this->ajaxReturn('err','JSON');
       }

    }
    // 2.2 商品上架
    public function upGood(){
       $user = D('User');
       $flag = $user->checkSession();
       if($flag){
          $goods = M('goods');
          $data['status']=I('status');
          $id=I('id');
          $res = $goods->where("good_id='$id'")->save($data);
          if($res!==false){
            $info=$goods->where("good_id='$id'")->select();
            $this->ajaxReturn($info,'JSON');
          }else{
            $this->ajaxReturn('0','JSON');
          }
       }else{
        $this->ajaxReturn('err','JSON');
       }

    }
    //2.3 删除商品
    public function delGood(){
       $user = D('User');
        $flag = $user->checkSession();
         if($flag){
            $goods = M('goods');
        $id=I('id');
        $res = $goods->where("good_id='$id'")->delete();
         if($res){
          $this->ajaxReturn($res,'JSON');
        }else{
          $this->ajaxReturn('0','JSON');
        }
         }else{
          $this->ajaxReturn('err','JSON');
         }
       
    }
    
   //3.上传新货 
    public function update(){
       $user = D('User');
        $flag = $user->checkSession();
        $f=$user->checkExisted(session('nickname'));
       if($flag && $f){
         $goods = M('goods');     
        if(!empty($_FILES)){
          $upload = new \Think\Upload(); // 实例化上传类
          $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
          $upload->rootPath='Apps/Home/Public/';
          // $upload->maxSize=5300000;
          $upload->savePath = 'Uploads/';// 设置附件上传目录

          // 上传文件 
          $info   =   $upload->upload();         
          
          if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn('至少上传一张图片','JSON');
          }else{// 上传成功
            $data['goodname'] = I('goodname');              
            $data['goodprice'] = I('goodprice');              
            $data['changeprice'] = I('changeprice');              
            $data['businesstype'] = I('businesstype');              
            $data['goodtype'] = I('goodtype');
            $data['nickname']=session('nickname');
            $data['gooddetail']=I('gooddetail');
           $data['status'] =1;
            $count = count($info);
            for($i=1;$i<=$count;$i++){
              $image = new \Think\Image();
              $image->open('Apps/Home/Public/'.$info['imgupdate'.$i]['savepath'].$info['imgupdate'.$i]['savename']);             
              $width = $image->width(); // 返回图片的宽度
$height = $image->height(); // 返回图片的高度
// if($width>)
              $image->thumb(300, 300,\Think\Image::IMAGE_THUMB_FIXED)->save('Apps/Home/Public/Uploads2/'.$info['imgupdate'.$i]['savename']);
              unlink('Apps/Home/Public/'.$info['imgupdate'.$i]['savepath'].$info['imgupdate'.$i]['savename']);
              $data['goodimg'.$i]='Uploads2/'.$info['imgupdate'.$i]['savename'];
            }
            $res = $goods->add($data);
            if($res){
              $this->ajaxReturn('1','JSON');//成功
            }else{
              $this->ajaxReturn('0','JSON');//失败
            }                         
          }   
        }else{
          $this->ajaxReturn('3','JSON');//至少传一张图
        }
        }else{
          $this->ajaxReturn('2','JSON');//没登陆
        }
      
    }
    
    //4 我的收藏
    public function myCollection(){
       $user = D('User');
        $flag = $user->checkSession();
         if($flag){
            $Model =  D();
            $pageNum=I('pageNum');
            $pageSize=I('pageSize');
             $goods = M('Goods');
             $col = M('collection');
             $nickname=session('nickname');
              $datares = $col->where("nickname = '$nickname'")->order('good_id desc')->page(I('pageNum'),I('pageSize'))->field('good_id')->select();      
              $count=count($col->where("nickname = '$nickname'")->select());
              $info['totalCount']=$count;
              if(count($datares)>0){ //我的收藏不为空
                $datares['_logic']='OR'; 
                $res = $goods->where($datares)->select();
                 if($res!==false){ //查询具体商品没错
                  $info['data']=$res;
                  $this->ajaxReturn($info,'JSON');
                }        
              }else{  //为空
                $info['data']=null;
                $this->ajaxReturn($info,'JSON');
              }
        }else{
          $this->ajaxReturn('1','JSON');
        }
       
        
    }
    
    public function changeFlag(){
        $user = D('User');
        $flag = $user->checkSession();
         if($flag){
           $info=M('info');
           $nick=session('nickname');
           $arr=$info->where("nickname='$nick' and info_flag=0")->field('info_id')->select();
           if($arr!==false){
            $arr['_logic']='OR'; 
            $data['info_flag']=1;
            $res = $info->where($arr)->save($data);
            $this->ajaxReturn($res,'JSON');
           }else{
             $this->ajaxReturn('err','JSON');
           }
           
         }else{
          $this->ajaxReturn('nolog','JSON');
         }
    }
}