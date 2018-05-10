<?php
require 'vendor/autoload.php';

var_dump($_GET);

die(json_encode(new wx\config(new mp\token($_ENV['APPID'],$_ENV['SECRET']),$url)));


die;

die((new class extends srv\api{
  function GET(string $url):wx\config{
    return new wx\config(new mp\token($_ENV['APPID'],$_ENV['SECRET']),$url);
  }
})());
