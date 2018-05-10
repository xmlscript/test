<?php require 'vendor/autoload.php';
var_dump($_GET);
echo '<br>';

$token = wx\token::code($_ENV['APPID'],$_ENV['SECRET'],$_GET['code']);

echo $token, '<br>', $_SERVER['HTTP_REFERER']??$_SERVER['HTTP_REFERRER']??'no-ref', '<hr>';

//TODO 为了速度，公众号菜单入口只需要静默授权，通过openid保证唯一性
//TODO 此时将$token->openid存入数据库，作为单独用户出现，除非日后额外绑定手机号是再合并账户

//TODO 获取信息这一步骤，似乎没有战略意义，因为昵称头像等信息没有价值
var_dump(new wx\user($token,'en'));

