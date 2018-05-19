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
    $token = new mp\token(getenv('APPID'),getenv('SECRET'));

    switch($str){
      case 'my':
        return $reply->text($reply->FromUserName);

      case 'tpl':
        try{
          return $reply->text($token->tpl()->send(
            $reply->FromUserName,
            'vdg4nAj17gWbPZEkrPH706PV3RRwmDG4cBxnHReLoxQ',
            'http://test-proj.1d35.starter-us-east-1.openshiftapps.com/env.php',
            [
              'first' => ['value'=>'FIRST嗒','color'=>'#ff00ff'],
              'aaa' => ['value'=>'AAA啊','color'=>'#ffcc33'],
              'bbb' => ['value'=>"BBB\n吧"],
              'Remark' => ['value'=>'REMARK咔😺','color'=>'#00ff00'],
            ]
          ));
        }catch(RuntimeException $e){
          return $e->getMessage();
        }

      case 'env':
        return $reply->text(getenv('APPID').' '.getenv('SECRET'));

      case 'token':
        return $reply->text($token);

      case 'ls':
        $media = new mp\media($token);
        $wc = $media->get_materialcount();
        return $reply->text(json_encode($wc));

      case 'menu':
        return $reply->text(new mp\menu($token));

      case 'w':
        try{
          return $reply->text((new mp\user($token))->info($reply->FromUserName)->nickname);
        }catch(RuntimeException $e){
          return $e->getMessage();
        }

      case 'img':
      case 'image':
        return $reply->image('i8OxLeDRD135otaPf5MyNFskcPkLJ9n-dqMDr_GqUtofJuuZyEgu5KNTaRuH5Os8');

      case 'err'://不等待5s超时，立刻造成错误输出
        return true;

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
        $a = $reply->article('抬头111','没有链接','','https://images0.cnblogs.com/i/340216/201403/071720052216404.png');
        return $reply->news($a);
      case 'news2':
        $a = $reply->article('','没链接没抬头的描述','','https://images0.cnblogs.com/i/340216/201403/071720052216404.png');
        return $reply->news($a);
      case 'news3':
        $a = $reply->article('','没链接没抬头没图片的描述');
        return $reply->news($a);
      case 'news4':
        $a = $reply->article('','','','https://images0.cnblogs.com/i/340216/201403/071720052216404.png');
        return $reply->news($a);
      case 'news5':
        $a = $reply->article();
        return $reply->news($a);
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
