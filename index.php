<?php require 'vendor/autoload.php';
var_dump($_GET);

var_dump(new wx\user(wx\token::code($_ENV['APPID'],$_ENV['SECRET'],$_GET['code'])));

