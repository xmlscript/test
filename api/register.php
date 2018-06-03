<?php

require '../vendor/autoload.php';

die(new class extends srv\api{

  function POST(){

    if(isset($_SESSION[\usr\usr::class]))
      throw new \Error('不允许重复注册',400);

    elseif(empty($_POST['agree']))
      throw new \Error('用户不同意协议',400);

    elseif(
      !isset($_POST['username'],$_POST['password']) ||
      is_array($_POST['username']) ||
      is_array($_POST['password'])
    )
      throw new \Error('缺少不正确',400);


    if(isset($_SESSION['code']))//FIXME 如果sess里有code，则POST里必须传入匹配的code
      if(empty($_POST['code']) || $_POST['code']!==$_SESSION['code'])
        throw new \Error('验证码不正确',400);

    if(isset($_POST['subscribe']));//TODO 可选的接受订阅，前提是必须提供email

    $to = isset($_SERVER['HTTP_REFERER'])?parse_url($_SERVER['HTTP_REFERER'],PHP_URL_QUERY):'/';

    if(isset($this->q($_SERVER['HTTP_ACCEPT'])['text/html']))
      header('Location: '.($to?:'/'));
    else
      http_response_code(201);

    return $_SESSION[\usr\usr::class]=\usr\usr::set($_POST['username'],$_POST['password']);
  }

});
