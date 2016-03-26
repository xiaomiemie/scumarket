define(['jquery', 'comfn'], function($, comfn) {
  function scrollTo(opts) {
    this.opts = $.extend({}, scrollTo.DEFAULTS, opts);
    this.$el = this.opts.el;
  };
  scrollTo.prototype.move = function() {
    var that = this;
    this.$el.on('click', function(e) {
      var cf = new comfn.commonFn();
      cf.bwMatch();
      var name = cf.jMeteor.browserName;
      if (name == 'chrome') {
        if ($(window).scrollTop() != that.opts.dest) {
          if (!$(window).is(':animated')) {
            $('html body').animate({
              scrollTop: that.opts.dest
            }, that.opts.speed)
          }
        }
      } else if (name == 'safari') {
        if ($(window).scrollTop() != that.opts.dest) {
          if (!$(window).is(':animated')) {
            $('html body').animate({
              scrollTop: that.opts.dest
            }, that.opts.speed)
          }
        }
      } else if (name == 'firefox') {
        if ($(window).scrollTop() != that.opts.dest) {
          if (!$(window).is(':animated')) {
            $('html').animate({
              scrollTop: that.opts.dest
            }, that.opts.speed)
          }
        }
      }

    })

  };

  scrollTo.DEFAULTS = {
    dest: 0,
    speed: 800
  };

  return {
    scrollTo: scrollTo
  }
})