<?php

require 'vendor/autoload.php';

die(new class extends srv\api{

  /**
   * 确认
   */
  function GET(string $ticket){

  }


  /**
   * 订阅，需要在email里GET确认
   */
  function POST(){

    if(isset($_POST['email'])){
      return ['msg'=>'OK'];
    }else throw new \Error('没有提供email地址',400);

  }

});
