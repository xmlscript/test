<?php
require 'vendor/autoload.php';

use cb\reply;

class ev extends cb\event{
  function scancode_waitmsg(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }
}

class msg extends cb\message{


  /**
   * 今天张了多少粉儿
   * 一共有多少粉儿
   * 服务器用量有多少？
   * 什么时候续费？
   * error_log日志有什么错误？
   * 获取当前正在使用的菜单和个性菜单
   * 管理员个性菜单可以直接看到管理选项
   * 获取微信服务器IP地址
   * 生成场景二维码
   * 生成短链接
   * 获取客服聊天记录
   * 
   */
  function text(reply $reply):?DOMDocument{

    $str = trim((string)$reply->Recognition?:(string)$reply->Content,"。！? \n\r\t\0");

    switch($str){
      case 'menu':
        $api = new invoke($_ENV['APPID'],$_ENV['SECRET']);
        return $reply->text(json_encode($api->menu()));
      case 'env':
        return $reply->text(session_save_path());
      case 'w':
        $name = mp\emit::construct($_ENV['APPID'],$_ENV['SECRET'])->whoami($reply->FromUserName);
        return $reply->text($name);
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
      case '【收到不支持的消息类型，暂无法显示】'://可能是个人名片
        return null;
      default:
        switch(mt_rand(1,10)){
          case 1:
            return $reply->text('听不懂1。要不要回复kf转接人工客服?');
          case 2:
            return $reply->text('听不懂2。要不要回复kf转接人工客服?');
          case 3:
            return $reply->text('听不懂3。要不要回复kf转接人工客服?');
          case 4:
            return $reply->text('听不懂4。要不要回复kf转接人工客服?');
          case 5:
            return $reply->text('听不懂5。要不要回复kf转接人工客服?');
          case 6:
            return $reply->text('听不懂6。要不要回复kf转接人工客服?');
          case 7:
            return $reply->text('听不懂7。要不要回复kf转接人工客服?');
          case 8:
            return $reply->text('听不懂8。要不要回复kf转接人工客服?');
          case 10:
            return $reply->text('听不懂9。要不要回复kf转接人工客服?');
          default:
            return $reply->text('听不懂default。要不要回复kf转接人工客服?');
        }
    }
  }


  /**
   * 有可能开通了语音识别
   */
  function voice(reply $reply):?\DOMDocument{
    return $this->text($reply);
    //TODO 考虑采用迅飞识别+迅飞语义分析
    return $reply->text($reply->Recognition);
  }


  /**
   * 用户主动发来的图片，很有可能是个表情图片，需要带着id自己去拉取
   * 注意！收不到表情包图片
   */
  function image(reply $reply):?\DOMDocument{
    return $reply->text($reply->MediaId);
  }


  /**
   * 临时存了个地方，需要带着id自己去拉取
   */
  function video(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }


  function shortvideo(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }


  /**
   * 主动发来的位置，不一定是当前位置（默认是）
   */
  function location(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }


  /**
   * 用户主动发来的链接
   */
  function link(reply $reply):?\DOMDocument{
    return $reply->text(__METHOD__);
  }

}


die(new cb\callback($_ENV['TOKEN'], new msg, new ev));
