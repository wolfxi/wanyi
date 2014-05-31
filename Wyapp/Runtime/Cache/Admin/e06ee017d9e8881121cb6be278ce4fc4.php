<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>万医|网站管理</title>
  <link href="/wy/Public/Static/css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="/wy/Public/Admin/css/manager.css" rel="stylesheet" type="text/css"/>
  <link href="/wy/Public/Static/css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="/wy/Public/Static/js/html5.js" ></script>
  <style type="text/css" media="screen">
    body{
      background-image: url(/wy/Public/Admin/img/login_bg.jpg);
    }  
  </style>
</head>
<body>
  <div class="row">
    <div class="col-xs-6 col-md-6 col-md-offset-3">
      <div class="fenge"></div>
      <div class="fenge"></div>
      <div class="jumbotron color-white border-circle">
        <h2 class="text-center -font-family">万医 网站管理</h2>
        <div class="hrdivblack"></div>
        <form class="form-horizontal" role="form" onsubmit="return false;">
          <div class="fenge"></div>
          <div class="fenge"></div>

          <div class="form-group">
            <label for="useraccount" class="col-sm-2 control-label">账户：</label>
            <div class="col-md-8">
              <p class="input-group">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-user"></span>
                </span>
                <input type="text" class="form-control" id="useraccount" name="useraccount" placeholder="请输入账号">
                <label id="accounterror" class="input-group-addon small color-white">*</label>
              </p>
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">密码：</label>
            <div class="col-md-8">
              <p class="input-group">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-eye-close"></span>
                </span>
                <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                <label id="passworderror" class="input-group-addon small color-white">*</label>
              </p>
            </div>
          </div>

          <div class="form-group">
            <label for="verify_text" class="col-sm-2 control-label">验证码：</label>
            <div class="col-md-8">
              <p class="input-group">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-question-sign"></span>
                </span>
                <input type="text" class="form-control" id="verify_text" name="verify_text" placeholder="请输入验证码">
                <label id="verifyerror" class="input-group-addon small color-white">*</label>
              </p>
              <!--验证码 start-->
              <div id="verify" class="hide border-circle">
                <div class=" col-md-offset-2">
                  <img src="/wy/Admin/Index/create_verify" id="verify_img">
                  <span class="text-center">
                    <a href="javascript:void(0);" id="refresh">
                      看不清
                      <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                  </span>
                </div>

              </div>
              <!--验证码 end--> </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-9 col-sm-10">
              <button type="submit" class="btn btn-default nav-line-color" onclick="check_login();">
                <span class="glyphicon glyphicon-hand-down"></span>
                登录
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
    <!--留言表单 end--> </div>

</body>
  <script type="text/javascript" src="/wy/Public/Static/js/jquery-1.11.0.js"></script>
  <script type="text/javascript" src="/wy/Public/Static/js/bootstrap.js" ></script>
  <script src="/wy/Public/Static/js/jquery-ui-1.10.4.js" type="text/javascript"></script>
  <script src="/wy/Public/Static/js/ajaxhelper.js" type="text/javascript" ></script>
  <script src="/wy/Public/Static/js/jshelper.js" type="text/javascript" ></script>
  <script type="text/javascript" >
    $(function(){


      $("#verify_text").focus(function(){
        $("#verify").addClass('show');
      });

      $("#refresh").click(function(){
        var time=new Date().getTime();
        $("#verify_img").attr("src","/wy/Admin/Index/create_verify/"+time);
      });

      //检查是否存在账号
      $("#useraccount").blur(function(event) {
          var user_account=$("#useraccount").val();
          //console.log(user_account);
          if(user_account.length<=0){
            $("#accounterror").text("请填写账号");
          }else{
              var post_data={ account: user_account };
            ajaxhelper.post(post_data,'/wy/Admin/Index/check_account',call_check_account);
          }

      });

    $("#password").blur(function(event) {
        var  password=$("#password").val();
        if(password.length<=0){
          $("#passworderror").text('请填写密码');
        }else{
          $("#passworderror").text(" ").html("<span class='glyphicon glyphicon-ok'></span>");
        }
    });

    //验证码
    $("#verify_text").blur(function(event) {
        var verify_text=$("#verify_text").val();
        if(verify.length<=0){
          $("#verifyerror").text('请填写验证码');
          return 0;
        }else{
          var post_data={ verify_code: verify_text };
          ajaxhelper.post(post_data,'/wy/Admin/Index/check_verify',call_check_verify);
        }
    });



    });

    //验证码回调函数
    function call_check_verify(data){
      var flag=data.flag;
       if(flag==true){
        if(!data.message){
          $("#verifyerror").text(" ").html("<span class='glyphicon glyphicon-ok'></span>");
          return 0;
        }else{
          $("#verifyerror").text(data.message);
        }
      }else{
         $("#verifyerror").text(data.message);
      }
    }

    //检查账号回调函数
    function call_check_account(data){
      var flag=data.flag;
      if(flag==true){
        if(!data.message){
          $("#accounterror").text(" ").html("<span class='glyphicon glyphicon-ok'></span>");
          return 0;
        }else{
          $("#accounterror").text(data.message);
        }
      }else{
         $("#accounterror").text(data.message);
      }
    }


    function check_login(){
      var user_account=$("#useraccount").val();
      var  password=$("#password").val();
      var verify_text=$("#verify_text").val();
      if(user_account.length<=0 || password.length<=0 || verify_text.length<=0){
          helper.alert("请填写相关信息！！！");
      }else{
          var  post_data={ useraccount: user_account, password: password,verify_text:verify_text};
          ajaxhelper.post(post_data,'/wy/Admin/Index/loging',call_ckeck_login);
      }
    }

    function call_ckeck_login(data){
      var flag=data.flag;
      if(flag == true){
        var message=data.message;
        var url=data.url;
        console.log(typeof(url));
        if(url !="" && typeof(url)!="undefined"){
          jshelper.redirect(data.url);
        }else{
		  jshelper.show_message(data.msg);
          $("#useraccount").val("");
          $("#password").val("");
          $("#verify_text").val("");
        }
      }
    }

  </script>
</html>