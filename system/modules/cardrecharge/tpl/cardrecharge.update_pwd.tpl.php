<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>闪购系统卡密登陆</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/login.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/global.js"></script>
<style>
.login_index{ position:absolute; width:512px; height:344px;left:50%; top:220px; margin-left:-256px;}
.footer{ position:absolute; bottom:10px; width:100%; text-align:center; color:#ccc}
.login { 

	background-color:#ecebeb; position:absolute; width:451px; height:300px;opacity:1;filter:alpha(opacity=100);
	box-shadow:0px 0px 0px #b4641c; left:31px; top:23px;
}
.login_header{background-color:#9dcc5a;width:451px; height:25px;}
.login_header span{ display:inline-block; width:112px; height:25px;float:left;}
.login_header_span1{ background-color:#f17564;}
.login_header_span2{ background-color:#8ccfb3; border-right:3px solid #8ccfb3}
.login_header_span3{ background-color:#7298a6}
.login_header_span4{ background-color:#9dcc5a}

.login_title{ height:50px; line-height:50px; font-size:22px; color:#809eaa; text-align:center}

.login_form{width:451px; height:220px;}
.login_form li{ height:40px; line-height:40px; position:relative;}
.login_form span{margin:0px; display:inline-block; width:85px;line-height:40px; padding-left:40px; text-align:left;font-size:15px; color:#809eaa;}
.textinput{ border:1px solid #809eaa;font-size:15px; position:absolute;top:5px;width:160px; height:25px; color:#db9140;
			padding:0px 10px;background-color:#fff; line-height:25px;}
#form_but{ width:183px; height:44px; margin-top:10px; border:0px; overflow:hidden; cursor:pointer; line-height:44px; 
		 font-size:18px; color:#f17564;font-family: "微软雅黑",Arial,"宋体";
}
#checkcode{display:inline-block; position:absolute;right:145px; top:5px; cursor:pointer}

</style>
</head>
<body>
<div class="login_index">
    <div class="login">
        <div class="login_header">
            <span class="login_header_span1"></span>
            <span class="login_header_span2"></span>
            <span class="login_header_span3"></span>
            <span class="login_header_span4"></span>
        </div> 
   		<!--[if !IE]><!--><div class="login_yun1"></div><!--<![endif]-->
        <!--[if gte IE 8]><div class="login_yun1"></div><![endif]-->
        <div class="login_title">卡密登录 </div>
        <div class="login_form">
        <ul>
        <form action="" method="post" id="form">
        <li><span>卡密原密码:</span><input type="password" id="input-p" name="password" style="color:#8ccfb3;" class="textinput"  value="" /></li>
		 <li><span>卡密新密码:</span><input type="password" id="input-p" name="pwd" style="color:#8ccfb3;" class="textinput"  value="" /></li>
		  <li><span>确认新密码:</span><input type="password" id="input-p" name="truepwd" style="color:#8ccfb3;" class="textinput"  value="" /></li>
        <li><span></span><input name="sub" type="submit" id="form_but"  value="登录" /></li>
        </form>
        </ul>
        </div>
    </div><!--login end-->
</div><!--index end-->
<div class="footer">
Copyright ©  韬龙网络
</div>

</body>
</html> 
