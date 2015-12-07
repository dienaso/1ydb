<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><!--<div id="footerbanner" style="background-color: #ffffff;"><div style="margin: 0px auto; width: 1200px; height: 50px;">
<a href="http://www.yyjg.com/go/article/show/171" target="_blank"><img  src="http://img.yyjg.com/ban/fanxianjin.jpg" /></a>
</div></div>-->
<div class="g-footer">
	<div class="m-instruction">
		<div class="g-wrap f-clear">
			<div class="g-main">
				<?php $number=1; ?>
				<?php $category=$this->DB()->GetList("select * from `@#_category` where `parentid`='1'",array("type"=>1,"key"=>'',"cache"=>0)); ?>				
				<?php $ln=1;if(is_array($category)) foreach($category AS $help): ?>
				<ul class="m-instruction-list">
					<li class="m-instruction-list-item">
						<h5><i class="ico ico-instruction ico-instruction-<?php echo $number; ?>"></i><?php echo $help['name']; ?></h5>
						<ul class="list">	
						<?php $article=$this->DB()->GetList("select * from `@#_article` where `cateid`='$help[cateid]'",array("type"=>1,"key"=>'',"cache"=>0)); ?>
				<?php 
					foreach($article as $art){
						echo "<li><a href='".WEB_PATH.'/help/'.$art['id'].".html' target='_blank'>".$art['title'].'</a></li>';
					}
				 ?>
						</ul>
					</li>
					<input type='Hidden' value="<?php echo $number++; ?>" />
				</ul>
				<?php  endforeach; $ln++; unset($ln); ?>
				<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
			</div>
			<div class="g-side">
				<div class="g-side-l">
					<ul class="m-instruction-state f-clear">						
						<li><i class="ico ico-state-l ico-state-l-2"></i>100%正品保证</li>
						<li><i class="ico ico-state-l ico-state-l-3"></i>100%权益保障</li>
						<li><i class="ico ico-state-l ico-state-l-1"></i>100%公平公正公开</li>
					</ul>
				</div>
				<div class="g-side-r">
					<div class="m-instruction-yxCode">
						<img width="100%" src="http://img.yyjg.com/images/weixin.jpg" />
						<p style="line-height: 12px;margin-top:2px;">一元聚购微信公众</p>
					</div>
					<div class="m-instruction-service">
						<p>周一至周六：9:00-22:00</p>
						<p>24热线：<font color="#da3553">0818-2180826</font></p>
						<?php 
						if(isset($this->_cfg['qq_qun'])){
						$qq_qun_list = $this->_cfg['qq_qun'];
						$qq_qun_list = explode("|",$qq_qun_list);
						foreach($qq_qun_list as $qq){
						$qq = trim($qq);
						 ?>
						<p><span class="ft-qqicon"><a style="text-indent:0em; background:none;width:160px;" target="_blank" rel="nofollow" href="javascript:;">官方QQ群：<em class="orange Fb"><?php echo $qq; ?></em></a>  </span></p>
						<?php 
							} }
						 ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="m-copyright">
		<div class="g-wrap"><?php echo Getheader('foot'); ?>&nbsp;|&nbsp;<?php echo _cfg('web_copyright'); ?> |&nbsp;<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253414171'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "v1.cnzz.com/stat.php%3Fid%3D1253414171%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script><script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?5c812ca40c6dc6b90cb11c44a05c5869";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
		</div>
	</div>
	<div class="m-QC">
		<div class="g-wrap">
			<ul class="m-QC-list">
				<li><a style="width: 108px;" href="http://pinggu.zx110.org/review_url_yyjg.com" target="_blank">&nbsp;</a></li>
				<li><a style="width: 84px;" href="http://www.bj.cyberpolice.cn/index.htm" target="_blank">&nbsp;</a></li>
				<li><a style="width: 104px;" href="http://www.yyjg.com/index.php/help/4.html" target="_blank">&nbsp;</a></li>
				<li><a style="width: 82px;" href="http://webscan.360.cn/index/checkwebsite/url/www.yyjg.com" target="_blank">&nbsp;</a></li>
				<li class="last"><a style="width: 83px;" href="http://www.baidu.com/s?wd=www.yyjg.com@v" target="_blank">&nbsp;</a></li>
			</ul>
		</div>
	</div>
</div>    
<script type="text/javascript">
$(document).ready(function(){
	try{  
       if(typeof(eval(pleasereg_initx))=="function"){
            pleasereg_initx();
	   }
    }catch(e){
    }  
})
</script>
<script>
$(function(){
	$(".quick_cart").hover(
		function(){			
			$("#rCartlist,#rCartLoading").show();
			$("#rCartlist p,#rCartlist h3").hide(); 0
			$("#rCartlist li").remove();
			$("#rCartTotal2").html("");
			$("#rCartTotalM").html("");
			$.getJSON("<?php echo WEB_PATH; ?>/member/cart/cartshop/"+ new Date().getTime(),function(data){
				$("#rCartlist ul").append(data.li);
				$("#rCartTotal2").html(data.num);
				$("#rCartTotalM").html(data.sum);
				$("#rCartLoading").hide();
				$("#rCartlist ul,#rCartlist p,#rCartlist h3").show();				
			});
		},
		function(){
			$("#rCartlist,#rCartlist ul,#rCartlist p,#rCartlist h3").hide();
		}
	);
	$("#rGotoCart").click(function(){
		window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist";
	})
});
function delshop(id){
	var Cartlist = $.cookie('Cartlist');
	var info = $.evalJSON(Cartlist);
	var num=$("#rCartTotal2").html()-1;
	var sum=$("#rCartTotalM").html();
	info['MoenyCount'] = sum-info[id]['money']*info[id]['num'];
		
	delete info[id];
	//$.cookie('Cartlist','',{path:'/'});
	$.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
	$("#rCartTotalM").html(info['MoenyCount']);
	$('#rCartTotal2').html(num);
	$('#sCartTotal').text(num);											
	$('#btnMyCart em').text(num);
	$("#shopid"+id).remove();
}
$(document).ready(function(){
	$.get("<?php echo WEB_PATH; ?>/member/cart/getnumber/"+ new Date().getTime(),function(data){
		$("#sCartTotal").text(data);											
		$("#btnMyCart em").text(data);											
	});
});
</script>
<style>
.weix {
	background-color:#fff;
	position:fixed;
	border:1px solid #E3E3E3;
	bottom:400px;
	left:0px;
	width:108px; 
	height:140px;
	z-index:999;
	text-align:-99999px;
}

.weixin-img {
	width:93px;	
	padding:5px;
	height:93px; 
	padding:auto;
	margin-bottom:2px;
}
.weixin-img s {
	background:url(<?php echo G_TEMPLATES_PATH; ?>/yungou/images/android.png);
	width:93px;
	height:93px;
	display:inline-block;
}
* html .weix {
	_top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,100)||0)-40));
	_bottom:auto;
	_position:absolute;
}
	.fixed_wx_close{
	background:url(<?php echo G_TEMPLATES_PATH; ?>/yungou/images/footerimg.png);
	background-position:-103px -193px;
	border-bottom:1px	solid #E1E1E1;
	border-left:1px solid #E1E1E1;
	color:#FFFFFF;
	float:right;
	font-family:Arial;
	font-size:16px;
	height:15px;
	text-align:right;
	width:15px;
	}
</style>
<script>
$(function(){
	$(".fixed_wx_close").click(function(){
		$(".weix").hide();
	})
})
</script>
<script>
var wids=($(window).width()-980)/2-80;
if(wids>0){
	$(".weix").css("right",wids);
}else{
	$(".weix").css("right",10);
}
</script>

<!--footer end-->
		
		<!--	 <div class="weix"  >
				<a href="javascript:void(0);" id="close" class="fixed_wx_close"></a>
   				<dd class="weixin-img"><s></s></dd>
   				<dd class="gray02" align="center">1元聚购手机客户端</dd>
			</div> -->
<div id="divRighTool" class="quickBack">
	
	<dl class="quick_But">
		
		<dd class="quick_cart" style=""><a id="btnMyCart" href="<?php echo WEB_PATH; ?>/member/cart/cartlist" target="_blank" class="quick_cartA"><b>购物车</b><s></s><em>1</em></a>
			<div style="display: none;" id="rCartlist" class="Roll_mycart">
				<ul style="display: none;"></ul>
				<div class="quick_goods_loding" id="rCartLoading" style="display: none;"><img border="0" alt="" src="<?php echo G_TEMPLATES_STYLE; ?>/images/goods_loading.gif">正在加载......</div>
				<p id="p1" style="display: none;">共计<span id="rCartTotal2">0</span> 件商品 金额总计：<span class="rmbgray" id="rCartTotalM">0</span></p>
				<h3 style="display: none;"><input type="button" value="去购物车结算" id="rGotoCart"></h3>
			</div>
		</dd>
		<dd class="quick_service"><a id="btnRigQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _cfg("qq"); ?>&site=qq&menu=yes" target="_blank" class="quick_serviceA"><b>在线客服</b><s></s></a></dd>
		<dd class="quick_Collection"><a id="btnFavorite" href="javascript:;" class="quick_CollectionA"><b>收藏本站</b><s></s></a></dd>
		<dd class="quick_Return"><a id="btnGotoTop" href="javascript:;" class="quick_ReturnA"><b>返回顶部</b><s></s></a></dd>
	</dl>	
</div>	
<script>

$("#divRighTool").show(); 
var wids=($(window).width()-1200)/2-70;
if(wids>0){
	$("#divRighTool").css("right",wids);
}else{
	$("#divRighTool").css("right",10);
}
$(function(){

	$("#btnGotoTop").click(function(){
		$("html,body").animate({scrollTop:0},1500);
	});
	$("#btnFavorite,#addSiteFavorite").click(function(){
		var ctrl=(navigator.userAgent.toLowerCase()).indexOf('mac')!=-1?'Command/Cmd': 'CTRL';
		if(document.all){
			window.external.addFavorite('<?php echo G_WEB_PATH; ?>','<?php echo _cfg("web_name"); ?>');
		}
		else if(window.sidebar){
		   window.sidebar.addPanel('<?php echo _cfg("web_name"); ?>','<?php echo G_WEB_PATH; ?>', "");
		}else{ 
			alert('您可以通过快捷键' + ctrl + ' + D 加入到收藏夹');
		}
    });
	$("#divRighTool a").hover(		
		function(){
			$(this).addClass("Current");
		},
		function(){
			$(this).removeClass("Current");
		}
	)
});
	//聚购基金
	/*$.ajax({
		url:"<?php echo WEB_PATH; ?>/api/fund/get",
		success:function(msg){
			$("#spanFundTotal").text(msg);
		}
	}); */
</script>
<!--<SCRIPT LANGUAGE="JavaScript" src=http://float2006.tq.cn/floatcard?adminid=9454247&sort=2 ></SCRIPT> -->
<div class="w-mask" id="pro-view-4">
<iframe frameBorder="0" scrolling="no" style="z-index: -1; position: absolute; filter: Alpha(Opacity=0); WIDTH: 100%; height: 100%; top: 0px; left: 0px;">
<html>
<head><title></title></head>
<body></body>
</html>
</iframe>
</div>
<div class="w-msgbox w-msgbox-intro nisdisplay" id="pro-view-3" style="position: absolute; top: 0px; left: 419px;">
	<a class="w-msgbox-close" href="javascript:void(0);" data-pro="close">x</a>
	<div class="w-msgbox-hd" data-pro="header"></div>
	<div class="w-msgbox-bd" data-pro="entry">
		<h3>什么是一元聚购？</h3>
		<a title="了解规则" class="ruleLink" href="http://www.yyjg.com/index.php/help/1.html" target="_blank">了解规则
		</a>
	</div>
</div>
</body>
</html>