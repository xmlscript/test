<?php require 'vendor/autoload.php';
var_dump($_GET);

$token = wx\token::code($_ENV['APPID'],$_ENV['SECRET'],$_GET['code']);

var_dump("$token");

//var_dump(new wx\user($token));

