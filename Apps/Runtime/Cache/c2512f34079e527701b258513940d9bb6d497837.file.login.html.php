<?php /* Smarty version Smarty-3.1.6, created on 2015-11-20 09:48:13
         compiled from "./Apps/Home/View\Login\login.html" */ ?>
<?php /*%%SmartyHeaderCode:27492564e7bdd921db0-12962585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2512f34079e527701b258513940d9bb6d497837' => 
    array (
      0 => './Apps/Home/View\\Login\\login.html',
      1 => 1446953770,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27492564e7bdd921db0-12962585',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_564e7bddaf6a2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_564e7bddaf6a2')) {function content_564e7bddaf6a2($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
  <title>登录</title>
  <meta charset='utf-8'>
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/common/header.css">
  <script type="text/javascript" src="__PUBLIC__/framework/require.js" data-main='__PUBLIC__/js/login/loginapp'></script>
</head>
<body>
  <header class="topbar">
    <a href='index.html' class="logo-link">
      <!-- <img src=''/>
      -->
    川大租赁买卖信息共享网
    </a>
   
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
          <button type="button" class="btn btn-primary" style='width:200px;font-size:20px;'>登录</button>
        </div>
      </div>
    </form>

  </div>

  <footer style="text-align: center;font-size: 12px;color:#ccc;margin-top:50px;">2015©租赁买卖网</footer>

</body>
</html><?php }} ?>