define(['jquery', 'validate', 'comfn'], function($, validateForm, comfn) {
  var cf = new comfn.commonFn();
  cf.bwMatch();
  if (cf.jMeteor.browserName == 'msie' && parseInt(cf.jMeteor.browser.version) <= 8) {
    $('body').html('请使用Chrome，Firedox，Safari，IE9及以上版本等浏览器');

  } else {
    if (window.sessionStorage) {
      $('[name=nickName]').val(sessionStorage.getItem('nickname'))
      $('[name=password]').val(sessionStorage.getItem('password'))
    }
    var v = new validateForm.validateForm();
    $('[type=button]').on('click', function() {
      var flag1, flag2, f;
      if ($('[name=remainlogin]').is(':checked')) {
        f = 1;
      } else {
        f = 0;
      }
      flag1 = v.requireText($('[name=nickName]'));
      flag2 = v.regex({
        el: $('[name=password]'),
        reg: /^[\w]{6,20}$/
      });
      if (flag1 && flag2) {
        $(this).prop('disabled', true);
        var self = this;
        $.ajax({
          url: 'Login/login',
          data: {
            'nickname': $('[name=nickName]').val(),
            'password': $('[name=password]').val(),
            'flag': f
          },
          type: 'POST'
        }).success(function(data) {
          if (data == false) {
            alert('用戶名或密碼不正確！');
            $(self).prop('disabled', false);
          } else {
            window.location.href = "/design/index.php/Home/Index/index.html";
          }
        }).fail(function() {
          alert('登陆异常')
        });
      }
    })
  }

})