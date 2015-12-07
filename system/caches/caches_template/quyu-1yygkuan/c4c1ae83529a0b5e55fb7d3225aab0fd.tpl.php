<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","headerindex");?>
<meta http-equiv="X-UA-Compatible" content="IE=8" /> 
 <meta property="qc:admins" content="1435472411156775453463757" /> 
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/index3.css?date=20140731">
<script type="text/javascript" src="<?php echo G_WEB_PATH; ?>/statics/plugin/style/global/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo G_WEB_PATH; ?>/statics/templates/quyu-1yygkuan/js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/layer/layer.min.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/gdjs.js"></script>
<style>
.pic{
	position: relative;
	display: block;
}
.light{
cursor:pointer;
position: absolute;
left: -180px;
top: 0;
width: 200px;
height: 180px;
background-image: -moz-linear-gradient(0deg,rgba(255,255,255,0),rgba(255,255,255,0.5),rgba(255,255,255,0));
background-image: -webkit-linear-gradient(0deg,rgba(255,255,255,0),rgba(255,255,255,0.5),rgba(255,255,255,0));
transform: skewx(-25deg);
-o-transform: skewx(-25deg);
-moz-transform: skewx(-25deg);
-webkit-transform: skewx(-25deg);
}
.pic:hover .light{
left:180px;
-moz-transition:0.5s;
-o-transition:0.5s;
-webkit-transition:0.5s;
transition:0.5s;
}
</style>
<div class="g-wrap w1190">
       <!--最新揭晓-->
            <div class="g-title">
                <h3 class="fl">最新揭晓<span></span></h3>
                <div class="m-other fr"><cite><a href="<?php echo WEB_PATH; ?>/goods_lottery" target="_blank" title="看看附近都有谁获得了商品？"><img src="images/999999.gif" style="position:relative;top:4px;">看看附近都有谁获得了商品？</a></cite></div>
            </div>
            <div class="g-list">
                <ul id="ulNewAwary">
				<?php $ln=1;if(is_array($shopqishu)) foreach($shopqishu AS $qishu): ?>
				<?php 
					$qishu['q_user'] = unserialize($qishu['q_user']);
				 ?>
					<li>
						<dl>
							<dt><a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" class="pic">
							<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $qishu['thumb']; ?>" height="200px" width="200px">
							<i class="light"></i>
							</a></dt>
						  <dd class="f-gx"><div class="f-gx-user"><span>恭喜</span><span class="blue"><a rel="nofollow" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($qishu['q_uid']); ?>" target="_blank"><?php echo get_user_name($qishu['q_user']); ?></a></span><span>获得</span></div></dd><br>
							<dd class="u-name"><a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>" target="_blank" class="name"><?php echo $qishu['title']; ?></a></dd>
						</dl>
						<cite style="display: inline;"></cite>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
					<script type="text/javascript" src="<?php echo G_WEB_PATH; ?>/statics/templates/quyu-1yygkuan/js/GLotteryFun.js"></script>
					<script type="text/javascript">
						$(document).ready(function(){gg_show_time_init("ulNewAwary",'<?php echo WEB_PATH; ?>',0);});					
					</script> 
                </ul>
            </div>
            <!--热门推荐-->
            <div class="g-title">
                <h3 class="fl">热门推荐</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/goods_list/" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>
            <div class="g-hot clrfix">
                <div class="g-hotL fl" id="divHotGoodsList">
				<?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $renqi): ?>
					<div class="g-hotL-list">
						<div class="g-hotL-con">
							<ul>
								<li class="g-hot-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>" class="pic"><img alt="<?php echo $renqi['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>"><i class="light"></i></a></li>
								<li class="g-hot-name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" target="_blank" title="<?php echo $renqi['title']; ?>"><?php echo $renqi['title']; ?></a></li>
								<li class="gray">价值：￥<?php echo $renqi['money']; ?></li>
								<li class="g-progress"><dl class="m-progress"><dt><b style="width:<?php echo width($renqi['canyurenshu'],$renqi['zongrenshu'],216); ?>0px;"></b></dt><dd><span class="orange fl"><em><?php echo $renqi['canyurenshu']; ?></em>已参与</span><span class="gray6 fl"><em><?php echo $renqi['zongrenshu']; ?></em>总需人次</span><span class="blue fr"><em><?php echo $renqi['zongrenshu']-$renqi['canyurenshu']; ?></em>剩余</span></dd></dl></li>
								<li><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>" class="u-imm" target="_blank" title="只要1元，即可购买">立即<?php echo _cfg('web_name_two'); ?></a></li>
							</ul>
						</div>
					</div>
					<?php  endforeach; $ln++; unset($ln); ?>
				</div>
                <div class="g-hotR fr">
                    <div class="u-are">正在<?php echo _cfg('web_name_two'); ?></div>
                    <div class="g-zzyging">
                        <ul id="UserBuyNewList" style="margin-top: 0px;">
							<?php $ln=1;if(is_array($go_record)) foreach($go_record AS $gorecord): ?>
							<li><span class="fl"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>" target="_blank" title="<?php echo get_user_name($gorecord); ?>"><img alt="<?php echo get_user_name($gorecord); ?>" width="40" height="40" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($gorecord['uid'],'img','8080'); ?>"><i></i></a></span><p><a target="_blank" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>" title="<?php echo get_user_name($gorecord); ?>" class="blue"><?php echo get_user_name($gorecord); ?></a><br><a target="_blank" href="<?php echo WEB_PATH; ?>/goods/<?php echo $gorecord['shopid']; ?>" title="<?php echo $gorecord['shopname']; ?>" class="u-ongoing"><?php echo $gorecord['shopname']; ?></a></p></li>
							<?php  endforeach; $ln++; unset($ln); ?>
						</ul>
					</div>
					<script> 
						function autoScroll(obj){  
							$(obj).find("#UserBuyNewList").animate({  
								marginTop : "-89px"  
							},500,function(){  
								$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
							})  
						}  
						$(function(){  
							setInterval('autoScroll(".g-zzyging")',3000)  
						})  
					</script>
                    <div class="u-see100">看一看谁的运气最好！</div>
                </div>
            </div>

            <!--手机数码-->
			<div class="g-title">
                <h3 class="fl"><i style="display: inline-block; width: 29px; height: 25px; font-style: normal; font-size: 14px; color: rgb(255, 255, 255); background: transparent url(&quot;http://www.ygqq.com/static/img/front/index/icon_index.png&quot;) no-repeat scroll -46px -22px; line-height: 30px; padding-left: 2px; margin-right: 18px; float: left; margin-top: 5px;">1F</i>手机数码</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/goods_list/81_0_0" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>

            <div class="announced-soon clrfix" id="divSoonGoodsList">
			<?php $data=$this->DB()->GetList("select * from `@#_shoplist` where `cateid`='81' and `q_uid` is null ORDER BY id DESC LIMIT 40",array("type"=>1,"key"=>'',"cache"=>0)); ?>
					 <?php $ln=1;if(is_array($data)) foreach($data AS $shop): ?>
			
					 <?php 			
					 $i=$i+1;
					  ?>
				<div class="soon-list-con">

					<div class="soon-list">
						<ul id="ulGoodsList">
							<li class="g-soon-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>" class="pic"><img alt="<?php echo $shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"><i class="light"></i></a></li>
							<li class="soon-list-name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><?php echo $shop['title']; ?></a></li>
							<li class="gray">价值：￥<?php echo $shop['money']; ?></li>
							<li class="g-progress"><dl class="m-progress"><dt><b style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],266); ?>0px"></"></b></dt><dd><span class="orange fl"><em><?php echo $shop['canyurenshu']; ?></em>已参与</span><span class="gray6 fl"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</span><span class="blue fr"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</span></dd></dl></li>
							<li><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" class="u-now">立即<?php echo _cfg('web_name_two'); ?></a><a href="javascript:;" title="加入到购物车" class="u-cart"><s></s></a></li>
							<div class="Curbor_id" style="display:none;"><?php echo $shop['id']; ?></div>
							<div class="Curbor_yunjiage" style="display:none;"><?php echo $shop['yunjiage']; ?></div>
							<div class="Curbor_shenyu" style="display:none;"><?php echo $shop['shenyurenshu']; ?></div>
						</ul>
					</div>
				</div>
				<?php  endforeach; $ln++; unset($ln); ?>
			</div>
            <!--end-->
			
            <!--汽车-->
			<div class="g-title">
                <h3 class="fl"><i style="display: inline-block; width: 29px; height: 25px; font-style: normal; font-size: 14px; color: rgb(255, 255, 255); background: transparent url(&quot;http://www.ygqq.com/static/img/front/index/icon_index.png&quot;) no-repeat scroll -46px -22px; line-height: 30px; padding-left: 2px; margin-right: 18px; float: left; margin-top: 5px;">2F</i>电脑办公</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/goods_list/82_0_0" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>

            <div class="announced-soon clrfix" id="divSoonGoodsList">
			<?php $data=$this->DB()->GetList("select * from `@#_shoplist` where `cateid`='82' and `q_uid` is null ORDER BY id DESC LIMIT 40",array("type"=>1,"key"=>'',"cache"=>0)); ?>
					 <?php $ln=1;if(is_array($data)) foreach($data AS $shop): ?>
			
					 <?php 			
					 $i=$i+1;
					  ?>
				<div class="soon-list-con">

					<div class="soon-list">
						<ul id="ulGoodsList">
							<li class="g-soon-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>" class="pic"><img alt="<?php echo $shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"><i class="light"></i></a></li>
							<li class="soon-list-name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><?php echo $shop['title']; ?></a></li>
							<li class="gray">价值：￥<?php echo $shop['money']; ?></li>
							<li class="g-progress"><dl class="m-progress"><dt><b style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],266); ?>0px"></"></b></dt><dd><span class="orange fl"><em><?php echo $shop['canyurenshu']; ?></em>已参与</span><span class="gray6 fl"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</span><span class="blue fr"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</span></dd></dl></li>
							<li><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" class="u-now">立即<?php echo _cfg('web_name_two'); ?></a><a href="javascript:;" title="加入到购物车" class="u-cart"><s></s></a></li>
							<div class="Curbor_id" style="display:none;"><?php echo $shop['id']; ?></div>
							<div class="Curbor_yunjiage" style="display:none;"><?php echo $shop['yunjiage']; ?></div>
							<div class="Curbor_shenyu" style="display:none;"><?php echo $shop['shenyurenshu']; ?></div>
						</ul>
					</div>
				</div>
				<?php  endforeach; $ln++; unset($ln); ?>
			</div>
            <!--end-->
	

			<!--食品饮料-->
			<div class="g-title">
                <h3 class="fl"><i style="display: inline-block; width: 29px; height: 25px; font-style: normal; font-size: 14px; color: rgb(255, 255, 255); background: transparent url(&quot;http://www.ygqq.com/static/img/front/index/icon_index.png&quot;) no-repeat scroll -46px -22px; line-height: 30px; padding-left: 2px; margin-right: 18px; float: left; margin-top: 5px;">3F</i>食品饮料</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/goods_list/86_0_0" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>

            <div class="announced-soon clrfix" id="divSoonGoodsList">
			<?php $data=$this->DB()->GetList("select * from `@#_shoplist` where `cateid`='86' and `q_uid` is null ORDER BY id DESC LIMIT 40",array("type"=>1,"key"=>'',"cache"=>0)); ?>
					 <?php $ln=1;if(is_array($data)) foreach($data AS $shop): ?>
			
					 <?php 			
					 $i=$i+1;
					  ?>
				<div class="soon-list-con">

					<div class="soon-list">
						<ul id="ulGoodsList">
							<li class="g-soon-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>" class="pic"><img alt="<?php echo $shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"><i class="light"></i></a></li>
							<li class="soon-list-name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><?php echo $shop['title']; ?></a></li>
							<li class="gray">价值：￥<?php echo $shop['money']; ?></li>
							<li class="g-progress"><dl class="m-progress"><dt><b style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],266); ?>0px"></"></b></dt><dd><span class="orange fl"><em><?php echo $shop['canyurenshu']; ?></em>已参与</span><span class="gray6 fl"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</span><span class="blue fr"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</span></dd></dl></li>
							<li><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" class="u-now">立即<?php echo _cfg('web_name_two'); ?></a><a href="javascript:;" title="加入到购物车" class="u-cart"><s></s></a></li>
							<div class="Curbor_id" style="display:none;"><?php echo $shop['id']; ?></div>
							<div class="Curbor_yunjiage" style="display:none;"><?php echo $shop['yunjiage']; ?></div>
							<div class="Curbor_shenyu" style="display:none;"><?php echo $shop['shenyurenshu']; ?></div>
						</ul>
					</div>
				</div>
				<?php  endforeach; $ln++; unset($ln); ?>
			</div>
            <!--end-->
			<!--虚拟产品-->
			<div class="g-title">
                <h3 class="fl"><i style="display: inline-block; width: 29px; height: 25px; font-style: normal; font-size: 14px; color: rgb(255, 255, 255); background: transparent url(&quot;http://www.ygqq.com/static/img/front/index/icon_index.png&quot;) no-repeat scroll -46px -22px; line-height: 30px; padding-left: 2px; margin-right: 18px; float: left; margin-top: 5px;">4F</i>精品电器</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/goods_list/83_0_0" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>

            <div class="announced-soon clrfix" id="divSoonGoodsList">
			<?php $data=$this->DB()->GetList("select * from `@#_shoplist` where `cateid`='83' and `q_uid` is null ORDER BY id DESC LIMIT 40",array("type"=>1,"key"=>'',"cache"=>0)); ?>
					 <?php $ln=1;if(is_array($data)) foreach($data AS $shop): ?>
			
					 <?php 			
					 $i=$i+1;
					  ?>
				<div class="soon-list-con">

					<div class="soon-list">
						<ul id="ulGoodsList">
							<li class="g-soon-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>" class="pic"><img alt="<?php echo $shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>"><i class="light"></i></a></li>
							<li class="soon-list-name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" title="<?php echo $shop['title']; ?>"><?php echo $shop['title']; ?></a></li>
							<li class="gray">价值：￥<?php echo $shop['money']; ?></li>
							<li class="g-progress"><dl class="m-progress"><dt><b style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],266); ?>0px"></"></b></dt><dd><span class="orange fl"><em><?php echo $shop['canyurenshu']; ?></em>已参与</span><span class="gray6 fl"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</span><span class="blue fr"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余</span></dd></dl></li>
							<li><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>" target="_blank" class="u-now">立即<?php echo _cfg('web_name_two'); ?></a><a href="javascript:;" title="加入到购物车" class="u-cart"><s></s></a></li>
							<div class="Curbor_id" style="display:none;"><?php echo $shop['id']; ?></div>
							<div class="Curbor_yunjiage" style="display:none;"><?php echo $shop['yunjiage']; ?></div>
							<div class="Curbor_shenyu" style="display:none;"><?php echo $shop['shenyurenshu']; ?></div>
						</ul>
					</div>
				</div>
				<?php  endforeach; $ln++; unset($ln); ?>
			</div>
            <!--end-->
			
			
             <!--晒单分享-->
			 <div class="g-title">
                <h3 class="fl"><i style="display: inline-block; width: 29px; height: 25px; font-style: normal; font-size: 14px; color: rgb(255, 255, 255); background: transparent url(&quot;http://www.ygqq.com/static/img/front/index/icon_index.png&quot;) no-repeat scroll -46px -22px; line-height: 30px; padding-left: 2px; margin-right: 18px; float: left; margin-top: 5px;">5F</i>晒单分享</h3>
                <div class="m-other fr"><a href="<?php echo WEB_PATH; ?>/go/shaidan/" target="_blank" title="更多" class="u-more">更多</a></div>
            </div>
           
            <div class="g-single-sun">
                <div class="singleL fl" id="divPostRec">
				<?php $ln=1;if(is_array($shaidan)) foreach($shaidan AS $sd): ?>
					<dl>
						<dt><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank" title="<?php echo $sd['sd_title']; ?>"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"></a></dt>
						<dd class="u-user">
							<p class="u-head"><a href="<?php echo WEB_PATH; ?>/uname/<?php echo $sd['sd_userid']; ?>" target="_blank" title="<?php echo get_user_name($sd['sd_userid']); ?>"><img alt="<?php echo $sd['sd_title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo get_user_key($sd['sd_userid'],'img','8080'); ?>" width="40" height="40"><i></i></a></p>
							<p class="u-info"><span><a href="<?php echo WEB_PATH; ?>/uname/<?php echo $sd['sd_userid']; ?>" target="_blank" title="<?php echo get_user_name($sd['sd_userid']); ?>"><?php echo get_user_name($sd['sd_userid']); ?></a><em><?php echo date("Y-m-d",$sd['sd_time']); ?></em></span><cite><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank" title="<?php echo $sd['sd_title']; ?>"><?php echo $sd['sd_title']; ?></a></cite></p>
						</dd>
						<dd class="m-summary"><cite><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank"><?php echo _strcut($sd['sd_content'],100); ?></a></cite><b><s></s></b></dd>
					</dl>
					<?php  endforeach; $ln++; unset($ln); ?>
				</div>
                <div class="singleR fl">
                    <ul id="ul_PostList">
					<?php $ln=1;if(is_array($shaidan_two)) foreach($shaidan_two AS $sd): ?>
						<li><a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sd['sd_id']; ?>" target="_blank" title="<?php echo $sd['sd_title']; ?>"><img alt="<?php echo $sd['sd_title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sd['sd_thumbs']; ?>"><p title="<?php echo $sd['sd_title']; ?>"><?php echo $sd['sd_title']; ?></p></a></li>
					<?php  endforeach; $ln++; unset($ln); ?>
					</ul>
                </div>
            </div>
        </div>
    </div>
	
<script type="text/javascript">
$(function(){
        $("body1").attr('class','index');
	var sw = 0;
	$(".m-slides .rslides_tabs li a").mouseover(function(){
		sw = $(".rslides_tabs a").index(this);
		myShow(sw);
	});
	function myShow(i){
		$(".m-slides .rslides_tabs li").eq(i).addClass("rslides_here").siblings("li").removeClass("rslides_here");
		$("#slideul li").eq(i).stop(true,true).fadeIn(600).siblings("li").fadeOut(600);
	}
	//滑入停止动画，滑出开始动画
	$("#slideImg,.rslides_nav").hover(function(){
		if(myTime){
		   clearInterval(myTime);
		}
	},function(){
		myTime = setInterval(function(){
		  myShow(sw)
		  sw++;
		  if(sw==<?php echo count($slides); ?>){sw=0;}
		} , 3000);
	});
	//自动开始
	var myTime = setInterval(function(){
	   myShow(sw)
	   sw++;
	   if(sw==<?php echo count($slides); ?>){sw=0;}
	} , 3000);
	$(".next").click(function(){
		myShow(sw)
		sw++;
 		if(sw==<?php echo count($slides); ?>){sw=0;}
	});
	$(".pre").click(function(){
		myShow(sw)
 		if(sw==0){sw=<?php echo count($slides); ?>;}
 		sw--;
	});

})
 var l = $("#myTab_Content0");
        $("#myTab").children().each(function(A, z) {
            var B = $(this);
            B.hover(function() {
                if (A == 0) {
                    B.attr("class", "f-notice-hover").next().attr("class", "");
                    l.show().next().hide()
                } else {
                    B.attr("class", "f-notice-hover").prev().attr("class", "");
                    l.hide().next().show()
                }
            }, function() {})
        });
</script>

<script type="text/javascript">
$(document).ready(function(){
	
	var timer = {};

	$('#m_btn').delegate('li', 'mouseenter', function(){
		var self = $(this);
		var tp = self.attr('data-type');
		clearTimeout(timer[tp]);
		timer[tp] = setTimeout(function(){
			self.addClass('text-d-on');
			$('div[data-panel=' + tp + ']').removeClass('hide');
		},100);
	}).delegate('li', 'mouseleave', function(){
		var self = $(this);
		var tp = self.attr('data-type');
		clearTimeout(timer[tp])
		timer[tp] = setTimeout(function(){
			self.removeClass('text-d-on');
			$('div[data-panel=' + tp + ']').addClass('hide');
		},100);
	});
	
	$(document.body).delegate('div.m_content', 'mouseenter', function(){
		clearTimeout(timer[$(this).attr('data-panel')]);
	}).delegate('div.m_content', 'mouseleave', function(){
		$(this).addClass('hide');
		$('span[data-type='+ $(this).attr('data-panel') +']').removeClass('text-d-on');
	});
	
});
</script>
<script type="text/javascript">
$(function(){
	$("#ulGoodsList a.u-cart").click(function(){ 
		var sw = $("#ulGoodsList a.u-cart").index(this);
		var src = $("#ulGoodsList .g-soon-pic a img").eq(sw).attr('src');				
		var $shadow = $('<img id="cart_dh" style="display:none; border:1px solid #aaa; z-index:99999;" width="200" height="200" src="'+src+'" />').prependTo("body");  			
		var $img = $("#ulGoodsList .g-soon-pic").eq(sw);
		$shadow.css({ 
			'width' : 200, 
			'height': 200, 
			'position' : 'absolute',      
			"left":$img.offset().left+16, 
			"top":$img.offset().top+9,
			'opacity' : 1    
		}).show();
		var $cart = $("#btnMyCart");
		$shadow.animate({   
			width: 1, 
			height: 1, 
			top: $cart.offset().top,    
			left: $cart.offset().left, 
			opacity: 0
		},500,function(){
			Cartcookie(sw,false);
		});	
		
	});
	$("#ulGoodsList a.go_Shopping").click(function(){	
		var sw = $("#ulGoodsList a.go_Shopping").index(this);

		Cartcookie(sw,true); 
	});	
});
//存到COOKIE
function Cartcookie(sw,cook){
	var shopid = $(".Curbor_id").eq(sw).text(),
		shenyu = $(".Curbor_yunjiage").eq(sw).text(),
		money = $(".Curbor_shenyu").eq(sw).text();
	var Cartlist = $.cookie('Cartlist');
	if(!Cartlist){
		var info = {};
	}else{
		var info = $.evalJSON(Cartlist);
	}
	if(!info[shopid]){
		var CartTotal=$("#sCartTotal").text();
			$("#sCartTotal").text(parseInt(CartTotal)+1);
			$("#btnMyCart em").text(parseInt(CartTotal)+1);
	}	
	info[shopid]={};
	info[shopid]['num']=1;
	info[shopid]['shenyu']=shenyu;
	info[shopid]['money']=money;
	info['MoenyCount']='0.00';
	$.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
	if(cook){
		window.location.href="<?php echo WEB_PATH; ?>/member/cart/cartlist";
	}
}
</script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/IndexFun.js"></script>   
<?php include templates("index","footer");?>