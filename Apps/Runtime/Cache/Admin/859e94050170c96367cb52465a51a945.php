<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>川大跳蚤市场后台主页</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="bookmark" href="/design/favicon.ico"/>
  <link rel="shortcut icon" type="image/ico" href="/design/favicon.ico">
  <link rel="stylesheet" type="text/css" href="/design/Apps/Admin/Public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/design/Apps/Admin/Public/css/index.css">
  <link rel="stylesheet" type="text/css" href="/design/Apps/Admin/Public/css/form.css">

  <!--[if lt IE 9]
      <script src="/design/Apps/Admin/Public/framework/html5.js"></script>
<script src="/design/Apps/Admin/Public/framework/respond.min.js"></script>
<![endif]-->

<script type="text/javascript" src="/design/Apps/Admin/Public/framework/require.js" data-main="/design/Apps/Admin/Public/js/index/indexapp"></script>

</head>
<body>

<div class="main-content">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"  class="active">
      <a href="#info"  role="tab" data-toggle="tab">信息列表</a>
    </li>
    <li role="presentation" class="onceClick">
      <a href="#user"  role="tab" data-toggle="tab">用户列表</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active clearfloat" id="info">
      <!-- 搜索 -->
      <div class="search">
        <input type="text" id='searchinfoinput' class="form-control input-radius" placeholder="关键词" />
        <button type="submit" class="btn btn-info" id="searchinfobutton" style="width:80px">搜索</button>
      </div>
      <!-- 列表 -->
      <ul class="goodlist"></ul>
    </div>

    <div role="tabpanel" class="tab-pane" id="user">
      <!-- 搜索 -->
      <div class="search">
        <input type="text" id='searchuserinput' class="form-control input-radius" placeholder="关键词" />
        <button type="submit" class="btn btn-info" id="searchuserbutton" style="width:80px">搜索</button>
      </div>
      <!-- 列表 -->
      <div class="user-table">
        <table class="table table-bordered table-responsive table-hover usertable">
          <thead>
            <tr>
              <td>用户名</td>
              <td>用户昵称</td>
              <td>操作</td>
            </tr>
          </thead>
          <tbody class="usertbody"></tbody>
        </table>
      </div>
      <nav id='nav-page'></nav>
    </div>
  </div>
</div>
<footer style="text-align: center;font-size: 12px;color:#ccc;margin-top:50px;">2015©川大跳蚤市场网</footer>
<div class="mask"></div>
<!-- 信息框 -->
<div class="main-dialog">
  <div class="panel panel-primary">
    <div class="panel-heading dialog-heading">
      向
      <span class="dialog-name"></span>
      发送私信
    </div>
    <div class="panel-body dialog-body">
      <textarea class="dialog-text"></textarea>
      <button class="btn btn-primary dialog-submit">发送</button>
      <button class="btn btn-primary dialog-close">关闭</button>
    </div>
  </div>
</div>
<header class="main-header">
  <ul>
    <?php if($_SESSION['username']!= ''): ?><li class='loginUserName'><?php echo (session('username')); ?></li>
      <li>
        <a href="<?php echo U('Login/logout');?>">退出</a>
      </li>
      <?php elseif(1): ?>
      <li style="width:50px">
        <a href=" <?php echo U('Login/index/');?>">登录</a>
      </li>
      <?php else: ?>
      <a href="<?php echo U('Login/index/');?>">登录1</a><?php endif; ?>
  </ul>
  <span>川大跳蚤市场后台主页</span>
</header>
</body>
</html>