<?php // vim: se fdm=marker:

require '../vendor/autoload.php';

session_start();

die(new class extends srv\api{

  function GET(){
    unset($_SESSION[usr\usr::class]);
    header('Location: /login');
  }


  function POST(){
    //FIXME 跨域xhr请求怎么办？cookie_ticket怎么传递？？？

    $valid_username = filter\input::POST('username')
      ->required()//可以不用，因为不存在自动转换为null，而null肯定不能通过numeric验证
      ->numeric();

    $valid_password = filter\input::POST('password')
      (strlen($_POST['password'])>8);

    $valid_remember = filter\input::POST('remember')
      ->eq('on',null);

    $valid_code = filter\input::POST('code')
      ->eq($_SESSION['captcha']??null);



    if(isset($this->q($_SERVER['HTTP_ACCEPT'])['text/html'])){#{{{

      try{

        if($freeze=sign\sess::freeze()){//还剩几秒
          header("X-RateLimit-Limit: $freeze");//指定时间内最大请求次数
          header("X-RateLimit-Remaining: $freeze");//指定时间内剩余请求次数
          header("Retry-After: $freeze");
          throw new Error('尝试过于频繁，等待 $freeze 秒之后再试',429);
        }

        if($valid_username->valid())
          $_SESSION['older']['aaa'] = "$valid_username";//raw
        else
          throw new Error('用户名要满足如下要求：长度3到32；必须是可见字符；不能包含控制符；不能包含空白符',400);

        if(!$valid_password->valid())
          throw new Error('密码提交之前都hash过，所以没办法要求什么，只能在客户端约束一下，至少应该是空字符串，但不能是null',400);

        if($valid_remember->valid())
          $_SESSION['older']['bbb'] = "$valid_remember";//raw
        else
          throw new Error('必须是等价的boolean值，其中on|true|1等都算true，其余false',400);

        if(!$valid_code->valid())
          throw new Error('应该是N位字符串，格式有效才能去比对sess',400);



        if($_SESSION[entity\usr::class]=entity\usr::get($_POST['username'],$_POST['password']))
          if(isset($_POST['remember']))
            setcookie('ticket','dslfkjdlsfjlds');

        sign\sess::clean();

        header('Location: /');

      }catch(Error $e){

        sign\sess::retry();

        return header('Location: /login');

      }


    }#}}}
    
    else{#{{{

      if(isset($_SESSION[entity\usr::class]))
        throw new Error('不允许重复登录');//FIXME 或者直接跳过，return 200即可

      new sign\sess(
        $valid_username,
        $valid_password,
        $valid_remember,
        $valid_code
      );

      if($_SESSION[entity\usr::class]=entity\usr::get($_POST['username'],$_POST['password']))
        if(isset($_POST['remember']))
          setcookie('ticket','dslfkjdlsfjlds');

      return ['code'=>0];

    }#}}}

    unset($_SESSION['captcha']);

  }

});
