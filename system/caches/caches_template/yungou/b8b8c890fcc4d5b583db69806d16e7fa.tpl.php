<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>﻿<footer class="footer">
	<div class="u-ft-nav" id="fLoginInfo">
	    <span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/">首页</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/about">什么是1元聚购?</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/user/login">登录聚购</a><b></b></span>
		<span><a href="<?php echo WEB_PATH; ?>/mobile/user/register">免费注册</a></span>
	</div>
	<?php 
		$g_web_path = _cfg("web_path");
		$g_web_path = trim($g_web_path,"/");		
	 ?>
<p class="m-ftA"><a href="http://app.yyjg.com/download/1yju_Android_build.apk">Android安卓版</a><a href="http://app.yyjg.com/download/1yju_iPhone_build.ipa
" target="_blank">iPhone苹果版</a><a href="http://www.yyjg.com/?PC_SEE=1" target="_blank">电脑网页版</a></p>
	<p class="grayc">电话<span class="orange">0818-2180826</span>Copyright&nbsp;©2013 - 2014&nbsp;一元聚购所有<br />&nbsp;陕ICP备13007407号&nbsp;达州市唯信网络科技有限公司&nbsp;<script src="http://s5.cnzz.com/stat.php?id=53403713&web_id=53403713" language="JavaScript"></script></p>
	<p><a href="<?php echo WEB_PATH; ?>/mobile/mobile/about">联系我们</a>&nbsp;&nbsp;<a href="<?php echo WEB_PATH; ?>/mobile/mobile/about">关于我们</a></p>
	<a id="btnTop" href="javascript:;" class="z-top" style="display:none;"><b class="z-arrow"></b></a>
</footer>
<br /><br /><br />
<div class="footerdi" style="bottom: 0px;">
	<ul>
		<li class="f_home">
			<a title="首页" href="<?php echo WEB_PATH; ?>/mobile/mobile/"><i>&nbsp;</i>首页</a>
		</li>
		<li class="f_whole">
			<a title="所有商品" href="<?php echo WEB_PATH; ?>/mobile/mobile/glist"><i>&nbsp;</i>所有商品</a>
		</li>
		<li class="f_jiexiao">
			<a title="最新揭晓" href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery"><i>&nbsp;</i>最新揭晓</a>
		</li>
		<li class="f_car">
			<a title="首页" href="<?php echo WEB_PATH; ?>/mobile/cart/cartlist"><i>&nbsp;</i>购物车</a>
		</li>
		<li class="f_personal">
			<a title="首页" href="<?php echo WEB_PATH; ?>/mobile/home"><i>&nbsp;</i>我的聚购</a>
		<li>
	</ul>
</div>