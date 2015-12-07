<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>后台登陆</title>
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/login/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<style>
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
ol,ul{list-style:none;margin:0px;padding:0px;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
table{border-collapse:collapse;border-spacing:0;}
/* start editing from here */
a{text-decoration:none;}
.txt-rt{text-align:right;}/* text align right */
.txt-lt{text-align:left;}/* text align left */
.txt-center{text-align:center;}/* text align center */
.float-rt{float:right;}/* float right */
.float-lt{float:left;}/* float left */
.clear{clear:both;}/* clear float */
.pos-relative{position:relative;}/* Position Relative */
.pos-absolute{position:absolute;}/* Position Absolute */
.vertical-base{	vertical-align:baseline;}/* vertical align baseline */
.vertical-top{	vertical-align:top;}/* vertical align top */
nav.vertical ul li{	display:block;}/* vertical menu */
nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
img{max-width:100%;}
/*end reset*/
/****-----start-body----****/
body{
	background:#BDBDBD;
 	font-family: 'Open Sans', sans-serif;

}
.login-form {
	background:#eee;
	width: 26%;
	margin:9% auto 4% auto;
 	position: relative;
 	-webkit-border-radius: 0.4em;
	-o-border-radius: 0.4em;
	-moz-border-radius: 0.4em;
 	
}

.head {
	position: absolute;
	top:-15%;
	left: 35%;
}
.head img {
	border-radius:50%;
	-webkit-border-radius:50%;
	-o-border-radius:50%;
	-moz-border-radius:50%;
	border:6px solid rgba(221, 218, 215, 0.23);
}
.main{
	position:relative;
}
.main h1{
	font-size:25px;
	color:#676767;
	font-family: 'Open Sans', sans-serif;
	font-weight:400;
	padding-top: 19%;
	text-align: center;
}
.main form {
	width: 80%;
	margin: 0 auto;
	padding: 6% 0 9% 0;
}
.main p {
text-align: center;
}
.main form p a {
	color: #888;
	font-family: 'Open Sans', sans-serif;
}
form p a:hover {
	color:#21A957;
}
 input[type="text"], input[type="password"]{
	text-align:left;
	position: relative;
	width:92%;
	padding:3%;
	background:#D3D3D3;
	margin-bottom: 6%;
	font-family: 'Open Sans', sans-serif;
	color: #676767;
	font-weight:600;
	font-size: 16px;
	outline: none;
	border: none;
	border-radius: 5px;
	border:1px solid #DED6D6;
	-webkit-appearance:none;
}
 input[type="text"]:hover, input[type="password"]:hover{
 	border:1px solid #949494;
	transition:0.5s;
	-webkit-transition:0.5s;
	-moz-transition:0.5s;
	-o-transition:0.5s;
	-ms-transition:	0.5s;
 	
 }
input[type="submit"]{
	width: 99%;
	padding: 3%;
	margin-bottom: 8%;
	background: #21A957;
	font-family: 'Open Sans', sans-serif;
	color: #ECECEC;
	font-size: 20px;
	outline: none;
	border: none;
	cursor: pointer;
	font-weight:500;
	border-radius: 5px;
	transition: 0.5s;
	-webkit-appearance:none;
	-webkit-transition: 0.5s;
	-moz-transition: 0.5s;
	-o-transition: 0.5s;
	-ms-transition: 0.5s;
}
input[type="submit"]:hover{
	background:#128A42;
	color:#fff;
}
/****************/
.copy-right {
	color:#413C3C;
	position: absolute;
	bottom:-19%;
	left: 42.7%;
}
.copy-right a{
	color:#413C3C;

}
.copy-right p {
	color: #fff;
	font-size: 1em;
	font-family: 'Open Sans', sans-serif;	
	font-weight: 600;
}
.copy-right p a {
	font-family: 'Open Sans', sans-serif;	
	font-size: 1em;
	color:#21A957;
	-webkit-transition: all 0.3s ease-out;
	-moz-transition: all 0.3s ease-out;
	-ms-transition: all 0.3s ease-out;
	-o-transition: all 0.3s ease-out;
	transition: all 0.3s ease-out;
}
.copy-right p a:hover{
	color:#fff;
}
/*-----start-responsive-design------*/
@media (max-width:1440px){
	.login-form {
	width:30%;
	margin: 11% auto 4% auto;
	}
	.main h1 {
	padding-top: 23%;
	}
	.copy-right {
	bottom: -26%;
	}
}
@media (max-width:1366px){
	.login-form {
	width: 32%;
	margin: 10% auto 4% auto;
	}
}
@media (max-width:1280px){
	.login-form  {
		margin:8% auto 0;
		width:34%;

	}
	.copy-right {
	left: 41%;
	bottom:-18%;
	}
}
@media (max-width:1024px){
.login-form  {
		margin:12% auto 0;
		width:45%;
	
	}
	.copy-right {
	left: 41%;
	bottom:-18%;
	}
}
@media (max-width:768px){
	.login-form  {
		margin: 16% auto 0;
		width: 59%;
	}
	.copy-right {
	left:38%;
	bottom:-14%;
	}
}
@media (max-width:640px){                                  
	.login-form {
	margin: 20% auto 0;
	width: 63%;
	}
	.copy-right {
	left:36%;
	bottom:-18%;
	}
}
@media (max-width:480px){                                  
	.login-form {
	margin: 32% auto 0;
	width: 74%;
	
	}
	.copy-right {
	left:30%;
	bottom:-17%;
	}
	.main h1 {
	font-size: 22px;
	}
	.head img {
	width: 78%;
	}
	.head {
	top: -15%;
	left: 34%;
	}
	input[type="text"], input[type="password"], input[type="submit"] {
	font-weight: 600;
	margin-bottom: 4%;
	}
@media (max-width:320px){                                  
	.login-form  {
		margin:20% auto 0;
		width: 85%;
		
	
	}
	.main h1 {
	padding-top: 20%;
	font-size: 20px;
	}
	.head img {
	width: 60%;
	border: 5px solid rgba(221, 218, 215, 0.23);
	}
	.head {
	top: -15%;
	left: 36%;
	}
	input[type="text"], input[type="password"],input[type="submit"] {
	font-weight:600;
	font-size: 15px;
	}
	.main form p a {
	font-size: 15px;
	}
	input[type="button"] {
	padding: 4%;
	}
		
}

</style>
<style>

*{padding: 0px;margin: 0px;}
.top_div{
	background: #008ead;
	width: 100%;
	height: 400px;
}
.ipt{
	border: 1px solid #d3d3d3;
	padding: 10px 10px;
	width: 290px;
	border-radius: 4px;
	padding-left: 35px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
	-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s
}
.ipt:focus{
	border-color: #66afe9;
	outline: 0;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)
}
.u_logo{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/username.png") no-repeat;
	padding: 10px 10px;
	position: absolute;
	top: 43px;
	left: 43px;

}
.p_logo{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/password.png") no-repeat;
	padding: 10px 10px;
	position: absolute;
	top: 12px;
	left: 43px;
}
.code{
	padding: 10px 10px;
	position: absolute;
	top: 12px;
	left: 40px;
}
.coder
{
margin: 200px;


}
a{
	text-decoration: none;
}
.tou{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/tou.png") no-repeat;
	width: 97px;
	height: 92px;
	position: absolute;
	top: -87px;
	left: 140px;
}
.left_hand{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/left_hand.png") no-repeat;
	width: 32px;
	height: 37px;
	position: absolute;
	top: -38px;
	left: 150px;
}
.right_hand{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/right_hand.png") no-repeat;
	width: 32px;
	height: 37px;
	position: absolute;
	top: -38px;
	right: -64px;
}
.initial_left_hand{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/hand.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -12px;
	left: 100px;
}
.initial_right_hand{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/hand.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -12px;
	right: -112px;
}
.left_handing{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/left-handing.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -24px;
	left: 139px;
}
.right_handinging{
	background: url("<?php echo G_GLOBAL_STYLE; ?>/global/login/images/right_handing.png") no-repeat;
	width: 30px;
	height: 20px;
	position: absolute;
	top: -21px;
	left: 210px;
}

.code{
margin : -20px -1px 0px 204px;
}
</style>
</head>
<body>

	<div class="main">
		<div class="login-form">
			<h1>后台登录</h1>
			<div class="head"><img src="<?php echo G_GLOBAL_STYLE; ?>/global/login/images/user.png" alt=""/></div>
		 <form action="#" method="post" id="form">
				<input type="text" class="password" id="input-u" name="password" value="管理密码" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '管理密码';}" />
				
				<div class="submit">
				<input type="submit" id="form_but" value="登录" name="sub">
				
				</div>	
				
	 </form>
		</div>
		<div class="copy-right">版权所有 © 2014-2015 <a href="#" target="_blank">云购系统</a></div>
	</div>


</body>
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/global.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/layer/layer.min.js"></script>
<script type="text/javascript">
var loading;
var form_but;
window.onload=function(){
	
	 document.onkeydown=function(){
		if(event.keyCode == 13){
             ajaxsubmit();
        }          
	}
	form_but=document.getElementById('form_but');
	form_but.onclick=ajaxsubmit;	
	<?php if(_cfg("web_off")){ ?>
	var checkcode=document.getElementById('checkcode');	
	checkcode.src = checkcode.src + new Date().getTime();	
	var src=checkcode.src;
		checkcode.onclick=function(){
				this.src=src+'/'+new Date().getTime();
	}
   <?php } ?>
		
}

$(document).ready(function(){$.focusblur("#input-u");$.focusblur("#input-p");$.focusblur("#input-c");});

function ajaxsubmit(){
		var name=document.getElementById('form').username.value;
		var pass=document.getElementById('form').password.value;
		<?php if(_cfg("web_off")){ ?>
		var codes=document.getElementById('form').code.value;
	    <?php }else{ ?>
		var codes = '';
		<?php } ?>
		//document.getElementById('form').submit();
		$.ajaxSetup({
			async : false
		});				
		$.ajax({
			   "url":window.location.href,
			   "type": "POST",
			   "data": ({username:name,password:pass,code:codes,ajax:true}),
			   "beforeSend":beforeSend, //添加loading信息
			   "success":success//清掉loading信息
		});
	
}
function beforeSend(){
	 form_but.value="登录中...";
	 loading=$.layer({
		type : 3,
		time : 0,
		shade : [0.5 , '#000' , true],
		border : [5 , 0.5 , '#7298a6', true],
		loading : {type : 4}
	});
}

function success(data){
	layer.close(loading);
	form_but.value="登录";
	var obj = jQuery.parseJSON(data);
	if(!obj.error){	
		window.location.href=obj.text;
	}else{
		$.layer({
			type :0,
			area : ['auto','auto'],
			title : ['信息',true],
			border : [5 , 0.5 , '#7298a6', true],
			dialog:{msg:obj.text}
		});
		var checkcode=document.getElementById('checkcode');
		var src=checkcode.src;
			checkcode.src='';
			checkcode.src=src;
		}
}
</script>
<script type="text/javascript">
$(function(){
	//得到焦点
	$("#password").focus(function(){
		$("#left_hand").animate({
			left: "150",
			top: " -38"
		},{step: function(){
			if(parseInt($("#left_hand").css("left"))>140){
				$("#left_hand").attr("class","left_hand");
			}
		}}, 2000);
		$("#right_hand").animate({
			right: "-64",
			top: "-38px"
		},{step: function(){
			if(parseInt($("#right_hand").css("right"))> -70){
				$("#right_hand").attr("class","right_hand");
			}
		}}, 2000);
	});
	//失去焦点
	$("#password").blur(function(){
		$("#left_hand").attr("class","initial_left_hand");
		$("#left_hand").attr("style","left:100px;top:-12px;");
		$("#right_hand").attr("class","initial_right_hand");
		$("#right_hand").attr("style","right:-112px;top:-12px");
	});
});
</script>
</html>