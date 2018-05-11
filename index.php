<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?=md5(filemtime(__FILE__))?>
<?php
//require 'vendor/autoload.php';
//$token = new mp\token($_ENV['APPID'],$_ENV['SECRET']);
//$ticket = new wx\ticket($token,'jsapi');
//echo '<hr>';
//var_dump($token);
//echo '<br>';
//var_dump($ticket);
//echo '<hr>';
?>

<script src=https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js></script>
<script src=http://res.wx.qq.com/open/js/jweixin-1.2.0.js></script>
<script>
$(document).ready(()=>{

  $.getJSON('/api.php',{url:location.href.split('#')[0]}, json=>{

    let cfg = Object.assign(
        json,
        {jsApiList: [
        'checkJsApi',
        'openLocation',
        'getLocation'
      ]}
    )

    wx.config(cfg)

    wx.error(res=>{
      alert(JSON.stringify(res)) //SPA在此时可以更新签名
    })

    wx.checkJsApi({jsApiList: ['openLocation','getLocation']},res=>{

      alert(JSON.stringify(res))

      if(res.checkResult.openLocation === false)
        alert('不支持openLocation接口 :(')
      if(res.checkResult.getLocation === false)
        alert('不支持getLocation接口 :(')
    })

    wx.ready(res=>{

      wx.getLocation({
        success: res=>{
          let latitude = res.latitude;
          let longitude = res.longitude;
          let speed = res.speed;
          let accuracy = res.accuracy;
          alert(`latitude longitude`)
        },
        cacel: res=>{
          alert(JSON.stringify(res)+' cacel: 被粉丝？手动拒绝位置授权 :(')
        },
        error: res=>{
          alert(JSON.stringify(res)+' err') //SPA在此时可以更新签名
        }
      })

      wx.openLocation({
        latitude: 139,
        longitude: 42,
        name: 'where',
        address: 'addr',
        scale: 1,
        infoUrl: 'about:blank'
      })

    })

  });


})

</script>


