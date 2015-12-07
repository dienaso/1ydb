<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="360-site-verification" content="a80c40891b1bd8eae41813fe1ca5d9d0" />
<meta name="baidu-site-verification" content="bNvHFO12rY" />
<meta name="pinggu-site-verification" content="e5ab2b2099e18bdfe759dc89506c9c31" />
<meta property="wb:webmaster" content="9183e7a2512af61b" />
<title><?php if(isset($title)): ?><?php echo $title; ?>-一元聚购<?php  else: ?><?php echo _cfg("web_name"); ?><?php endif; ?></title>
<meta name="keywords" content="<?php if(isset($keywords)): ?><?php echo $keywords; ?><?php  else: ?><?php echo _cfg("web_key"); ?><?php endif; ?>" />
<meta name="description" content="<?php if(isset($description)): ?><?php echo $description; ?><?php  else: ?><?php echo _cfg("web_des"); ?><?php endif; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/Comm.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/kefu.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/indexlink.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/register.css"/>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.cookie.js"></script>
		<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/indexlink.js"></script>
		<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/zzc.js"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script src="http://mat1.gtimg.com/app/openjs/openjs.js#autoboot=no&debug=no"></script>
</head>
<body>
<!--<div style="width:100%;  text-align:center; background:#fb3657; height:40px; margin:0 auto;"><a href="http://www.yyjg.com/go/article/show/196.html" target="_blank"><img src="http://img.yyjg.com/images/huodong.jpg" border="0" alt="" width="980" height="40" /></a></div> -->

<!-- 代码部分begin -->
<div class="suspend">
	<dl>
		<dt class="IE6PNG"></dt>
		<dd class="suspendQQ"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=53403713&site=qq&menu=yes"></a></dd>
		<dd class="suspendTel"><a href="javascript:void(0);"></a></dd>
	</dl>
</div>
<!--
<SCRIPT LANGUAGE="JavaScript" src=http://float2006.tq.cn/floatcard?adminid=9454247&sort=2 ></SCRIPT>-->
<script type="text/javascript">           
$(function(){
	$(".suspend").mouseover(function() {
        $(this).stop();
        $(this).animate({width: 160}, 400);
    });
    $(".suspend").mouseout(function() {
        $(this).stop();
        $(this).animate({width: 40}, 400);
    });
});
</script>
<!-- 代码部分end -->
<script> 
jQuery(function() {
		//Set the popup window to center
		var COOKIE_NAME = "mode";
		if( $.cookie(COOKIE_NAME)){
			$("#indexheadpopup").hide();
		}else{
		   var winH = $(window).height();
		   var winW = $(window).width();
		  $("#indexheadpopup").css({'top': winH/2-$("#indexheadpopup").height()/2,'left': winW/2-$("#indexheadpopup").width()/2 });
	        //$("#indexheadpopup").slideDown(1000, function() {
	        //setTimeout("ClearIndexHeadPopup()", '3000000');
	        //});
	     // $.cookie(COOKIE_NAME,"mode", {path: '/', expires: 1});
		}
    });
function ClearIndexHeadPopup() {
	     $('#indexheadpopup').hide();
	        
}
</script>
<div id="indexheadpopup" >
<!-- <div style="width:960px; margin:0px auto;"><a href="http://www.yyjg.com/single/pleasereg" ><img alt="1元聚购头部广告" src="http://img.yyjg.com/images/topflash.jpg"></a> -->
<div style="position:absolute;right:236px;top:10px;"><a href="javascript:;" onclick="indexheadpopup.style.display='none'">关闭</a></div></div>
</div>

<div class="header">
	<div class="site_top">
		<div class="head_top">
		<p class="collect"><a href="javascript:;" id="addSiteFavorite">收藏<?php echo _cfg("web_name_two"); ?></a></p>		
<!--<p class="weiboindex"><wb:follow-button uid="5340734130" type="red_1" width="67" height="24" ></wb:follow-button></p>
<div  class="weiboindex" id="qqwb_share__" data-appkey="801548894" data-icon="1" data-counter="0" data-content="{title}" data-pic="{pic}"></div>-->
<p class="Ht-qqicon"><a style="text-indent:0em; background:none;width:160px;"  rel="nofollow" href="<?php echo WEB_PATH; ?>/group_qq">官方QQ群</a></p>
<p class="renwu"><a href="#" id="zqjf_box_btn">做任务拿红包</a></p>
		<ul class="login_info" style="display: block;">
		<?php if(get_user_arr()): ?>
			<li class="h_wel" id="logininfo">
				<a href="<?php echo WEB_PATH; ?>/member/home.html" class="gray01" >					
					<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_img('3030'); ?>" width="30" height="30"/>					
					<?php echo get_user_name(get_user_arr(),'username'); ?>
				</a>&nbsp;&nbsp;
				<a href="<?php echo WEB_PATH; ?>/member/user/cook_end.html" class="gray01">[退出]</a>
			</li>
			<?php  else: ?>
<li><span id="qq_login_btn"><a href="<?php echo WEB_PATH; ?>/api/qqlogin/.html"><img src="http://img.yyjg.com/images/qq/qq_login_4.gif" alt="1元聚购QQ登录yyjg.com" /></a></span> </li>
			<li id="logininfo" class="h_login">			
				<a class="gray01" href="<?php echo WEB_PATH; ?>/login/inex.html" >请登录&nbsp;&nbsp;</a>
				<a class="gray01" href="<?php echo WEB_PATH; ?>/register/inex.html" ><font color="black">免费注册</font></a>
			</li>
			<?php endif; ?>
			<li class="h_1yyg">
				<a  href="<?php echo WEB_PATH; ?>/home/member">我的帐户<b></b></a>
				<div class="h_1yyg_eject" style="display:none;">
					<dl>
						<dt><a  href="<?php echo WEB_PATH; ?>/member/home.html">用户中心<i></i></a></dt>
						<dd><a  href="<?php echo WEB_PATH; ?>/member/home/userbuylist.html">聚购记录</a></dd>
						<dd><a  href="<?php echo WEB_PATH; ?>/member/home/orderlist/index.html">获得的商品</a></dd>
						<dd><a  href="<?php echo WEB_PATH; ?>/member/home/userrecharge.html">帐户充值</a></dd>
						<dd><a  href="<?php echo WEB_PATH; ?>/member/home/modify.html">个人设置</a></dd>
					</dl>
				</div>
			</li>
                                                <li class="h_help"><a href="http://app.yyjg.com/mobile.html" target="_blank">手机版</a></li>										
			<li class="h_help"><a href="<?php echo WEB_PATH; ?>/help/1" target="_blank">帮助</a></li>
			<li class="h_inv"><a target="_blank" href="<?php echo WEB_PATH; ?>/single/lianxikefu.html"><img border="0" src="images/pa" style="display:none;">在线客服</a></li>
		<!--	<li class="h_tel"><b><?php echo _cfg("cell"); ?></b></li>  -->
		</ul>
		</div>
	</div>
	<div class="head_mid">
		<div class="head_mid_bg">
<!--<s style="background:url( http://img.yyjg.com/Images/menuimg/huo.gif) no-repeat; display:block; width:20px; height:15px; position:absolute; left:380px; top:101px; z-index:50;"></s>--><s style="background:url( http://img.yyjg.com/Images/menuimg/HOT.png) no-repeat; display:block; width:25px; height:15px; position:absolute; left:860px; top:101px; z-index:50;"></s>	
<h1 class="logo_1yyg">
				<a class="logo_1yyg_img" href="<?php echo G_WEB_PATH; ?>/" title="<?php echo _cfg('web_name'); ?>">
					<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo Getlogo(); ?>"/>
				</a>
			</h1>
			<!--<div class="newbie_guide"><a title="什么是一元聚购？" id="whatIsThis" href="javascript:void(0)" ><img style="zoom: 1;" src="http://img.yyjg.com/images/logo_banner_beta.gif"  /></a> </div>-->

		<div class="mini_mycart" id="sCart">
			<a rel="nofollow" href="<?php echo WEB_PATH; ?>/member/cart/cartlist" class="w-miniCart-btn">
				<i class="icoo ico-miniCart"></i>结算
				<b class="w-miniCart-count" id="pro-view-3">
					<i class="ico ico-arrow-white-solid ico-arrow-white-solid-l"/></i><span id="sCartTotal">0</span>
				</b>
			</a>
 			<div class="mycart_list" id="sCartlist" style="z-index: 99999; display: none;">
				
 				<div class="goods_loding" id="sCartLoading" style="display: none;"><img border="0" alt="" src="<?php echo G_TEMPLATES_STYLE; ?>/images/goods_loading.gif">正在加载......</div>
 				<p id="p1">共计 <span id="sCartTotal2"> 2</span> 件商品 金额总计：<span id="sCartTotalM" class="rmbred">5.00</span></p>
 				<h3><input type="button" id="sGotoCart" value="去购物车并结算"></h3>
 			</div>
 		</div>
			<div class="head_search">
						<div class="keySearch">
					<a href="<?php echo WEB_PATH; ?>/s_tag/苹果" target="_blank">苹果</a>
					<a href="<?php echo WEB_PATH; ?>/s_tag/iPhone" target="_blank">iPhone</a>
					<a href="<?php echo WEB_PATH; ?>/s_tag/智能手机" target="_blank">智能手机</a>
					<a href="<?php echo WEB_PATH; ?>/s_tag/G手机" target="_blank">3G手机</a>
					<a href="<?php echo WEB_PATH; ?>/s_tag/宝马" target="_blank">宝马</a>
					<a href="<?php echo WEB_PATH; ?>/s_tag/单反" target="_blank">单反</a>            
				</div>
				<input type="text" id="txtSearch" class="init" value='输入"IPhone"试一试'/>
				<input type="button" id="butSearch" class="search_submit" value="搜索"/>

			</div>
		</div>
	</div>
	<div class="head_nav">
 	<div class="nav_center f-clear">
		<div class="m-catlog">
		     <div class="m-catlog-hd"><a href="<?php echo WEB_PATH; ?>/goods_list/index.html"><h2>奖品分类</h2></a><i class="ico ico-arrow ico-arrow-white ico-arrow-white-down"></i></div>
			 <div class="m-catlog-wrap">
				<div class="m-catlog-bd">
					<ul class="m-catlog-list">
					<!--<li><a href="<?php echo WEB_PATH; ?>/goods_list/index.html">全部奖品</a></li>-->
					<?php $data=$this->DB()->GetList("select * from `@#_category` where `model`='1' and `parentid` = '0' order by `order`
			 desc",array("type"=>1,"key"=>'',"cache"=>0)); ?>
					<?php $ln=1;if(is_array($data)) foreach($data AS $categoryx): ?>
					<li><a href="<?php echo WEB_PATH; ?>/goods_list/<?php echo $categoryx['cateid']; ?>/index.html"><?php echo $categoryx['name']; ?></a></li>
					<?php  endforeach; $ln++; unset($ln); ?>
					<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
					
					</ul>
				</div>
				<div class="m-catlog-ft"></div>
			 </div>
		</div>
		<div class="m-menu">
			<ul class="m-menu-list">
				<li class="selected" ><a href="<?php echo G_WEB_PATH; ?>">首页</a></li>
				<?php echo Getheader('index'); ?>
			</ul>
		</div>
 		<!-- <div class="mini_mycart" id="sCart">
 			<input type="hidden" id="hidChanged" value="0"/>
 			<a id="sCartNavi" class="cart"><s></s>购物车<span id="sCartTotal">0</span></a>
			<a href="<?php echo WEB_PATH; ?>/member/cart/cartlist" target="_blank" class="checkout">去结算</a>
 		</div> -->

				<style type="text/css">
				
					
				</style>

					<div class="m-joinNum r">
					<a href="<?php echo WEB_PATH; ?>/buyrecord" target="_blank"> 
						<input type="hidden" value="<?php echo go_count_renci(); ?>">
						<span class="qian text">已</span>
						<span class="hou text">人参加</span> 
					 </a> 
					
				</div>
			<!--	<div class="m-nav-promot">
					<a href="http://www.yyjg.com/goods/17777.html" target="_blank" ><img width="230" height="45" src="http://img.yyjg.com/help/iphone6plus.jpg" complete="complete"/></a>
				</div> -->

					<!-- 人次参与 -->
				<script type="text/javascript">
					var WEB_PATH = '<?php echo WEB_PATH; ?>';
					var G_WEB_PATH = '<?php echo G_WEB_PATH; ?>';
					var WEB_NAME = '<?php echo _cfg("web_name"); ?>';
					// 总汇购人次
					function updateTotal(total){
						var lastTotalLength = $('.m-joinNum .tnum').length;
						var newTotalArr = total.split('');

						if (newTotalArr.length > lastTotalLength) {	// 补位
							if (lastTotalLength == 0) {
								var count = newTotalArr.length;
								var obj = $('.m-joinNum .hou');
							} else {
								var count = newTotalArr.length - lastTotalLength;
								var obj = $('.m-joinNum .tnum').eq(0);
							}
							for (var i = 0; i < count; i++) {
								var _tmpNum = '<span class="tnum"><ul><li>9</li><li>8</li><li>7</li><li>6</li><li>5</li><li>4</li><li>3</li><li>2</li><li>1</li><li>0</li></ul></span>';
								obj.before(_tmpNum);
							};
						};

						for (var i = 0; i < newTotalArr.length; i++) {	// 调整数字
							$('.m-joinNum .tnum ul').eq(i).css('margin-top', -270).animate({
								marginTop : 0 - ((9 - newTotalArr[i]) * 30)
							}, 1000)
						};
						// 记录当前人次
						$('.m-joinNum input').val(total);
					}

					if ($('.m-joinNum').length > 0) {
						var huiTotal = $('.m-joinNum input').val();
						huiTotal=huiTotal
						updateTotal(huiTotal);	// 首次更新

						var _totalTime = setInterval(function (){
							$.ajax({
								url:WEB_PATH + '/api/wujing/getTotal',
								success:function(e){
									updateTotal(e);
								}
							})
						}, 30000)
					};
				</script>
		
 	</div>
</div>
</div>
<!--header end-->
<script type="text/javascript"> 
   $(function(){
	$(".m-catlog-hd").hover(
		function(){			
			$(".m-catlog-wrap").show();
			//$(".ico-arrow-white-down").remove();
			//$(".ico-arrow-white").addClass(".ico-arrow-white-up");
			$(".m-catlog-wrap").hover(function(){
				$(".m-catlog-wrap").show();
			},
			function(){
			$(".m-catlog-wrap").hide();
		}
			);
		},
		function(){
			$(".m-catlog-wrap").hide();
		}
	);
})
</script> 
<script>
$(function(){
	$("#sCart").hover(
		function(){			
			$("#sCartlist,#sCartLoading").show();
			$("#sCartlist p,#sCartlist h3").hide();
			$("#sCart .mycartcur").remove();
			$("#sCartTotal2").html("");
			$("#sCartTotalM").html("");
			$.getJSON("<?php echo WEB_PATH; ?>/member/cart/cartheader/="+ new Date().getTime(),function(data){
				$("#sCart .mycartcur").remove();
				$("#sCartLoading").before(data.li);
				$("#sCartTotal2").html(data.num);
				$("#sCartTotalM").html(data.sum);
				$("#sCartLoading").hide();
				$("#sCartlist p,#sCartlist h3").show();
			});
		},
		function(){
			$("#sCartlist").hide();
		}
	);
	$("#sGotoCart").click(function(){
		window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist";
	});
})
function delheader(id){
	var Cartlist = $.cookie('Cartlist');
	var info = $.evalJSON(Cartlist);
	var num=$("#sCartTotal2").html()-1;
	var sum=$("#sCartTotalM").html();
	info['MoenyCount'] = sum-info[id]['money']*info[id]['num'];
		
	delete info[id];
	//$.cookie('Cartlist','',{path:'/'});
	$.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
	$("#sCartTotalM").html(info['MoenyCount']);
	$('#sCartTotal2').html(num);
	$('#sCartTotal').text(num);											
	$('#btnMyCart em').text(num);
	$("#mycartcur"+id).remove();
}
$(function(){
	$(".h_1yyg").mouseover(function(){
		$(".h_1yyg_eject").show();
	});
	$(".h_1yyg").mouseout(function(){
		$(".h_1yyg_eject").hide();
	});
	$(".h_news").mouseover(function(){
		$(".h_news_down").show();
	});
	$(".h_news").mouseout(function(){
		$(".h_news_down").hide();
	});
});
$(function(){
	$("#txtSearch").focus(function(){
		$("#txtSearch").css({background:"#FFFFCC"});
		var va1=$("#txtSearch").val();
		if(va1=='输入"IPhone"试一试'){
			$("#txtSearch").val("");
		}
	});
	$("#txtSearch").blur(function(){
		$("#txtSearch").css({background:"#FFF"});
		var va2=$("#txtSearch").val();
		if(va2==""){
			$("#txtSearch").val('输入"IPhone"试一试');
		}			
	});
	$("#butSearch").click(function(){
		window.location.href="<?php echo WEB_PATH; ?>/s_tag/"+$("#txtSearch").val();
	});
});
</script>
<style> 

</style>
<div class="zqjf-box" id="zqjf_box" style="display: none;">
    <h2>
		<a href="#" class="zqjf-box-close"><img src="http://img.yyjg.com/help/close-login.png"></a>
		做任务拿红包
		<span style="font-size: 12px;font-family: 'Microsoft yaHei';color: #fc3571; "> (1000夺宝币=1元)</span>
	</h2>
	<div class="zqjf-con">
		<ul style="height: 381px;overflow-y: scroll;">
			<li>
				<h3><span class="num_span">1</span>每日签到,领取 <b class="credit_b">300夺宝币</b><a href="javascript:void(0)" onclick="$('#sign .sign a.close').click()">马上签到</a></h3>
			</li> 
			<li>
				<h3><span class="num_span">2</span>绑定微信,领取 <b class="credit_b">1元现金红包</b><a href="#" onclick="alert('使用微信扫描下方二维码，点击关注，然后在对话框中直接输入(绑定+您的聚购帐号,如：绑定123456@qq.com;绑定135333333，账号只能是手机号码或者邮箱地址),然后点击发送！')">如何领取</a><a href="http://www.yyjg.com/go/article/show/211.html" target="_blank">查看操作步骤</a></h3>
				<p class="p_con"><img src="http://img.yyjg.com/help/weixin.jpg" /></p>
			</li>
			<li>
				<h3><span class="num_span">3</span>单笔充值每满100元，有一次机会获得 <b class="credit_b">1111元现金红包</b><a href="/member/home/userrecharge" target="_blank">马上充值</a></h3>
				<p class="p_con">100%中奖！最少5元现金红包！&nbsp;<a href="/Roulette/index.html" target="_blank">查看详情</a></p>
			</li>
			<li>
				<h3><span class="num_span">4</span>邀请好友，赚取 <b class="credit_b">6%现金赏金</b><a href="/single/pleasereg" target="_blank">查看详情</a></h3>
				<p class="p_con">邀请一位好友即可获得500夺宝币，还可获得6%的好友充值提成，永久有效！&nbsp;<a href="/single/pleasereg" target="_blank">查看详情</a></p>
			</li>
 			<li>
				<script src="http://qzonestyle.gtimg.cn/qzone/app/qzlike/qzopensl.js#jsdate=20111201" charset="utf-8"></script>
				<h3><span class="num_span">5</span>分享到QQ空间,领取 <b class="credit_b">1元现金红包</b>
					<script type="text/javascript">
					(function(){
					var p = {
					url:"http://www.yyjg.com/register/<?php echo get_user_uid(); ?>",
					showcount:'0',/*是否显示分享总数,显示：'1'，不显示：'0' */
					desc:'我发现一个很好玩的网站，居然1元就能买到iphone6，快去看看吧！http://www.yyjg.com/register/<?php echo get_user_uid(); ?>',/*默认分享理由(可选)*/
					summary:'一元聚购是一种全新的一元购网站,这里有最潮流的数码产品,生活用品,低价尝试,惊喜回报,是娱乐、购物一体化的一个全新的一元购物平台.1元就有机会买到苹果iphone6手机【一元聚购-把惊喜带回家】',/*分享摘要(可选)*/
					title:'一元聚购',/*分享标题(可选)*/
					site:'一元聚购',/*分享来源 如：腾讯网(可选)*/
					pics:'', /*分享图片的路径(可选)*/
					style:'101',
					width:142,
					height:30
					};
					var s = [];
					for(var i in p){
					s.push(i + '=' + encodeURIComponent(p[i]||''));
					}
					document.write(['<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?',s.join('&'),'" target="_blank">立即分享</a>'].join(''));
					})();
					</script>
				</h3>
				<p class="p_con">该任务同时享受第4条邀请好友的福利！分享后从您的QQ空间点击您的分享即可领取任务奖励！</p>
			</li>
			<li>
				<h3><span class="num_span">6</span>添加官方QQ群,领取 <b class="credit_b">1元现金红包</b><a href="#" onclick="alert('使用手机扫描下方二维码，通过显示的连接直接添加QQ群，验证：红包！')">如何领取</a></h3>
				<p class="p_con"><img src="http://img.yyjg.com/help/qqqun1.png" /></p>
			</li>
			<li>
				<h3><span class="num_span">7</span>骚年，听说收藏我们商城网站就会 <b class="credit_b">人品暴涨 中奖率大大提升</b></h3>
				<p class="p_con">请按 Ctrl + D 加入收藏，从收藏夹进入一元聚购会让你人品爆发！！</p>
			</li>
           <li style="color: #ff0000">
            </li>
        </ul>
        <center><a href="#" class="zqjf-box-close">知道了</a></center>
    </div>
</div>
<script> 
var easyDialog  = new function(){
    this.dialogObj = null;
    /**
     * 创建遮罩层
     * @return { Object } 遮罩层
     */
    this.createOverlay = function(){
        var overlay = $("<div name='overlay' style='margin:0;padding:0;border:none;width:100%;height:2000px;background:#333;opacity:0.6; -moz-opacity: 0.6;filter:alpha(opacity=60);z-index:9999;position:fixed;_position:absolute;top:0;left:0;'></div>");
        overlay.attr("id","overlay");
        return overlay;
    };
    /**
     * @param { Object } DOM元素
     */
    this.setPosition = function(dialogBoxObj){
        var  dialogBox = $(dialogBoxObj);
        var margin_top= -dialogBox.height()/2+"px";
        var margin_left  = -dialogBox.width()/2+"px";
        dialogBox.css({"marginLeft":margin_left,"marginTop":margin_top,"_position":"absolute","_marginLeft":margin_left,"_marginTop":margin_top,"_top":"50%","_left":"50%"});
        dialogBox.addClass("com_tan");
    };
    this.open = function(obj){
 
        var item = obj.container;
        var overlay = $("#overlay");
        // 如果页面中已经缓存遮罩层，直接显示
        if(overlay.length<=0){
            overlay = this.createOverlay();
            $("body").append(overlay);
        }
        var tar = $("#"+item);
 
        dialogObj = tar;
        tar.css({"border":"none","z-index":10002})
        this.setPosition(tar);
        overlay.show();
        tar.show();
    };
    // 关掉某个弹窗
    this.close = function(){
        $("div[name='overlay']").hide();
        $("div.overlay").hide();
        $(dialogObj).hide();
    };
};
 
$(function(){
 
	$('.zqjf-box-close').click(function(){
		easyDialog.close();
		return false;
	});
 
	$('#zqjf_box_btn').click(function(){
		easyDialog.open({
			container: 'zqjf_box'
		});
		return false;
	});
});
</script>


<style type="text/css">
.clear { clear: both; height: 0px; overflow: hidden; }
#sign { width: 668px; height: 656px; position:fixed; left:26%; z-index: 1000000; display: none; }
	#sign span.bg { position: absolute; display: block; width: 100%; height: 100%;  }
	#sign .sign { position: relative; width: 668px; height: 656px;   background: url(<?php echo G_GLOBAL_STYLE; ?>/fee/sign/sign_bg.png) no-repeat; z-index: 2; }
		#sign .sign a.close { display: block; width: 21px; height: 21px; background: url(<?php echo G_GLOBAL_STYLE; ?>/fee/sign/close.png) no-repeat; position: absolute; right: 46px; top: 94px; }
		#sign .sign p { width: 110px; font-size: 30px; font-weight: 900; color: #b2362c; text-align: center; position: absolute; }
		#sign .sign p.people { width: 94px; top: 112px; left: 160px; }
		#sign .sign p.count { top: 112px; left: 486px; }
		#sign .sign ul { position: absolute; width: 597px; height: 328px; top: 162px; left: 37px; }
			#sign .sign ul li { width: 14.2%; height: 82px; float: left; }
				#sign .sign ul li a { display: block; width: 67px; height: 67px; margin: 7px auto; background: url(<?php echo G_GLOBAL_STYLE; ?>/fee/sign/no.png) no-repeat; }
				#sign .sign ul li a.yes { background: url(<?php echo G_GLOBAL_STYLE; ?>/fee/sign/yes.png) no-repeat; }
</style>

<div id="sign">
	<span class="bg"></span>
	<div class="sign">
		<a href="javascript:void(0)" class="close"></a>
		<p class="people"></p>
		<p class="count"></p>
		<ul></ul>
		<div class="clear"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function (){
		$.get('<?php echo WEB_PATH; ?>/sign/sign/sign_init', function (result){
			var data = eval('(' + result + ')');
			$('#sign .sign p.people').html(data.people);
			$('#sign .sign p.count').html(data.count);

			var sign_html = '';
			for (var i = 0; i < data.mycount; i++) {
				sign_html += '<li>'
				sign_html += '	<a class="yes" href="javascript:void(0)"></a>';
				sign_html += '</li>';
			};

			for (var i = 0; i < 28 -  data.mycount; i++) {
				sign_html += '<li>'
				sign_html += '	<a href="javascript:void(0)"></a>';
				sign_html += '</li>';
			};

			$('#sign .sign ul').append(sign_html);
		})

		var sign_show = false;
		$('#sign .sign a.close').click(function (){
			if (sign_show) {
				$('#sign').hide();
				sign_show = false;
			} else {
				var _top = $(window).scrollTop();
				$('#sign').css('top', _top).show();
				sign_show = true;
			}
		})

		$('#sign .sign ul li a:not(.yes)').live({
			click : function (){
				$.get('<?php echo WEB_PATH; ?>/sign/sign/sign_today', function (result){
					var data = eval('(' + result + ')');
					alert(data.msg);
					if (data.code == 200) {
						$('#sign .sign p.people').html(data.people);
						$('#sign .sign p.count').html(data.count);
						$('#sign .sign ul li a:not(.yes)').eq(0).addClass('yes').css('background', 'url(<?php echo G_GLOBAL_STYLE; ?>/fee/sign/yes.png) no-repeat');
					};
				})
			}
		})
	})
</script>
