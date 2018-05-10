<?php
require 'vendor/autoload.php';

die((new class extends srv\api{
  function GET(string $url):stdClass{
    return new wx\config(new mp\token($_ENV['APPID'],$_ENV['SECRET']),$url);
  }
})());
