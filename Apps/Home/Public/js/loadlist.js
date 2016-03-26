/*
url
clearList
data:{
  pageSize:
}
*/
define(['jquery', 'loadingImg', 'message'], function($, loadingImg, Message) {
  function loadList(opts) {
    window.classname = Math.ceil(Math.random() * 10000);
    this.c = 'class' + window.classname;
    this.publicUrl = '/scumarket/Apps/Home/Public/';
    this.opts = $.extend({}, loadList.DEFAULTS, opts);
    this.$el = this.opts.el;
    this.opts.data.pageNum = 1;
    this.bindEvent();
    $('.' + this.c).trigger('click');
    if (this.opts.clearList) {
      this.clearList();
    }
  };
  loadList.prototype.loadData = function() {
    var that = this;
    var loading = new loadingImg.loadingImg({
      el: $('.loading'),
      width: '100%',
      height: '100%',
      top: '0%',
      left: '0%'
    });
    loading.setPosition();
    $.ajax({
      type: 'GET',
      data: that.opts.data,
      url: that.opts.url
    }).success(function(data) {
      loading.hide();
      if (data == 1) {
        var mes = new Message.Message({
          data: '请先登录',
          type: 'alert-warning'
        });
      } else {
        that.opts.data.pageNum++;
        that.render(data.data);
        that.loadNext(data.totalCount);
      }
    }).fail(function() {
      loading.hide();
      var mes = new Message.Message({
        data: '操作异常',
        type: 'alert-danger'
      });
    })
  };

  loadList.prototype.render = function(data) {
    var that = this;
    var publicUrl = that.publicUrl;
    var arr = [];
    if (data) {
      console.log(data)
      var len = data.length;
      if (len > 0) {
        for (var i = 0; i < len; i++) {
          var str = ' <li><div class="thumbnail"><a target="_blank" href="../Item/index?id=' + data[i].good_id + '"><img style="height:185px;" class="goodpicsmall" src="' + publicUrl + data[i].goodimg1 + '"></a><div class="caption">' +
            '<h4 class="goodname"><a target="_blank" href="../Item/index?id=' + data[i].good_id + '">' + data[i].goodname;
          if (data[i].status == 0) {
            str = str + '</a><small>暂时下架</small>'
          } else {
            str = str + '</a>';
          }
          str = str + '</h4><h4 style="color:#D9534F">' + data[i].goodprice + '</h4><p class="gooddetail">&nbsp;' + data[i].gooddetail + '</p></div></div></li>';
          arr.push(str);
        }
      } else {
        var str = '<p>对不起，没有你想要的结果</p>';
        arr.push(str);
      }
    } else {
      var str = '<p>对不起，没有你想要的结果</p>';
      arr.push(str);
    }

    that.$el.append(arr.join(''));
  };

  loadList.prototype.loadNext = function(num) {
    if (Math.ceil(num / (this.opts.data.pageSize)) >= this.opts.data.pageNum) {
      $('.' + this.c).show();
    } else {
      $('.' + this.c).hide();
    }
  };

  loadList.prototype.bindEvent = function() {
    var that = this;
    $('.loadnext').hide();
    this.$el.parent().append('<div class= "loadnext ' + that.c + '">继续加载</div>')
    $('.' + that.c).on('click', function() {
      that.loadData();
    })
  };
  loadList.prototype.clearList = function() {
    this.$el.empty();
  }

  loadList.DEFAULTS = {
    clearList: false,
    data: {
      pageSize: '8'
    }
  };

  return {
    loadList: loadList
  }
})