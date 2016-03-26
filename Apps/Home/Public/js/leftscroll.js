define(['jquery'],function($){
  function leftScroll(opts){
    this.opts = $.extend({},leftScroll.DEFAULTS,opts);
    this.$el = this.opts.el;
  };
  leftScroll.prototype.bindEvent=function(){
    var that = this;
    $(window).on('scroll',function(){
      // console.log($(this).scrollTop());     
      var topNum = $(this).scrollTop();
      var heightright = $('.rightlist').height();
      var heightself = that.$el.height();
      var contentHright = heightright-heightself;
      if(topNum>70){    
          $('.leftlist').css('top',topNum-70+'px')
      }else if(topNum<=70){
        $('.leftlist').css('top',0) //绝对定位于外层的div.content
      }
    })
  }
  
  leftScroll.DEFAULTS={
  };
  
  return {
    leftScroll:leftScroll
  }
})