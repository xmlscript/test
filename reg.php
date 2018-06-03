<?php session_start()?>
<h1>注册新账号 - 客户端必须支持cookie，浏览器自动支持，而Qt/Android等需要http库</h1>
<p>如果客户端不支持cookie，则服务端白白浪费空间存储了无意义的文件
<p>必须防止同一个ip请求频率
<p>webapp跨域时，xhr必须转发cookie，否则无后续权限
<p>如果不支持cookie转发，会怎样？当时登录成功，跳转之后仍将是未登录状态？？？

<form action=/api/register method=post>
  <label>账号</label>
  <input name=username autofocus placeholder=手机号/用户名/email三选一>
  <p>手机号要回填code，email要有专用链接限时请求，而用户名则可以直接注册</p>
  <p>实时检测change事件，检测是否占用</p>
  <br>

  <label>密码</label>
  <input type=password name=password>
  <input type=password id=password placeholder=仅在js支持时出现>

  <p>
  <label>
  <input type=checkbox name=agree required>
  同意协议
  </label>

  <p>
  <input type=submit value=注册>
</form>


<p>已经有账号？<a href=login>立即登录</a></p>

<?=var_dump($_SESSION,$_COOKIE,session_id(),SID,session_name())?>
