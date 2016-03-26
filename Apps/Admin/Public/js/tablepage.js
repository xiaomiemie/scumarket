//会在这个页面自动trigger 第一页的标签
define(['jquery', 'message'], function($, Message) {
  function tablePage(opts) {
    this.opts = $.extend({}, tablePage.DEFAULTS, opts);
    this.elPage = this.opts.elPage;
    this.elTable = this.opts.elTable;
    this.opts.data.pageNum = 1;
    this.elPage.off('click', 'a');
    this.bindEvent();
    $('#nav-page').find('a').eq(0).trigger('click');
  }
  tablePage.prototype.loadData = function(thatopt) {
    var that = this;
    $.ajax({
      type: 'GET',
      url: thatopt.url,
      data: thatopt.data
    }).success(function(data) {
      if (data == 1) {
        var mes = new Message.Message({
          data: '请先登录',
          type: 'alert-warning'
        });
      } else if (data == 0) {
        var mes = new Message.Message({
          data: '操作异常',
          type: 'alert-danger'
        });
      } else {
        that.renderTable(data.data);
        that.renderPage(data.totalCount);
      }
    }).fail(function() {
      var mes = new Message.Message({
        data: '操作异常',
        type: 'alert-danger'
      });
    })
  }

  tablePage.prototype.renderTable = function(data) {
    var elTable = this.elTable;
    elTable.empty();
    var that = this;
    var arr = [];
    if (data) {
      var len = data.length;
      if (len > 0) {
        for (var i = 0; i < len; i++) {
          var str = '<tr><td>' + data[i].realname + '</td><td>' + data[i].nickname + '</td><td><button class="btn btn-info sendMsg" data-id="' + data[i].nickname + '">发送私信</button>&nbsp;<button class="btn btn-info delUser" data-id="' + data[i].nickname + '">删除用户</button></td></tr>';
          arr.push(str);
        }
      } else {
        str = '<tr><td colspan="3" align="center">对不起，暂时没有用户</td></tr>';
        arr.push(str);
      }
    } else {
      str = '<tr><td colspan="3" align="center">对不起，暂时没有用户</td></tr>';
      arr.push(str);
    }
    var res = arr.join('');
    elTable.append(res);
  }
  tablePage.prototype.renderPage = function(data) {
    var elPage = this.elPage;
    var that = this;
    elPage.empty();
    var pageNum = that.opts.data.pageNum;
    var pageCount = Math.ceil(data / that.opts.data.pageSize);
    var str = '<ul class="pagination">';
    for (var i = 1; i <= pageCount; i++) {
      str = str + '<li><a href="#">' + i + '</a></li>'
    }
    str += '</ul>'
    elPage.append(str);
    var li = elPage.find('li');
    li.removeClass('active');
    li.eq(pageNum - 1).addClass('active');
  }

  tablePage.prototype.bindEvent = function() {
    var elPage = this.elPage;
    var that = this;
    var elTable = this.elTable;
    elPage.empty();
    elPage.append('<ul class="pagination"><li><a href="#">1</a></li></ul>');
    elPage.on('click', 'a', function() {
      var val = $(this).html();
      that.opts.data.pageNum = $(this).html();
      that.loadData(that.opts);
    });
  }

  tablePage.DEFAULTS = {
    clearTable: false,
    data: {
      pageSize: 3,
    }
  }
  return {
    tablePage: tablePage
  }
})