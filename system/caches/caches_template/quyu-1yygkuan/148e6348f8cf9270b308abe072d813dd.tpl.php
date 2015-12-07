<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员登录-<?php echo _cfg('web_name_two'); ?></title>
    <meta name="Description" content="" />
    <link rel="stylesheet" type="text/css" href="../../../../css/sslComm.css?date=150713" />

    <link rel="stylesheet" type="text/css" href="../../../../css/layout.css?date=0617" />
    <script language="javascript" type="text/javascript" src="../../../../js/jQuery132.js"></script>
    <script id="pageJS" language="javascript" type="text/javascript" data="../../../../js/LoginFun.js"></script>

<script language="JavaScript">
var imgnum=3 //设置要显示的图片数，本例总共是5张。
function dispimg() //将几乎整个js脚本定义成一个函数dispimg()，为的是可以在<body>与<body>间随意地调用脚本、安排图片的显示位置。
{
var caution = false
function setCookie(name, value, expires, path, domain, secure)
{
var curCookie = name + "=" + escape(value) +
((expires) ? "; expires=" + expires.toGMTString() : "") +
((path) ? "; path=" + path : "") +
((domain) ? "; domain=" + domain : "") +
((secure) ? "; secure" : "")
if (!caution || (name + "=" + escape(value)).length <= 4000)
document.cookie = curCookie
else if (confirm("Cookie exceeds 4KB and will be cut!"))
document.cookie = curCookie
}

function getCookie(name)
{
var prefix = name + "="
var cookieStartIndex = document.cookie.indexOf(prefix)
if (cookieStartIndex == -1)
return null
var cookieEndIndex = document.cookie.indexOf(";", cookieStartIndex + prefix.length)
if (cookieEndIndex == -1)
cookieEndIndex = document.cookie.length
return unescape(document.cookie.substring(cookieStartIndex + prefix.length, cookieEndIndex))
}

function deleteCookie(name, path, domain)
{
if (getCookie(name))
{
document.cookie = name + "=" +
((path) ? "; path=" + path : "") +
((domain) ? "; domain=" + domain : "") +"; expires=Thu, 01-Jan-70 00:00:01 GMT"
}
}

function fixDate(date)
{
var base = new Date(0)
var skew = base.getTime()
if (skew > 0)
date.setTime(date.getTime() - skew)
}

var now = new Date()
fixDate(now)
now.setTime(now.getTime() + 365 * 24 * 60 * 60 * 1000)
var visits = getCookie("counter")
if (!visits)
visits = 1
else
{
visits = parseInt(visits) + 1
};
visits=((visits>imgnum)?visits=1:visits);
setCookie("counter", visits, now)

document.write("<link rel=stylesheet type=text/css href=../../../../css/",visits ,".css><br>");/*这里src=后面放图片地址，只写到图片所在文件夹名为止，图片的文件名由脚本自动填写。图片应连续编号,例如:1.jpg,2.jpg,...等*/
//上面有document...的这一行在不清楚js语法时，切不可随意打回车键擅自排版，以免破坏js语句的连续性导致脚本出错。
} //函数dispimg()结束。
</script>
<style>

#shift{
width:100%;
height: 100%;
}
.shift{
height:100%;
width: 100%;
}
</style>
</head>
<body>
<script type="text/javascript">
$(function(){
	var demo=$(".registerform").Validform({
		tiptype:2,
	});
})
</script>
    <div class="wrapper">
        <div class="g-logo-top g-logo-width">
      <a rel="nofollow" href="<?php echo WEB_PATH; ?>" class="transparent-png fl"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"></a>
      <span class="fr"><a href="<?php echo WEB_PATH; ?>">返回首页</a></span>
  </div>
   
		<form class="registerform" method="post" action="">
        <div class="g-login-con clrfix" id="g_login">

       	
		<script>dispimg();</script>
		
        
            <div class="m-login-screen clrfix">
			
                <div id="loadingpicblock" class="screen-left fl"></div>
                <div class="screen-right fr clrfix">
                    <div class="login-panel" id="loginform">
                        <dl>
                            <dt>
                                <em class="fl">登录</em>
                                <a id="hylinkregisterpage" tabindex="7" class="fr orange" href="<?php echo WEB_PATH; ?>/register">免费注册<i class="passport-icon"></i></a>
                            </dt>
                            <dd>
                                <div class="register-form-con clrfix">
                                    <ul>
                                        <li>
                                            <input id="username" type="text" maxlength="100" tabindex="1" autocomplete="off" name="username" />
                                            <b class="passport-icon user-name transparent-png"></b>
                                            <em style="display: none;">手机号/邮箱地址</em>
                                        </li>
                                        <li>
                                            <input name="password" id="pwd" type="password" maxlength="20" tabindex="2" value="" />
                                            <b class="passport-icon login-password transparent-png"></b>
                                            <em style="display: none;">密码</em>
                                        </li>
                                    </ul>
                                </div>
                            </dd>
                            <dd class="text-alignr">
                                <a id="hylinkgetpasspage" tabindex="3" class="gray9" href="<?php echo WEB_PATH; ?>/member/finduser/findpassword">忘记密码？</a>
                            </dd>
                            <dd class="error-message orange" style="display: none;" id="dd_error_msg"></dd>
                        </dl>
                        <p>
						
						<input id="btnsubmitlogin" name="submit" type="submit" value="登录" class="z-agreeBtn">
						</p>
                        <div class="other-login">
                            <span>使用其它方式快捷登录：</span>
                            <a href="<?php echo WEB_PATH; ?>/api/qqlogin/" class="qq-icon" tabindex="5"><b class="passport-icon transparent-png"></b></a>
                            <a id="wx_login_btn" href="<?php echo WEB_PATH; ?>/member/user/wxlogin" class="wx-icon" tabindex="6"><b class="passport-icon transparent-png"></b></a>
                        </div>
                        <ul id="j-tips-wrap" class="j-tips-wrap j-login-page">
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
		</form>
        <!-- 底部版权 -->
        <div class="g-copyrightCon clrfix">
       <div class="g-links">
           <a target="_blank" href="<?php echo WEB_PATH; ?>" title="首页">首页</a><s></s>
           <a target="_blank" href="<?php echo WEB_PATH; ?>/help/15" title="关于云购">关于迅磊</a><s></s>
           <a target="_blank" href="<?php echo WEB_PATH; ?>/help/13" title="隐私声明">隐私声明</a><s></s>
           <a target="_blank" href="<?php echo WEB_PATH; ?>/help/3">合作专区</a><s></s>
           <a target="_blank" href="<?php echo WEB_PATH; ?>/help/13" title="加入云购">加入迅磊</a><s></s>
           <a target="_blank" href="<?php echo WEB_PATH; ?>/help/18" title="联系我们">联系我们</a>
       </div>
       <div class="g-copyright">
           Copyright  &copy;2015  迅磊网络 版权所有  
       </div>
   </div>
   
   <script language="javascript" type="text/javascript">
       var Base = { head: document.getElementsByTagName("head")[0] || document.documentElement, Myload: function (B, A) { this.done = false; B.onload = B.onreadystatechange = function () { if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) { this.done = true; A(); B.onload = B.onreadystatechange = null; if (this.head && B.parentNode) { this.head.removeChild(B) } } } }, getScript: function (A, C) { var B = function () { }; if (C != undefined) { B = C } var D = document.createElement("script"); D.setAttribute("language", "javascript"); D.setAttribute("type", "text/javascript"); D.setAttribute("src", A); this.head.appendChild(D); this.Myload(D, B) }, getStyle: function (A, B) { var B = function () { }; if (callBack != undefined) { B = callBack } var C = document.createElement("link"); C.setAttribute("type", "text/css"); C.setAttribute("rel", "stylesheet"); C.setAttribute("href", A); this.head.appendChild(C); this.Myload(C, B) } }
       function GetVerNum() { var D = new Date(); return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0' : D.getMinutes().toString().substring(0, 1)) }
       Base.getScript('https://skin.1yyg.com/js/sslBottomfun.js?v=' + GetVerNum());
       var _gaq = _gaq || [];
       _gaq.push(['_setAccount', 'UA-26998441-1']);
       _gaq.push(['_setDomainName', '1yyg.com']);
       _gaq.push(['_addOrganic', 'soso', 'w']);
       _gaq.push(['_addOrganic', 'sogou', 'query']);
       _gaq.push(['_addOrganic', 'youdao', 'q']);
       _gaq.push(['_addOrganic', 'baidu', 'word']);
       _gaq.push(['_addOrganic', 'baidu', 'q1']);
       _gaq.push(['_addOrganic', '360', 'q']);
       _gaq.push(['_trackPageview']);
       (function () {
           var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
           ga.src = 'https://ssl.google-analytics.com/ga.js';
           var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
       })();
   </script>
   
    </div>
</body>
</html>
