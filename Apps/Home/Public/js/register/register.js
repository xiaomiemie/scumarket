define(['jquery', 'validate', 'message', 'comfn', 'bootstrap'], function($, validateForm, Message, comfn, bootstrap) {
  var cf = new comfn.commonFn();
  cf.bwMatch();
  if (cf.jMeteor.browserName == 'msie' && parseInt(cf.jMeteor.browser.version) <= 8) {
    $('body').html('请使用Chrome，Firedox，Safari，IE9及以上版本等浏览器');

  } else {
    var v = new validateForm.validateForm();
    var flag1, flag2, flag3, flag4, flag5, flag6, flag7, flag8;
    $('[name=nickName]').on('blur', function() {
      var el = $(this);
      var value = el.val();
      if (value != '') {
        $.ajax({
          type: 'GET',
          url: 'nickCheck',
          data: {
            nickName: value
          }
        }).success(function(data) {
          if (data == false) { //被占用
            el.next().show();
            el.parent().parent().addClass('has-error');
            flag6 = false;
          } else {
            el.next().hide();
            el.parent().parent().removeClass('has-error');
            flag6 = true;
          }
        }).fail(function() {
          var mes = new Message.Message({
            data: '出现异常',
            type: 'alert-danger'
          });
        })
      }
    });
    $('#registerButton').on('click', function() {
      flag1 = v.lenlimit({
        el: $("[name='realname']"),
        len: '4'
      });
      flag2 = v.regex({
        el: $('[name=password]'),
        reg: /^[\w]{6,20}$/
      });
      flag3 = v.regex({
        el: $('[name=passwordOK]'),
        reg: /^[\w]{6,20}$/
      });
      flag4 = v.checkEqual($('[name=password]'), $('[name=passwordOK]'));
      flag5 = v.requireCheck($('[name=isAgree]'));
      flag7 = v.lenlimit({
        el: $("[name='nickName']"),
        len: '15'
      });
      // 手机号
      flag8 = v.regex({
        el: $('[name=phoneNum]'),
        reg: /^[\d]{11}$/
      });

      if (flag1 && flag2 && flag3 && flag4 && flag5 && flag6 && flag7 && flag8) {
        // $(this).prop('disabled', true);
        $.ajax({
          url: 'Register/register',
          data: {
            'realname': $('[name=realname]').val(),
            'nickname': $('[name=nickName]').val(),
            'password': $('[name=password]').val(),
            'phonenum': $('[name=phoneNum]').val()
          },
          type: 'POST'
        }).success(function(data) {
          var mes = new Message.Message({
            data: '注册成功',
            type: 'alert-success'
          });
          if (window.sessionStorage) {
            sessionStorage.setItem('nickname', $('[name=nickName]').val());
            sessionStorage.setItem('password', $('[name=password]').val());
          }
          window.location.href = "/design/index.php/Home/login/index.html";
        }).fail(function() {
          var mes = new Message.Message({
            data: '操作异常',
            type: 'alert-danger'
          });
        });
      }
    })
  }

})