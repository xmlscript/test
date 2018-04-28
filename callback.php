<?php
require 'vendor/autoload.php';

use cb\reply;

class ev extends cb\event{
  function scancode_waitmsg(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }
}

class msg extends cb\message{


  function text(reply $reply):?DOMDocument{

    $str = trim((string)$reply->Recognition?:(string)$reply->Content,"。！? \n\r\t\0");

    switch($str){

      case 'w':
        try{
          $api = new mp\invoke($_ENV['APPID'],$_ENV['SECRET']);
          return $reply->text($api->whoami($reply->FromUserName)['nickname']);
        }catch(Throwable $e){
          return $reply->text($e->getCode.' '.$e->getMessage());
        }

      case 'env':
        return $reply->text($_ENV['APPID'].' '.$_ENV['SECRET']);

      case 'appid':
        try{
          $api = new mp\invoke($_ENV['APPID'],$_ENV['SECRET']);
          return $reply->text($api->appid());
        }catch(Throwable $e){
          return $reply->text($e->getCode.' '.$e->getMessage());
        }

      case 'token':
        try{
          $api = new mp\invoke($_ENV['APPID'],$_ENV['SECRET']);
          return $reply->text($api->token());
        }catch(Throwable $e){
          return $reply->text($e->getCode.' '.$e->getMessage());
        }

      case 'menu':
        $api = new mp\invoke($_ENV['APPID'],$_ENV['SECRET']);
        return $reply->text(json_encode($api->menu()));

      case 'w':
      case 'who':
      case 'whoami':
        try{
          $obj = mp\invoke::construct($_ENV['APPID'],$_ENV['SECRET'])->whoami($reply->FromUserName);
          return $reply->text($obj->nickname);
        }catch(Throwable $e){
          return $reply->text($e->getMessage());
        }

      case 'img':
      case 'image':
        return $reply->image('i8OxLeDRD135otaPf5MyNFskcPkLJ9n-dqMDr_GqUtofJuuZyEgu5KNTaRuH5Os8');

      case 'voice':
      case '你好':
        return $reply->text('从voice转换文字。。。');

      case 'view':
      case 'link':
        return $reply->text('http://140.143.54.195');

      case 'news':
        $a = $reply->article('xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','yyyyyyyyyyyyyyyyyyyyyyyyyyy','http://www.qq.com/',null);
        return $reply->news($a);

      case 'article':
        return $reply->article('抬头','描述','http://www.qq.com/','https://images0.cnblogs.com/i/340216/201403/071720052216404.png');

      case 'news1':
        return $reply->news('抬头111','没有链接','','https://images0.cnblogs.com/i/340216/201403/071720052216404.png');
      case 'news2':
        return $reply->news('','没链接没抬头的描述','','https://images0.cnblogs.com/i/340216/201403/071720052216404.png');
      case 'news3':
        return $reply->news('','没链接没抬头没图片的描述');
      case 'news4':
        return $reply->news('','','','https://images0.cnblogs.com/i/340216/201403/071720052216404.png');
      case 'news5':
        return $reply->news();
      case 'haha':
        return $reply->text('不许笑');
      case 'hello':
        return $reply->text('hello '.$reply->FromUserName.' you said "'.$reply->Content.'"');
      case 'bye':
        return $reply->text('再见');
      case 'noreply':
        return $reply->success();
      case 'kf':
        return $reply->transfer_customer_service();
      case '【收到不支持的消息类型，暂无法显示】':
        return null;
      default:
        switch(mt_rand(1,4)){
          case 1:
            return $reply->text('听不懂1。要不要回复kf转接人工客服?');
          case 2:
            return $reply->text('听不懂2。要不要回复kf转接人工客服?');
          case 3:
            return $reply->text('听不懂3。要不要回复kf转接人工客服?');
          default:
            return $reply->text('听不懂default。要不要回复kf转接人工客服?');
        }
    }
  }


  function voice(reply $reply):?\DOMDocument{
    return $this->text($reply);
    return $reply->text($reply->Recognition);
  }


  function image(reply $reply):?\DOMDocument{
    return $reply->text($reply->MediaId);
  }


  function video(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }


  function shortvideo(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }


  function location(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }


  function link(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }

}


die(new cb\callback($_ENV['TOKEN'], new msg, new ev));
