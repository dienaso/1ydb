<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tr{height:40px;line-height:40px}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>微信 登陆配置</b>
</div>
<div class="bk10"></div>
<div class="table_form lr10">	
<form action="" method="post" id="myform">
<table width="100%" class="lr10">
 

  <tr>
    <td>AppID(应用ID)</td>
    <td><input type="text" class="input-text wid150" name="appid" value="<?php echo $config['appid']; ?>"/></td>
  </tr>  
  <tr>
    <td>AppSecret</td>
    <td><input type="text" class="input-text wid250" name="secret"  value="<?php echo $config['secret']; ?>"/>
		
	</td>
  </tr> 
    <tr>
    <td>微信商户号</td>
    <td><input type="text" class="input-text wid250" name="wxid"  value="<?php echo $config['wxid']; ?>"/>
		
	</td>
  </tr> 
    <tr>
    <td>微信Key</td>
    <td><input type="text" class="input-text wid250" name="key"  value="<?php echo $config['key']; ?>"/>
	
	</td>
  </tr> 
   </tr> 
    <tr>
    <td>回调地址</td>
    <td><input type="text" class="input-text wid250" name="back"  value="<?php echo $config['back']; ?>"/>
	<a href="http://yungoutest.com/wxzn.html"  target="_blank" >设置指南</a>	
	</td>
  </tr>
	<tr>
    	<td width="100"></td> 
   		<td> <p>=====手机版微信登录设置=====</p></td>
    </tr>
</table>

<!--wap wxset-->
<table width="100%" class="lr10">
 

  <tr>
    <td>AppID(应用ID)</td>
    <td><input type="text" class="input-text wid150" name="mappid" value="<?php echo $config['mappid']; ?>"/></td>
  </tr>  
  <tr>
    <td>AppSecret</td>
    <td><input type="text" class="input-text wid250" name="msecret"  value="<?php echo $config['msecret']; ?>"/>
		
	</td>
  </tr> 
    <tr>
    <td>微信商户号</td>
    <td><input type="text" class="input-text wid250" name="mwxid"  value="<?php echo $config['mwxid']; ?>"/>
		
	</td>
  </tr> 
    <tr>
    <td>微信Key</td>
    <td><input type="text" class="input-text wid250" name="mkey"  value="<?php echo $config['mkey']; ?>"/>
	
	</td>
  </tr> 
   </tr> 
    <tr>
    <td>回调地址</td>
    <td><input type="text" class="input-text wid250" name="mback"  value="<?php echo $config['mback']; ?>"/>
	<a href="http://yungoutest.com/wxzn.html"  target="_blank" >设置指南</a>	
	</td>
  </tr>
	<tr>
    	<td width="100"></td> 
   		<td> <input type="submit" value=" 提交 " name="dosubmit" class="button"></td>
    </tr>
</table>
</form>

</div><!--table-form end-->

<script>	
</script>
</body>
</html> 