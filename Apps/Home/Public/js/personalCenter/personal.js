define(['jquery', 'bootstrap', 'validate', 'loadlist', 'mygoodlist', 'ajaxfileupload', 'message', 'json2', 'scrollto', 'comfn', 'loadingImg'], function($, b, validate, loadlist, mygoodlist, ajaxfileupload, Message, json2, scrollto, comfn, loadingImg) {
  var cf = new comfn.commonFn();
  cf.bwMatch();
  if (cf.jMeteor.browserName == 'msie' && parseInt(cf.jMeteor.browser.version) <= 8) {
    $('body').html('请使用Chrome，Firedox，Safari，IE9及以上版本等浏览器');

  } else {
    $('[data-toggle="popover"]').popover();
    var scrollto1 = new scrollto.scrollTo({
      el: $('#myGoods .toolbar .toolbar-item')
    });
    scrollto1.move();
    var scrollto2 = new scrollto.scrollTo({
      el: $('#myCollection .toolbar .toolbar-item')
    });
    scrollto2.move();

    $('.loginnickName').on('click', function() {
        if ($('ul.menu-ul').css('display') == 'none') {
          $('ul.menu-ul').show()
        } else {
          $('ul.menu-ul').hide()
        }
      })
      //基本信息
    var v = new validate.validateForm();
    $('#myTabs a').click(function(e) {
      e.preventDefault();
      $(this).tab('show');
    });
    var flag1, flag2, flag3, flag4, flag5;
    var mygoods;
    $('[name=saveBasicInfo]').on('click', function() {
      // 手机号
      flag3 = v.regex({
        el: $("[name='phoneNum']"),
        reg: /^[\d]{11}$/
      });
      if (flag3) {
        $(this).prop('disabled', true);
        $.ajax({
          url: 'changePhoneNum',
          data: {
            "phonenum": $("[name='phoneNum']").val()
          },
          type: 'POST'
        }).success(function(data) {
          $('[name=saveBasicInfo]').prop('disabled', false);
          // console.log(data)
          if (data == 1) {
            var mes = new Message.Message({
              data: '修改成功',
              type: 'alert-success'
            });
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

        }).fail(function() {
          var mes = new Message.Message({
            data: '操作异常',
            type: 'alert-danger'
          });
        });
      }

    });

    //我的货单
    $('[href="#myGoods"]').on('click', function() {
      mygoods = new mygoodlist.myGoodList({
        el: $('#myGoods .goodlist'),
        url: 'myGoodList',
        clearList: true
      });
    });

    //重新上架ok
    $('#myGoods .goodlist').on('click', '.reupdate', function() {
      var that = this;
      var parentli = $(this).parents('li');
      var id = $(this).data('id');
      $.ajax({
        data: {
          id: id,
          status: 1
        },
        url: 'upGood',
        type: 'POST'
      }).success(function(data) {
        if (data == 'err') {
          var mes = new Message.Message({
            data: '请先登录',
            type: 'alert-warning'
          })
        } else if (data == 0) {
          var mes = new Message.Message({
            data: '操作异常',
            type: 'alert-danger'
          });

        } else {
          var mes = new Message.Message({
            data: '修改成功',
            type: 'alert-success'
          });
          var x = mygoods.renderOne(data[0]);
          parentli.replaceWith(x);
        }
      }).fail(function() {
        var mes = new Message.Message({
          data: '操作异常',
          type: 'alert-danger'
        });
      })
    });

    //暂时下架OK
    $('#myGoods .goodlist').on('click', '.temporary', function() {
      var that = this;
      var parentli = $(this).parents('li');
      var id = $(this).data('id');
      $.ajax({
        data: {
          id: id,
          status: 0
        },
        url: 'underGood',
        type: 'POST'
      }).success(function(data) {
        if (data == 'err') {

        } else if (data == 0) {
          var mes = new Message.Message({
            data: '操作异常',
            type: 'alert-danger'
          });

        } else {
          var mes = new Message.Message({
            data: '修改成功',
            type: 'alert-success'
          });
          var x = mygoods.renderOne(data[0]);
          parentli.replaceWith(x);
        }
      }).fail(function() {
        var mes = new Message.Message({
          data: '操作异常',
          type: 'alert-danger'
        });
      })
    });

    //删除
    $('#myGoods .goodlist').on('click', '.permanent', function() {
      var parentli = $(this).parents('li');
      var id = $(this).data('id');
      $.ajax({
        data: {
          id: id
        },
        url: 'delGood',
        type: 'POST'
      }).success(function(data) {
        console.log(data)
        if (data == 1) {
          parentli.remove();
          var mes = new Message.Message({
            data: '删除成功',
            type: 'alert-success'
          });

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
      }).fail(function() {
        var mes = new Message.Message({
          data: '操作异常',
          type: 'alert-danger'
        });
      })
    })

    //我的收藏
    $('[href="#myCollection"]').on('click', function() {
      var mycollection = new loadlist.loadList({
        el: $('#myCollection .goodlist'),
        url: 'myCollection',
        clearList: true
      })
    });


    //上传新货
    var flag6, flag7;
    v.keyupLimit({
      el1: $('[name=gooddetail]'),
      el2: $('.remainnum'),
      len: 160
    });

    $('[name=updateButton]').on('click', function() {
      flag6 = v.lenlimit({
        len: 30,
        el: $('[name=goodname]')
      });
      flag7 = v.lenlimit({
        len: 10,
        el: $('[name=goodprice]')
      });
      if (flag6 && flag7) {
        var r;
        if ($('[name=changeprice]').is(':checked')) {
          r = 1;
        } else {
          r = 0;
        }
        var loading = new loadingImg.loadingImg({
          el: $('.loading'),
          width: '100%',
          height: '100%',
          top: '0%',
          left: '0%'
        });
        loading.setPosition();
        $.ajaxFileUpload({
          url: 'update', //你处理上传文件的服务端
          secureuri: false,
          fileElementId: ['img1', 'img2', 'img3', 'img4', 'img5'],
          data: {
            'goodname': $('[name=goodname]').val(),
            'goodprice': $('[name=goodprice]').val(),
            'changeprice': r,
            'businesstype': $('[name=businesstype]:checked').val(),
            'goodtype': $('[name=goodtype]:checked').val(),
            'gooddetail': $('[name=gooddetail]').val()
          },
          dataType: 'json',
          type: 'POST',
          success: function(data) {
            loading.hide();
            data = JSON.parse(data);
            if (data == 1) {
              var mes = new Message.Message({
                data: '上传成功',
                type: 'alert-success'
              });
            } else if (data == 2) {
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
                data: JSON.parse(data),
                type: 'alert-warning'
              });
            }
          },
          error: function(data) {
            loading.hide();
            var mes = new Message.Message({
              data: '操作异常',
              type: 'alert-danger'
            });

          }
        })
      }



    });

    $('.systemli').on('click', function() {
      if ($(this).hasClass('onceClick')) {
        $(this).removeClass('onceClick');
        $.ajax({
          type: 'POST',
          url: 'changeFlag'
        }).success(function(data) {
          $('.systemli .badge').remove();
        }).fail(function(data) {
          var mes = new Message.Message({
            data: '操作异常',
            type: 'alert-danger'
          });
        })
      }
    });
  }


})