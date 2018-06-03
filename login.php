<?php
require 'vendor/autoload.php';


  $valid_username = filter\input::POST('username')
    ->required()//可以不用，因为不存在自动转换为null，而null肯定不能通过numeric验证
    ->numeric();

  $valid_password = filter\input::POST('password')
    (strlen($_POST['password'])>8);

  $valid_remember = filter\input::POST('remember')
    ->eq('on',null);

  $valid_code = filter\input::POST('code')
    ->eq($_SESSION['captcha']??null);

  if($_SERVER['REQUEST_METHOD']==='POST')
    if(){
      //TODO unset($_SESSION[xxx]);
      die(header('Location: /'));
    }else{
      //TODO $_SESSION['xxx'] = '逐个将错误的name字段，raw，错误描述记录在sess'
      //TODO 如果验证user错误，则暂存到sess
      die(header('Location: /login'));
    }

session_start();
?>

<h1>登录</h1>

<?php if(sign\sess::freeze()):?>
  <mark>未处理，但跳转之后丢失了表单值。接口冻结时间剩余<?=sign\sess::freeze()?>秒 (最终取决于sess.cookie_life)</mark>
<?php endif?>


  剩余<?=sign\sess::retry()^sign\sess::N?>次
/
  现在第<?=sign\sess::retry()?>次
/
  共<?=sign\sess::N?>次

<?php if('有效性验证之后，如果db获取user错误'):?>
<?=$_SESSION['xxx']['msg']?>
<?php endif?>


<form action=/api/sign method=post>
  <label>账号</label>
  <input name=username autofocus placeholder=手机号/email/用户名 value="<?=$_SESSION['xxx']['username']??null?>">
<?=isset($_SERVER['xxx']['username'])?'用户名要满足如下要求：长度3到32；必须是可见字符；不能包含控制符；不能包含空白符':''?>
  验证混合格式有效，不管是否真实存在

  <br>
  <label>密码</label>
  <input type=password name=password>
<?=isset($_SERVER['xxx']['password'])?'密码提交之前都hash过，所以没办法要求什么，只能在客户端约束一下，至少应该是空字符串，但不能是null':''?>
  验证密码格式有效性(如果是短信验证码，无须手动提交)

<?php if(sign\sess::retry()>2):?>
  <p>
  <label>
    验证码
  <input name=code placeholder=5位验证码>
  </label>
  <img src=/api/code>
  <a>js控制单刷图片</a>
<?php endif?>

  <p>
  <label>
  <input type=checkbox name=remember <?=isset($_SESSION['xxx']['remember'])?'checked':''?>>
    在这台设备上直接登录
  </label>


  <p>
  <input type=submit value=登录>
</form>

<!--
<h3>其他登录方式</h3>
<ol>
  <li>手机号+密码
  <li>邮箱+密码
  <li>用户名+密码

  <li>微信扫一扫登录(未绑定就新建用户，已绑定就登录)
  <li>公众号内嵌页面跳转，code换openid直接登录
  <li>其他第三方登录
</ol>

<p>
<a href=reg.html>注册</a>

<p>
<a href=forgot.html>忘记密码？找回</a>

<h3>client要做的事</h3>
<ol>
  <li>保证各个提交项的格式正确，避免浪费传输时间和服务端算力，同时增强用户体验
  <li>必要时机显示出captcha
  <li>合理摆放各个设计元素，时之易用
</ol>
-->

<?=var_dump($_SESSION)?>
