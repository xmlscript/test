<?php
require 'vendor/autoload.php';

//header('Content-Type: application/json;charset=utf-8');
//die(json_encode(new wx\config(new mp\token($_ENV['APPID'],$_ENV['SECRET']),$_GET['url'])));


die((new class extends srv\api{
  function GET(string $url):wx\config{
    return new wx\config(new mp\token($_ENV['APPID'],$_ENV['SECRET']),$url);
  }
})());
