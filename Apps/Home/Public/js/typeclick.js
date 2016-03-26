define(['jquery', 'loadlist'], function($, loadList) {

  function typeClick(opts) {
    this.opts = $.extend({}, typeClick.DEFAULTS, opts);
    this.$el = this.opts.el;
  }

  typeClick.prototype.bindEvent = function() {
    var that = this;
    this.$el.on('click', 'a', function(e) {
      var type = $(this).data('type');
      that.$el.find('a').removeClass('active');
      $(this).addClass('active');
      var load = new loadList.loadList({
        el: $('.rightlist .goodlist'),
        url: 'typeSelect',
        clearList: true,
        data: {
          pageSize: '8',
          type: type
        }
      })
    })
  };

  typeClick.prototype.clickEvent = function() {
    this.$el.find('a').eq(0).trigger('click');
  }


  typeClick.DEFAULTS = {

  }

  return {
    typeClick: typeClick
  }
})