<?php
namespace Home\Controller;
use Think\Controller;
class PicController extends Controller {
    public function index(){      
      $this->display('pic');
    }
    
    public function update(){
        if(!empty($_FILES)){
          $upload = new \Think\Upload(); // 实例化上传类
          $image = new \Think\Image();
          $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
          $upload->rootPath='Apps/Home/Public/';
          $upload->maxSize=5300000;
          $upload->savePath = 'Uploads2/';// 设置附件上传目录

          // 上传文件 
          $info   =   $upload->upload();         
          // $image = new \Think\Image();
          if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn('err','JSON');
          }else{// 上传成功
              $image->open('Apps/Home/Public/'.$info['filename1']['savepath'].$info['filename1']['savename']);
              // $width = $image->width(); // 返回图片的宽度
              
              $n=strrpos($info['filename1']['savename'],'.');//:查找search在$str中的最后一次出现的位置从int
             $date=date('U').substr($info['filename1']['savename'],$n);
              $image->thumb(450, 450,\Think\Image::IMAGE_THUMB_FILLED)->save('Apps/Home/Public/'.$info['filename1']['savepath'].$date);
              unlink('Apps/Home/Public/'.$info['filename1']['savepath'].$info['filename1']['savename']);
            $this->ajaxReturn( $date,'JSON');//成功
                            
          }  
           
        }else{
          $this->ajaxReturn('至少传一张图','JSON');//至少传一张图
        }
        
    }

}