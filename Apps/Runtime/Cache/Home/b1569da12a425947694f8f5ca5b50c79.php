<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <title>川大跳蚤市场登录</title>
  <meta charset='utf-8'>
  <meta name="keywords" content="交易,跳蚤,川大,买,卖,出售" />
  <meta name="description" content="川大跳槽市场，专注买卖交易出售租赁活动" />
  <link rel="bookmark" href="/design/favicon.ico"/>
  <link rel="shortcut icon" type="image/ico" href="/design/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="/design/Apps/Home/Public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/design/Apps/Home/Public/css/common/header.css">
  <script type="text/javascript" src="/design/Apps/Home/Public/framework/require.js" data-main='/design/Apps/Home/Public/js/login/loginapp'></script>
</head>
<body>
  <header class="topbar">
    <a href='index.html' class="logo-link">
      <img src="/design/Apps/Home/Public/image/logo32.png" alt="川大跳蚤市场"/>
      川大跳蚤市场
    </a>
    <div class="login-link">
      <span>没账号?&nbsp;&nbsp;还不快去&nbsp;</span>
      <a class="btn btn-default" href='<?php echo U('Register/index');?>'>注册</a>
    </div>
  </header>

  <div class="main-reg">
    <form class="form-horizontal">
      <div class="form-group has-feedback">
        <label  class="col-sm-2 control-label">昵称</label>
        <div class="col-sm-10">
          <input type="text" name="nickName" class="form-control"></div>
      </div>
      <div class="form-group  has-feedback">
        <label class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
          <input type="password" name='password' class="form-control" placeholder="密码"></div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label class="control-label">
              <input type="checkbox" name="remainlogin"/>
              七天内自动登录
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="button" class="btn btn-primary" style='width:200px;font-size:20px;'>登录</button>
        </div>
      </div>
    </form>

  </div>

  <footer style="text-align: center;font-size: 12px;color:#ccc;margin-top:50px;">2015©川大跳蚤市场网</footer>

</body>
</html>