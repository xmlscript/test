<?php
require 'vendor/autoload.php';

die((new class extends srv\api{
  function GET(string $url){
    return new wx\config(new mp\token(getenv('APPID'),getenv('SECRET')),$url);
  }
})());//TODO 还是__toString能省下不少敲击
