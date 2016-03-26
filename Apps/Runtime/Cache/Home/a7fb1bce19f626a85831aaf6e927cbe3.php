<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <title>川大跳蚤市场压缩图</title>
  <meta charset='utf-8'>
  <meta name="keywords" content="交易,跳蚤,川大,买,卖,出售" />
  <meta name="description" content="川大跳槽市场，专注买卖交易出售租赁活动" />
  <link rel="bookmark" href="/scumarket/favicon.ico"/>
  <link rel="shortcut icon" type="image/ico" href="/scumarket/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="/scumarket/Apps/Home/Public/css/bootstrap.min.css">
  <style>
  .uploadfile{
    margin: 20px auto;
  }
  #canvasa,#canvasb{
    border:1px solid #aaa;
    /*display: block;*/
    float: left;
    margin:  0 10px;
  }
  .c{
    height: 510px;
  }

  .button{
    text-align: center;
  }
  </style>
</head>
<body>
  <p>选择图片之后点击确定，即可浏览图片。点击压缩按钮对图片进行压缩，点击压缩后的图片进行保存。</p>
  <form class="form-inline uploadfile">
    <div class="form-group">
      <input type="file" class="form-control" id="filename1" name="filename1"/>
      <input type="file" class="form-control" id="filename2" name="filename2"/>
    </div>
    <input id='finish' class="btn btn-primary" type='button' value="确定"/>
  </form>
  <div class="c">
    <canvas id="canvasa" width="500" height="500">如果不支持，我会显示</canvas>
    <canvas id="canvasb" width="500" height="500">如果不支持，我会显示</canvas>
  </div>
  <div class="button">
    <a href="#" class="buttona" data-type='grey'>grey</a>
    <a href="#" class="buttona" data-type='black'>black</a>
    <a href="#" class="buttona" data-type='reverse'>reverse</a>
    <a href="#" class="buttona" data-type='blur'>blur</a>
    <a href="#" class="buttona" data-type='mosaic'>mosaic</a>
  </div>
</body>
  <script type="text/javascript" src="/scumarket/Apps/Home/Public/framework/jquery.min.js"></script>
  <script type="text/javascript" src="/scumarket/Apps/Home/Public/framework/ajaxFileUpload.js"></script>
  <script type="text/javascript">
 $(function() {
   var ca = $('#canvasa')[0];
   var contexta = ca.getContext('2d'); //用context进行绘制
   var cb = $('#canvasb')[0];
   var contextb = cb.getContext('2d'); //用context进行绘制
   
   $('#finish').on('click',function(){
   
       $.ajaxFileUpload({
          url: 'update', //你处理上传文件的服务端
          secureuri: false,
          fileElementId: ['filename1'],
          data: {
            'data':$('#filename1').val()
          },
          dataType: 'json',
          type: 'POST',
          success: function(data) {
            console.log(data)
            data = JSON.parse(data);
          console.log(data)

          },
          error: function(data) {
            var mes = new Message.Message({
              data: '操作异常',
              type: 'alert-danger'
            });
          }
        });
   //   var img = new Image();
   // img.src = $('#filename').val();
   //    img.onload = function() {
   //   contexta.drawImage(img, 0, 0, ca.width, ca.height);

   //   $('.buttona').on('click', function() {
   //     filter($(this).data('type'))
   //   })
   // };
   })
  


   function filter(type) {
    
     var imgData = contexta.getImageData(0, 0, ca.width, ca.height);
     var pixelData = imgData.data;
     switch (type) {
       case "grey":
         for (var i = 0; i < ca.width * ca.height; i++) {
           var r = pixelData[4 * i + 0];
           var g = pixelData[4 * i + 0];
           var b = pixelData[4 * i + 0];
           var tmp = r * 0.3 + g * 0.59 + b * .011;
           pixelData[4 * i + 0] = tmp
           pixelData[4 * i + 1] = tmp
           pixelData[4 * i + 2] = tmp
         }
         break;

       case 'black':
         for (var i = 0; i < ca.width * ca.height; i++) {
           var r = pixelData[4 * i + 0];
           var g = pixelData[4 * i + 0];
           var b = pixelData[4 * i + 0];
           var tmp = r * 0.3 + g * 0.59 + b * .011;
           if(tmp>255/2){
            tmp=255;
           }else{
            tmp=0;
           }
           pixelData[4 * i + 0] = tmp
           pixelData[4 * i + 1] = tmp
           pixelData[4 * i + 2] = tmp
         }
          break;
          
        case 'reverse':
         for (var i = 0; i < ca.width * ca.height; i++) {
           var r = pixelData[4 * i + 0];
           var g = pixelData[4 * i + 0];
           var b = pixelData[4 * i + 0];
          
           pixelData[4 * i + 0] = 255-r
           pixelData[4 * i + 1] = 255-g
           pixelData[4 * i + 2] = 255-b
         }
          break;
        case 'blur':
        //模糊 某一块是他周围的平均数。周围范围越大，越模糊
        var blurr=1;
        var blurr2=(blurr+2)*(blurr+2);
        var tmpimgData = contexta.getImageData(0, 0, ca.width, ca.height);
        var tmppixelData = tmpimgData.data;
        for(var i = 0;i<ca.height;i++){
          for(var j = 0;j<ca.width;j++){
            var tr=0,tg=0,tb=0;
            for(var dy=-blurr;dy<=blurr;dy++){
              for(var dx=-blurr;dx<=blurr;dx++){
                var x= j+dx;
                var y = i+dy;
                if(!(x<0 || x>=ca.width) && !(y<0 || y>=ca.height)){
                  var p = y*ca.width+x;
                  tr+=tmppixelData[p*4+0];
                  tg+=tmppixelData[p*4+1];
                  tb+=tmppixelData[p*4+2];
                }
              }
            }
            var p2=i*ca.width+j;
            
            pixelData[p2*4+0]=tr/blurr2;
            pixelData[p2*4+1]=tg/blurr2;
            pixelData[p2*4+2]=tb/blurr2;
          }
        }

          break;
        case 'mosaic':
        //马赛克：某一块都设置成一个颜色。
        var blurr=6;//块大小
        var b2=blurr+1;
        var blurr2=(blurr+2)*(blurr+2);
        var tmpimgData = contexta.getImageData(0, 0, ca.width, ca.height);
        var tmppixelData = tmpimgData.data;
        for(var i = 0;i<ca.height;i+=b2){
          for(var j = 0;j<ca.width;j+=b2){
            var tr=0,tg=0,tb=0;
            for(var dy=-blurr;dy<=blurr;dy++){
              for(var dx=-blurr;dx<=blurr;dx++){
                var x= j+dx;
                var y = i+dy;
                if(!(x<0 || x>=ca.width) && !(y<0 || y>=ca.height)){
                  var p = y*ca.width+x;
                  tr+=tmppixelData[p*4+0];
                  tg+=tmppixelData[p*4+1];
                  tb+=tmppixelData[p*4+2];
                }
              }
            }

            for(var dy=-blurr;dy<=blurr;dy++){
              for(var dx=-blurr;dx<=blurr;dx++){
                var x= j+dx;
                var y = i+dy;
                if(!(x<0 || x>=ca.width) && !(y<0 || y>=ca.height)){
                  var p = y*ca.width+x;
                              
                  pixelData[p*4+0]=tr/blurr2;
                  pixelData[p*4+1]=tg/blurr2;
                  pixelData[p*4+2]=tb/blurr2;
                }
              }
            }
            
          }
        }

          break;
     }

     contextb.clearRect(0,0,cb.width,cb.height);
     contextb.putImageData(imgData, 0, 0, 0, 0, cb.width, cb.height) //还是原始大小放，被减去的50,50，右边就会被空出来
   }


 })
</script>
</html>