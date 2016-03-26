<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>川大跳蚤市场后台登录</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="/scumarket/Apps/Admin/Public/framework/html5.js"></script>
  <!-- <script src="/scumarket/Apps/Admin/Public/framework/respond.min.js"></script>
-->
<!--[if lt IE 9]
      <script src="/scumarket/Apps/Admin/Public/framework/html5.js"></script>
<script src="/scumarket/Apps/Admin/Public/framework/respond.min.js"></script>
<![endif]-->
<link rel="bookmark" href="/scumarket/favicon.ico"/>
<link rel="shortcut icon" type="image/ico" href="/scumarket/favicon.ico">
<link rel="stylesheet" type="text/css" href="/scumarket/Apps/Admin/Public/css/login.css">
<link rel="stylesheet" type="text/css" href="/scumarket/Apps/Admin/Public/css/bootstrap.min.css">
<script type="text/javascript" src="/scumarket/Apps/Admin/Public/framework/require.js" data-main="/scumarket/Apps/Admin/Public/js/login/loginapp"></script>
</head>
<body>
<header class="login-header"><img src="/scumarket/Apps/Admin/Public/image/logo32.png"/>川大跳蚤市场后台登录</header>

<div class="login-form">
<form class="form-horizontal">
  <div class="form-group has-feedback">
    <label  class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control"></div>
  </div>
  <div class="form-group  has-feedback">
    <label class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" name='password' class="form-control" placeholder="密码"></div>
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