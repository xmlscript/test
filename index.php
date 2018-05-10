<?php require 'vendor/autoload.php';
var_dump($_GET);
echo '<br>';

$token = wx\token::code($_ENV['APPID'],$_ENV['SECRET'],$_GET['code']);//TODO 做成api即可异步延迟请求

echo $token, '<br>';
echo $token->openid, '<br>';

//TODO 为了速度，公众号菜单入口只需要静默授权，通过openid保证唯一性
//TODO 此时将$token->openid存入数据库，作为单独用户出现，除非日后额外绑定手机号是再合并账户

//TODO 获取信息这一步骤，似乎没有战略意义，因为昵称头像等信息没有价值
var_dump(new wx\user($token));
?>

<script src=https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js></script>
<script src=http://res.wx.qq.com/open/js/jweixin-1.2.0.js></script>
<script>
wx.config(
  Object.assign(
    {appid: <?=$_ENV['APPID']?>},
    $.getJSON('/api.php',location.href)
  )
);
</script>


