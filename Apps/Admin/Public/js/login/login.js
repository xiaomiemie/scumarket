define(['jquery', 'validate', 'comfn'], function($, validateForm, comfn) {
  var cf = new comfn.commonFn();
  cf.bwMatch();
  if (cf.jMeteor.browserName == 'msie' && parseInt(cf.jMeteor.browser.version) <= 8) {
    $('body').html('请使用Chrome，Firedox，Safari，IE9及以上版本等浏览器');

  } else {
    var v = new validateForm.validateForm();
    $('[type=button]').on('click', function() {

      var flag1, flag2;

      flag1 = v.requireText($('[name=username]'));
      flag2 = v.regex({
        el: $('[name=password]'),
        reg: /^[\w]{6,20}$/
      });
      if (flag1 && flag2) {
        $(this).prop('disabled', true);
        $.ajax({
          url: 'Login/login',
          data: {
            'username': $('[name=username]').val(),
            'password': $('[name=password]').val()
          },
          type: 'POST'
        }).success(function(data) {
          // console.log(data)
          if (data == false) {
            alert('用戶名或密碼不正確！');
            $('[type=button]').prop('disabled', false);
          } else {
            window.location.href = "/design/admin.php/Index/index.html";
          }
        }).fail(function() {
          alert('登陆异常');
          $('[type=button]').prop('disabled', false);
        });
      }
    })
  }

})