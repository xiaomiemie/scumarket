define(['jquery'],function($){
  function loadingImg(opts){
    this.opts = $.extend({},loadingImg.DEFAULTS,opts);
    this.$el = this.opts.el;
    this.show();
  };
  
  loadingImg.prototype.setPosition=function(){
    this.$el.css({
      width:this.opts.width,
      height:this.opts.height,
      top:this.opts.top,
      left:this.opts.left
    })
  };
  loadingImg.prototype.hide=function(){
    this.$el.hide();
  };
  loadingImg.prototype.show=function(){
    this.$el.show();
  }
  
  loadingImg.DEFAULTS = {
    width:'200px',
    height:'200px',
    top:'100px',
    left:'100px'
  }
  
  return {
    loadingImg:loadingImg
  }
})