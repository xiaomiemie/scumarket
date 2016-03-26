define(['jquery', 'mygoodlist', 'scrollto', 'message', 'bootstrap', 'tablepage', 'comfn'], function($, myGoodList, scrollto, Message, bootstrap, tablePage, comfn) {
  var cf = new comfn.commonFn();
  cf.bwMatch();
  if (cf.jMeteor.browserName == 'msie' && parseInt(cf.jMeteor.browser.version) <= 8) {
    $('body').html('请使用Chrome，Firedox，Safari，IE9及以上版本等浏览器');

  } else {
    var scrollto = new scrollto.scrollTo({
      el: $('.toolbar .toolbar-item')
    });
    var tp;
    scrollto.move();
    $('#myTabs a').click(function(e) {
      e.preventDefault()
      $(this).tab('show')
    });
    //信息搜索框
    $('#searchinfobutton').on('click', function() {
      var keyvalue = $('#searchinfoinput').val();
      var load = new myGoodList.myGoodList({
        url: 'searchInfo',
        el: $('#info .goodlist'),
        clearList: true,
        data: {
          keyvalue: keyvalue,
          pageSize: 8
        } //传入的是ul
      });
    });
    $('#searchinfobutton').trigger('click');

    //删除信息
    $('.goodlist').on('click', '.delbutton', function() {
      if (confirm('确定要删除吗')) {
        var data = {};
        var that = this;
        data.goodid = $(this).data('id');
        $.ajax({
          type: 'POST',
          url: 'delInfo',
          data: data
        }).success(function(data) {
          if (data == 1) {
            var mes = new Message.Message({
              data: '删除成功',
              type: 'alert-success'
            });
            $(that).parents('li').remove();
          } else if (data == 2) {
            var mes = new Message.Message({
              data: '请先登录',
              type: 'alert-warning'
            });
          } else {
            var mes = new Message.Message({
              data: '操作异常',
              type: 'alert-danger'
            });
          }
        }).fail(function() {
          var mes = new Message.Message({
            data: '操作异常',
            type: 'alert-danger'
          });
        })
      }
    });
    //用户搜索按钮
    $('#searchuserbutton').on('click', function() {
      tp = new tablePage.tablePage({
        elPage: $('#nav-page'),
        elTable: $('.usertbody'),
        url: 'searchUser',
        data: {
          keyvalue: $('#searchuserinput').val(),
          pageSize: 7
        }
      });
    });
    //判断是否第一次点击
    $('ul.nav li').eq(1).on('click', function() {
      if ($(this).hasClass('onceClick')) {
        $(this).removeClass('onceClick');
        $('#searchuserbutton').trigger('click');
      }
    });
    //删除用户
    $('.usertbody').on('click', '.delUser', function() {
        if (confirm('确定要删除该用户吗？')) {
          var thatel = this;
          var elTable = $('.usertbody');
          var optdata = tp.opts.data;
          var val = {
            data: {},
            url: 'searchUser'
          };
          $.ajax({
            url: 'delUser',
            type: 'POST',
            data: {
              id: $(thatel).data('id')
            }
          }).success(function(data) {
            if (data == 1) {
              var mes = new Message.Message({
                data: '删除成功',
                type: 'alert-success'
              });
              if (elTable.find('tr').length == 1) { //如果这一夜只有一个
                if (optdata.pageNum != 1) {
                  optdata.pageNum = optdata.pageNum - 1;
                }
              }
              tp.loadData(tp.opts);
            } else if (data == 'err') {
              var mes = new Message.Message({
                data: '请先登录',
                type: 'alert-warning'
              });
            } else {
              var mes = new Message.Message({
                data: '操作异常',
                type: 'alert-danger'
              });
            }
          })
        }
      })
      //点击出现弹出框
    $('.usertbody').on('click', '.sendMsg', function() {
      tp.clickname = $(this).data('id');
      $('.dialog-name').html(tp.clickname);
      $('.main-dialog').show();
      $('.mask').show();
    });
    //发送
    $('.dialog-submit').on('click', function() {
      var text = $('.dialog-text').val();
      if (text.trim().length) {
        $.ajax({
          type: 'POST',
          url: 'sendMsg',
          data: {
            text: text,
            nickname: tp.clickname
          }
        }).success(function(data) {
          if (data == 'err') {
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
            var mes = new Message.Message({
              data: '发送成功',
              type: 'alert-success'
            });
          }
        })
      } else {
        var mes = new Message.Message({
          data: '发送内容不能为空',
          type: 'alert-warning'
        });
      }

    });
    //关闭
    $('.dialog-close').on('click', function() {
      $('.dialog-text').val('');
      $('.main-dialog').hide();
      $('.mask').hide();
    });
  }


})