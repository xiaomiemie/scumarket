define(['jquery'],function($){
  // alert-success   alert-info   alert-warning alert-danger
  function Message(opts){
    this.opts=$.extend({},Message.DEFAULTS,opts);
    this.class1='alert'+parseInt(Math.random()*10000);
    this.render();
    this.settime()
  }
  Message.prototype.template=function(){
    var d = this.opts;
    var tpl='<div class=" message alert '+this.class1+' '+d.type+'" style="padding:0;position:fixed;top:-30px;width:50%;height:30px;left:25%;text-align:center;" role="alert">'+d.data+'</div>';
    return tpl;
  }
  Message.prototype.render=function(){
    var tpl=this.template();
    var that=this;
    $('body').append(tpl);
    $('.'+that.class1).animate({
      top:'0'
    },300);
  }
  Message.prototype.settime=function(){
    var that=this;
    var mes =$('.'+that.class1);
    setTimeout(function(){
      mes.animate({
        opacity:0
      },500,function(){
        mes.remove();
      });
    },1000)
  }
  
  Message.DEFAULTS={
    type:'alert-success',
    data:''
  }
  
  return {
    Message:Message
  }
})