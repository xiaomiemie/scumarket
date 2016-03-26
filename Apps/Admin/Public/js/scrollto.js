define(['jquery'],function($){
  function scrollTo(opts){
        this.opts = $.extend({}, scrollTo.DEFAULTS, opts);
        this.$el =  this.opts.el;
  };
  scrollTo.prototype.move=function(){
    var that = this;
    this.$el.on('click',function(e){
       if($(window).scrollTop()!=that.opts.dest){
      if(!$('html body').is(':animated')){
        $('html body').animate({
          scrollTop: that.opts.dest
        },that.opts.speed)
      }
    }
    })
   
  };
  
  scrollTo.DEFAULTS = {
    dest:0,
    speed:800
  };
  
  return {
    scrollTo:scrollTo
  }
})