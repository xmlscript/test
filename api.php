<?php
require 'vendor/autoload.php';

die((new class extends srv\api{
  function GET(string $url):wx\config{
    return new wx\config(new mp\token($_ENV['APPID'],$_ENV['SECRET']),$url);
  }
})());//TODO 还是__toString能省下不少敲击
