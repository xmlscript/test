<?php require 'vendor/autoload.php';
var_dump($_GET);
echo '<br>';

$token = wx\token::code($_ENV['APPID'],$_ENV['SECRET'],$_GET['code']);

echo $token, '<br>', $_SERVER['HTTP_REFERRER']??'noref', '<hr>';

//TODO 为了速度，公众号菜单入口只需要静默授权，通过openid保证唯一性

var_dump(new wx\user($token));

