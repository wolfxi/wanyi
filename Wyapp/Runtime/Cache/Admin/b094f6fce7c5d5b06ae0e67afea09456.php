<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
  <title>万医|网站管理</title>
  <link rel="stylesheet" type="text/css" href="/wy/Public/Static//css/bootstrap.css"/>
  <style type="text/css">
      body{
        background-image: url(/wy/Public/Admin/img/background_img1.png);
      }
      .pading-top{
        margin-top: 5px;
      }
    </style>
</head>
<body>
  <div class="pading-top"></div>
  <div class="row">
    <div class="col-md-5">
      <img src="/wy/Public/Admin/img/logo.png" style="width:250px;height:85px;"/>
    </div>
    <div class="col-md-7">
      <div class="row">
         <div class="pull-right" style="margin-right:25px;">
          <a  class="btn btn-primary" id="clock" href="/wy/Admin/Admin/lock" target="_top">锁屏</a>
          <a  class="btn btn-primary" id="clock" href="/wy/Admin/Index/exitsystem" target="_top">退出系统</a>
          <a  class="btn btn-primary" id="clock" href="/wy/Admin/Index/home" target="_top">返回首页</a>
        </div>
      </div>
      <div class="row" style="margin-top:30px;margin-right:15px;">
        <div class="pull-right">
          <span class="pull-right" id="time"></span>
        </div>
      </div>
     
    </div>
  </div>

  <script type="text/javascript" src="/wy/Public/Static/js/jquery-1.11.0.js"></script>
  <script type="text/javascript" src="/wy/Public/Static/js/bootstrap.js"></script>
  <script type="text/javascript" src="/wy/Public/Admin/js/clock.js"></script>
   <script type=text/javascript>
    var clock = new Clock();
    clock.display(document.getElementById("time"));
</script>
</body>

</html>