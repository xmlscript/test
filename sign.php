<?php

require 'vendor/autoload.php';

die(new class extends srv\api{

  function GET(string $url=''){
    return $url?header("Location: $url"):unset($_SESSION[\usr\usr::class]);
  }


  /**
   * @todo 错误N次之后自动出现captcha，并且冷却时间延长
   */
  function POST(){

    if(isset($_SESSION[\usr\usr::class]))
      throw new \Error('不允许重复登录',400);

    elseif(
      !isset($_POST['username'],$_POST['password']) ||
      is_array($_POST['username']) ||
      is_array($_POST['password'])
    )
      throw new \Error('缺少不正确',400);


    if(isset($_SESSION['code']))//FIXME 如果sess里有code，则POST里必须传入匹配的code
      if(empty($_POST['code']) || $_POST['code']!==$_SESSION['code'])
        throw new \Error('验证码不正确',400);

    //FIXME 此时才真正启用sess_file
    return $_SESSION[sign\usr::class]=sign\usr::get($_POST['username'],$_POST['password']);

  }

});
