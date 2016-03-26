<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <title>川大跳蚤市场注册</title>
  <meta charset='utf-8'>
  <meta name="keywords" content="交易,跳蚤,川大,买,卖,出售" />
  <meta name="description" content="川大跳槽市场，专注买卖交易出售租赁活动" />
  <link rel="bookmark" href="/scumarket/favicon.ico"/>
  <link rel="shortcut icon" type="image/ico" href="/scumarket/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="/scumarket/Apps/Home/Public/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/scumarket/Apps/Home/Public/css/common/header.css">
  <script type="text/javascript" src="/scumarket/Apps/Home/Public/framework/require.js" data-main='/scumarket/Apps/Home/Public/js/register/registerapp'></script>
</head>
<body>
  <header class="topbar">
    <a href='<?php echo U('Index/index');?>' class="logo-link">
      <img alt="川大跳蚤市场" src="/scumarket/Apps/Home/Public/image/logo32.png"/>
      川大跳蚤市场
    </a>
    <div class="login-link">
      <span>我已注册，现在就&nbsp;</span>
      <a class="btn btn-default" href='<?php echo U("Index/index");?>'>返回主页</a>
    </div>
  </header>

  <div class="main-reg">
    <form class="form-horizontal" name="registerform">
      <div class="form-group has-feedback">
        <label  class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10">
          <input type="text" name="realname" class="form-control" placeholder="确保填写真实姓名"></div>
      </div>

      <div class="form-group  has-feedback">
        <label class="col-sm-2 control-label">昵称</label>
        <div class="col-sm-10">
          <input type="text" name='nickName' class="form-control" placeholder='(1-15位)'>
          <span class='isUsed' style="font-size: 12px;color: red;display: none;">已被占用</span>
        </div>
      </div>

      <div class="form-group  has-feedback">
        <label class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
          <input type="password" name='password' class="form-control" placeholder="密码(6-20位,支持英文/字母/下划线_)"></div>
      </div>

      <div class="form-group  has-feedback">
        <label class="col-sm-2 control-label">密码确认</label>
        <div class="col-sm-10">
          <input type="password" name='passwordOK' class="form-control" placeholder="密码确认"></div>
      </div>

      <div class="form-group  has-feedback">
        <label class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-10">
          <input type="text" name='phoneNum' class="form-control" placeholder="与您沟通的必要方式"></div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="isAgree">
              阅读并接受
              <a data-toggle="modal" data-target="#myModal">《租赁买卖协议》</a>
            </label>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="button" id="registerButton" class="btn btn-primary" style='width:200px;font-size:20px;'>注册</button>
        </div>
      </div>
    </form>

  </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">租赁买卖协议</h4>
      </div>
      <div class="modal-body">
      <p>川大跳蚤市场为所有人提供免费的服务平台。</p>
      <p>交易过程中出现的任何经济纠纷均与本网站无关，请注意您的交易安全。</p>
      <p>一切问题最终解释权归本网站所有。</p>
      <p>投诉方式：15682566795@163.com</p>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="关闭">      
      </div>
    </div>
  </div>
</div>
  <footer style="text-align: center;font-size: 12px;color:#ccc;margin-top:50px;">
    <p>2015©yysharebase.com</p>
    <p>互联网违法和不良信息举报电话：15682566795</p>
  </footer>

</body>
</html>