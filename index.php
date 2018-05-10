<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?=md5(filemtime(__FILE__))?>

<script src=https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js></script>
<script src=http://res.wx.qq.com/open/js/jweixin-1.2.0.js></script>
<script>
$.ready(

  $.getJSON('/api.php',{url:location.href}, data=>{

    alert(JSON.stringify(data))

    wx.config(
      Object.assign(data, {jsApiList: [
        'checkJsApi',
        'openLocation',
        'getLocation',
      ]})
    );
  });

  wx.checkJsApi({jsApiList: ['openLocation','getLocation']},res=>{
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
        alert('被粉丝？拒绝位置授权 :(')
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

  wx.error(res=>{
    alert(JSON.stringify(res)) //SPA在此时可以更新签名
  })
)

</script>


