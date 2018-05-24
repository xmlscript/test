<?php

require 'vendor/autoload.php';

die(new class extends srv\api{

  function GET(int $w=150, int $h=40):void{

    if(isset($_SESSION['usr']))
      throw new \Error('多余请求',400);

    if(isset($_SERVER['HTTP_REFERER'])){//非网页客户端，需要手工构造refer
      switch(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_HOST)){
        case $_SERVER['HTTP_HOST']:
          header('Content-Type: image/png');
          $captcha = new Gregwar\Captcha\CaptchaBuilder;
          //$captcha->setBackgroundColor(255,255,255);
          $captcha->build($w,$h);
          $_SESSION['code'] = $captcha->getPhrase();//FIXME 提交POST请求地址必须在同一台主机上！！！
          $captcha->output(70);
          return;
      }
    }

    throw new \Error('站外请求',403);
  }

});
