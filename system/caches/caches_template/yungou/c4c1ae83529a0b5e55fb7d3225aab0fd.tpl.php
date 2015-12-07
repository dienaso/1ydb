<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/Home.css"/>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/changimages.js"></script>

<style type="text/css">
.demo{ width:740px; height:202px; position:relative; overflow:hidden; padding:0px;}
.num{ position:absolute;right:20px; top:170px; z-index:10;}
.num a{background:#fff; color:#d22a3a; border:1px solid #ccc; width:16px; height:16px; display:inline-block; text-align:center; line-height:16px; margin:0 3px; cursor:pointer;}
.num a.cur{ background:#d22a3a;color:#fff;}
.demo ul{ position:relative; z-index:5;}
.demo ul li{ position:absolute; display:none;}
</style>
<div class="g-body">
<div class="m-index">
<div class="g-wrap g-body-hd f-clear">
	<div class="g-main">
		<div class="g-main-l">
			<div class="m-index-duobaoIntro">
				<h4>最新活动</h4>
				<ul class="m-index-duobaoIntro-list">
					<li><span class="index">1</span>一元聚购提供每日签到，绑定微信等任务，请参与，活动不断，惊喜不断。</li>
					<li><span class="index">2</span><a href="http://www.yyjg.com/go/article/show/196.html" style="color:red;"   target="_blank">消费未获得任何商品.更多礼品及iphone6等你来拿-查看活动详情！</a></li>
				<li><span class="index">3</span><a href="http://www.yyjg.com/go/article/show/196.html"   target="_blank">充值满百送10,依此类推,多充多送</a></li>
				</ul>
			</div>
		</div>
		<div class="g-main-m">
			<div class="flexslider">
					<?php $slides=$this->DB()->GetList("select * from `@#_slide` where 1",array("type"=>1,"key"=>'',"cache"=>0)); ?>
					<ul class="slides">		
					<?php $ln=1;if(is_array($slides)) foreach($slides AS $slide): ?>
					<?php if($ln == 1): ?>
					<li style="display:list-item;"><a href="<?php echo $slide['link']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a></li>
					<?php  else: ?>
					<li style="display:none;"><a href="<?php echo $slide['link']; ?>" target="_blank"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $slide['img']; ?>"></a></li>
					<?php endif; ?>
					<?php  endforeach; $ln++; unset($ln); ?>
					</ul>
					<script type="text/javascript">
					$(document).ready(function(){
						$('.flexslider').flexslider({
							directionNav: true,
							pauseOnAction: false
						});
					});
					</script>
			</div>
			<div class="w-silde m-index-newReveal">

				<div class="m-results-leastRemain-title-ft"></div>
				<div class="w-slide-wrap">
				 <a href="javascript:;"><div class="arrows arrows2" arae="left"></div></a>
					<ul id="ulNewAwary" class="w-silde-wrap-list" style="width: 4380px;">			 
					<?php $ln=1;if(is_array($shopqishu)) foreach($shopqishu AS $qishu): ?>
                    <?php 
                    	$qishu['q_user'] = unserialize($qishu['q_user']);
                     ?>					
						<li>
							<div class="w-goods-newReveal">
								<i title="最新揭晓" class="ico ico-label ico-label-newReveal">&nbsp;</i>
								<p class="w-goods-title"><a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>.html" target="_blank" class="name">(第<?php echo $qishu['qishu']; ?>期)<?php echo $qishu['title']; ?></a> </p>
								<div class="w-goods-pic"><a href="<?php echo WEB_PATH; ?>/dataserver/<?php echo $qishu['id']; ?>.html" target="_blank" class="pic"><img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $qishu['thumb']; ?>" width="105px" height="105px" /></a></div>
								<p class="w-goods-price">总需聚购：<?php echo $qishu['zongrenshu']; ?>人次</p>
								<div class="w-goods-record">
									<p class="w-goods-owner f-txtabb">获得者：<a rel="nofollow" class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($qishu['q_uid']); ?>.html" target="_blank"><b><?php echo get_user_name($qishu['q_user']); ?></b></a></p>
									<p>本次聚购：<?php echo get_user_goods_num($qishu['q_uid'],$qishu['id']); ?>次</p>
									<p>幸运号码：<?php echo $qishu['q_user_code']; ?></p>
									<p class="w-goods-ratio">回报率：<b class="txt-red"><?php echo (int)$qishu['zongrenshu']/(int)get_user_goods_num($qishu['q_uid'],$qishu['id']); ?></b> 倍</p>
								</div>									
						</div>
						</li>	
					<?php  endforeach; $ln++; unset($ln); ?>						
					</ul>
					<a href="javascript:;"><div class="arrows arrows1" arae="right"></div></a>
					<div class="controller-nav">
						<a class="cur" id="cur_k1" qarae="lee" href="javascript:;"></a>
						<a class="" id="cur_k2" qarae="lel" href="javascript:;"></a>
						<a class="" id="cur_k3" qarae="lcc" href="javascript:;"></a>
					</div>
					<!------>
						<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/GLotteryFun.js"></script>
						<script type="text/javascript">
							$(document).ready(function(){gg_show_time_init("ulNewAwary",'<?php echo WEB_PATH; ?>',0);});					
						</script>  
					<!------>

				</div>
				  
			</div>
		</div>
	</div>
	<div class="g-side">
		<div class="m-index-recommend">
		 <!-- 首页右边推荐奖品 start-->
			<?php if($new_shop): ?>
			<i title="聚购推荐" class="ico ico-label ico-label-recommend">&nbsp;</i>
			<div class="w-goods w-goods-ing">
				
				<div class="w-goods-pic">
					<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop['id']; ?>.html" target="_blank" title="<?php echo $new_shop['title']; ?>">
					<img width="160px" height="150px" alt="<?php echo $new_shop['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $new_shop['thumb']; ?>"></a>
				</div>
				<p class="w-goods-title f-txtabb"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop['id']; ?>.html" target="_blank" title="<?php echo $new_shop['title']; ?> ">
                    (第<?php echo $new_shop['qishu']; ?>期)<?php echo $new_shop['title']; ?></a></p>
				<p class="w-goods-price">总需：<?php echo $new_shop['money']; ?></p>
				<div class="Progress-bar" style="">
					<p class="w-progressBar-wrap" title="已完成<?php echo percent($new_shop['canyurenshu'],$new_shop['zongrenshu']); ?>"><span  class="w-progressBar-bar" style="width:<?php echo width($new_shop['canyurenshu'],$new_shop['zongrenshu'],205); ?>px;"></span></p>
					<ul class="Pro-bar-li">
						<li class="P-bar01"><em><?php echo $new_shop['canyurenshu']; ?></em>已参与人次</li>
						<li class="P-bar02"><em><?php echo $new_shop['zongrenshu']; ?></em>总需人次</li>
						<li class="P-bar03"><em><?php echo $new_shop['zongrenshu']-$new_shop['canyurenshu']; ?></em>剩余人次</li>
					</ul>
				</div>
				<div class="w-goods-opr">
					<a class="w-button w-button-main w-button-l" style="width:96px;" href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop['id']; ?>.html" target="_blank" class="go_buy">立即聚购</a>
				</div>
			</div>
		  <?php endif; ?>
    <!-- 首页右边推荐奖品 end-->
		</div>
		<div class="recommend rect_rem" style="height:211px;">
		<i title="新品推荐" class="ico ico-label ico-label-newRecommend">&nbsp;</i>
	    <a href="javascript:;"><div class="arr_row arrows_arr" arae1="left1"></div></a>
		<ul class="Pro" id="prpr_po" style="height:206px;position:absolute;left:0px;">
		<?php 
		$new_shopmun=$this->db->GetList("select * from `@#_shoplist` where `pos` = '1' and `q_uid` is null ORDER BY `id` DESC LIMIT 3");
		$num=1;
		 ?>
		<?php $ln=1;if(is_array($new_shopmun)) foreach($new_shopmun AS $new_shop_mun): ?>
		<?php 
		 $num++;
		 ?>
			<li id="pre_0<?php echo $num; ?>">
				<div class="pic">				
				<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop_mun['id']; ?>.html" target="_blank" title="<?php echo $new_shop_mun['title']; ?>">
				<img alt="<?php echo $new_shop_mun['title']; ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $new_shop_mun['thumb']; ?>">
				</a>
				<p name="buyCount" style="display:none;"></p>
				</div>
				<p class="name">
					<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $new_shop_mun['id']; ?>.html" target="_blank" title="<?php echo $new_shop_mun['title']; ?> ">
                    <?php echo $new_shop_mun['title']; ?></a>
				</p>
			</li>
		<?php  endforeach; $ln++; unset($ln); ?>		
		</ul>
		<a href="javascript:;"><div class="arr_row arrows_are" arae1="right1"></div></a>
	</div>
		</div> 
	</div>
</div>

<div class="g-wrap g-body-bd f-clear">
	<div class="g-main">
		<div class="m-index-mod m-index-goods-hotest">
			<div class="w-hd">
				<h3 class="w-hd-title">最热奖品</h3>
				<a class="w-hd-more" href="<?php echo WEB_PATH; ?>/goods_list">更多奖品,点击查看&gt;&gt;</a>
			</div>
			<div class="m-index-mod-bd">	               
			<div class="hot">
				<ul id="hostGoodsItems" class="hot-list">				
					<?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $renqi): ?>
					<li class="list-block">
						<div class="pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>.html" target="_blank" title="<?php echo $renqi['title']; ?>">					
						<?php if(isset($renqi['t_max_qishu'])): ?>							
								<i class="goods_rq"></i>							
						<?php endif; ?>					
						<?php if(isset($renqi['t_new_goods'])): ?>						
								<i class="goods_xp"></i>					
						<?php endif; ?>
						<img src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>" alt="<?php echo $renqi['title']; ?>"></a></div>
						<p class="name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>.html" target="_blank" title="<?php echo $renqi['title']; ?>">(第<?php echo $renqi['qishu']; ?>期)<?php echo $renqi['title']; ?></a></p>
						<p class="money">价值：<span class="rmb"><?php echo $renqi['money']; ?></span></p>
						<div class="Progress-bar" style="">
							<p class="w-progressBar-wrap" title="已完成<?php echo percent($renqi['canyurenshu'],$renqi['zongrenshu']); ?>"><span class="w-progressBar-bar" style="width:<?php echo width($renqi['canyurenshu'],$renqi['zongrenshu'],221); ?>px;"></span></p>
							<ul class="Pro-bar-li">
								<li class="P-bar01"><em><?php echo $renqi['canyurenshu']; ?></em>已参与人次</li>
								<li class="P-bar02"><em><?php echo $renqi['zongrenshu']; ?></em>总需人次</li>
								<li class="P-bar03"><em><?php echo $renqi['zongrenshu']-$renqi['canyurenshu']; ?></em>剩余人次</li>
							</ul>
						</div>
						<div class="w-goods-opr"><a class="w-button w-button-main w-button-l" style="width:96px;" href="<?php echo WEB_PATH; ?>/goods/<?php echo $renqi['id']; ?>.html" target="_blank" class="shop_but" title="立即一元聚购">立即一元聚购</a></div>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
				</ul>
			</div>
			</div>
		</div>
		<div class="m-index-mod m-index-goods-others">
			<div class="w-hd">
				<h3 class="w-hd-title">其他奖品</h3>
				<a class="w-hd-more" href="<?php echo WEB_PATH; ?>/goods_list">更多奖品,点击查看&gt;&gt;</a>
			</div>
			<div class="m-index-mod-bd">
				<ul id="readyLotteryItems" class="w-goodsList f-clear">
					<?php $ln=1;if(is_array($shoplist)) foreach($shoplist AS $shop): ?>
					<li class="w-goodsList-item">
						<div class="w-goods w-goods-ing">
							<div class="w-goods-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>.html" target="_blank" title="<?php echo $shop['title']; ?>"><img width="185px" height="185px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shop['thumb']; ?>" alt="<?php echo $shop['title']; ?>"></a></div>
							<p class="w-goods-title f-txtabb"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>.html" target="_blank" title="<?php echo $shop['title']; ?>">(第<?php echo $shop['qishu']; ?>期)<?php echo $shop['title']; ?></a></p>
							<p class="money">价值：<span class="rmb"><?php echo $shop['money']; ?></span></p>
							<div class="Progress-bar" style="">
								<p  class="w-progressBar-wrap" title="已完成<?php echo percent($shop['canyurenshu'],$shop['zongrenshu']); ?>"><span  class="w-progressBar-bar"  style="width:<?php echo width($shop['canyurenshu'],$shop['zongrenshu'],221); ?>px;"></span></p>
								<ul class="Pro-bar-li">
									<li class="P-bar01"><em><?php echo $shop['canyurenshu']; ?></em>已参与人次</li>
									<li class="P-bar02"><em><?php echo $shop['zongrenshu']; ?></em>总需人次</li>
									<li class="P-bar03"><em><?php echo $shop['zongrenshu']-$shop['canyurenshu']; ?></em>剩余人次</li>
								</ul>
							</div>
							<div class="w-goods-opr"><a class="w-button w-button-main w-button-l" style="width:96px;" href="<?php echo WEB_PATH; ?>/goods/<?php echo $shop['id']; ?>.html" target="_blank" class="shop_but" title="立即一元聚购">立即一元聚购</a></div>
						</div>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>			
				</ul>
			</div>
		</div> 
	</div>
	<div class="g-side">
		<div class="m-index-mod m-index-record-newest">
			<div class="m-index-mod-hd">
				<h3>最新参与记录</h3>
			</div>
			<div class="m-index-mod-bd">
					<ul id="buyList" class="w-record-newest-list">
					<?php $ln=1;if(is_array($go_record)) foreach($go_record AS $gorecord): ?>
					<li class="w-record-newest-item">
						<div class="w-record-goods">
							<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $gorecord['shopid']; ?>.html"  target="_blank">
							<img width="64px" height="58px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo shopimg($gorecord['shopid']); ?>"></a>
						</div>
						<div class="w-record-detail">
							<p class="w-record-intro"><a class="w-record-user" title="<?php echo get_user_name($gorecord); ?>ID(<?php echo idjia($gorecord['uid']); ?>)" href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($gorecord['uid']); ?>.html"><?php echo get_user_name($gorecord); ?></a>&nbsp;&nbsp;聚购了</p>
							<p class="w-record-title"><?php echo $gorecord['gonumber']; ?>人次&nbsp;&nbsp;<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $gorecord['shopid']; ?>.html" class="name" target="_blank"><?php echo $gorecord['shopname']; ?></a></p>
						</div>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
				</ul>
			</div>
			<div class="m-index-mod-ft">看看谁的狗屎运最好！</div>
		</div>
		<div class="m-index-mod m-index-record-nb">
			<div class="m-index-mod-hd">
				<h3>人气排行记录</h3>
			</div>
			<div class="m-index-mod-bd">
					<ul id="buyList" class="w-record-nb-list" >						
					<?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $list): ?>
					<li class="w-record-nb-item">
						<div class="w-record-avatar">
							<a href="<?php echo WEB_PATH; ?>/goods/<?php echo $list['id']; ?>.html" target="_blank">
							<?php if(shopimg($list['id'])!=''): ?>
								<img width="64px" height="58px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo shopimg($list['id']); ?>">
							<?php  else: ?>
								<img width="64px" height="58px" src="<?php echo G_UPLOAD_PATH; ?>/photo/member.jpg_30.jpg">
							<?php endif; ?>
							</a>
						</div>
						<div class="w-record-detail">
							<p class="w-record-intro"><a class="w-record-user f-txtabb"  href="<?php echo WEB_PATH; ?>/goods/<?php echo $list['id']; ?>.html" target="_blank"><?php echo $list['title']; ?></a></p>
							<p><i>剩余人次</i><em><?php echo $list['zongrenshu']-$list['canyurenshu']; ?></em></p>
						</div>
						
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
				</ul>
			</div>
			<div class="m-index-mod-ft">&nbsp;</div>
		</div>
	</div>
</div>
<div class="g-wrap g-body-ft f-clear">
	<div class="m-index-mod m-index-newArrivals">
		<div class="w-hd">
			<h3 class="w-hd-title">最新上架</h3>
			<a class="w-hd-more" href="<?php echo WEB_PATH; ?>/goods_list/0_0_4.html">更多新品，点击查看>></a>
		</div>
		<div class="m-index-mod-bd">
			<ul class="w-goodsList f-clear">
				<?php $ln=1;if(is_array($shoplistxinpin)) foreach($shoplistxinpin AS $shopxinpin): ?>
					<li class="w-goodsList-item">
						<div class="w-goods w-goods-brief">
							<div class="w-goods-pic"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shopxinpin['id']; ?>.html" target="_blank" title="<?php echo $shopxinpin['title']; ?>"><img width="185px" height="185px" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $shopxinpin['thumb']; ?>" alt="<?php echo $shopxinpin['title']; ?>"></a></div>
							<p class="w-goods-title f-txtabb"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $shopxinpin['id']; ?>.html" target="_blank" title="<?php echo $shopxinpin['title']; ?>"><?php echo $shopxinpin['title']; ?></a></p>
							<p class="w-goods-price">总需：&nbsp;&nbsp;<?php echo $shopxinpin['zongrenshu']; ?>&nbsp;&nbsp;人次</p>
						</div>
					</li>
					<?php  endforeach; $ln++; unset($ln); ?>
			</ul>
		</div>
	</div>
	<!--晒单分享开始-->
<div class="m-index-mod m-index-share">
	<div class="w-hd">
		<h3 class="w-hd-title">晒单分享</h3>
		<a class="w-hd-more" href="<?php echo WEB_PATH; ?>/go/shaidan/">更多分享，点击查看>></a>
	</div>
	<div class="m-index-mod-bd">
		<ul class="m-index-share-list f-clear" style="margin-top: 0px;" id="buyList1">
			<?php $ln=1;if(is_array($shaidan)) foreach($shaidan AS $sdfx): ?>
			<li class="m-index-share-item m-index-share-item-left">
				<a class="m-index-share-picLink" href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sdfx['sd_id']; ?>.html" target="_blank">
					<img width="110" class="m-index-share-pic" alt="<?php echo _strcut($sdfx['sd_title'],100); ?>" src="<?php echo G_UPLOAD_PATH; ?>/<?php echo $sdfx['sd_thumbs']; ?>" />
				</a>
				<div class="m-index-share-wrap">
					<i class="ico ico-quote ico-quote-former">&nbsp;</i>
					<p class="txt">
						<a href="<?php echo WEB_PATH; ?>/go/shaidan/detail/<?php echo $sdfx['sd_id']; ?>.html" target="_blank">
							<span title="<?php echo $sdfx['sd_title']; ?>">【<?php echo _strcut($sdfx['sd_title'],30); ?>】</span></a>
							<div class="pclass"><?php echo _strcut($sdfx['sd_content'],100); ?>
						</div>
					</p>
					<p class="author">
						--<a title="Lin(ID:<?php echo $sdfx['sd_userid']; ?>)" href="<?php echo WEB_PATH; ?>/uname/<?php echo $sdfx['sd_userid']; ?>.html" target="_blank">
						<?php echo get_user_name($sdfx['sd_userid']); ?>&nbsp;&nbsp;<?php echo date("Y-m-d",$sdfx['sd_time']); ?>
						</a>
					</p>
					<i class="ico ico-quote ico-quote-after">&nbsp;</i>
				</div>
			</li>
			<?php  endforeach; $ln++; unset($ln); ?>
		</ul>
	</div>
</div>
<div class="m-index-mod newslistindex">
	<div class="w-hd">
		<h3 class="w-hd-title">新闻资讯</h3>
		<a class="w-hd-more" href="<?php echo WEB_PATH; ?>/go/article/lists/26.html">更多新闻，点击查看>></a>
	</div>
		<div class="wordpress" style="width:1200px;overflow:hidden;margin:10px auto;">
		<?php $data=$this->DB()->GetList("SELECT cateid,name FROM `@#_category` WHERE `parentid` = '22' LIMIT 3",array("type"=>1,"key"=>'',"cache"=>0)); ?>
		<?php 
			foreach($data as $row){
		 ?>
		
		<div style="width:396px;overflow:hidden;margin:0 auto;float:left;">
			<div class="word_01tit" style="border-bottom:1px solid #f4f4f4;height:35px;">
				<h2 style="font-size:16px;color:#666;line-height:35px;font-weight:bold;">
					<a href="<?php echo WEB_PATH; ?>/go/article/lists/<?php echo $row['cateid']; ?>.html"><?php echo $row['name']; ?></a>
				</h2>
			</div>
			<div class="word_plist" style="">
				<?php $lists=$this->DB()->GetList("SELECT id,title FROM `@#_article` WHERE `cateid` = '$row[cateid]'  order by posttime desc LIMIT 5",array("type"=>1,"key"=>'',"cache"=>0)); ?>
				<?php 
					foreach($lists as $v){
				 ?>
				<li class="word_pl" style="height:30px;">
					<a href="<?php echo WEB_PATH; ?>/go/article/show/<?php echo $v['id']; ?>.html" style="line-height:30px;color:#666;font-size:12px;"><?php echo $v['title']; ?></a>
				</li>
				<?php 		
					}
				 ?>	
			</div>
		</div>		
		
		<?php 		
			}
		 ?>				
    </div>
</div>
<div class="m-index-mod newslistindex">
		<div class="w-hd">
		<h3 class="w-hd-title">有情连接</h3>
		<a class="w-hd-more" href="<?php echo WEB_PATH; ?>/link">更多连接，点击查看>></a>
		</div>
		<div id="Scroll"> 
		<ul id="ScrollMe" style="overflow: hidden; height: 27px;margin-top:0px;"> 
		    <?php $link_size=$this->DB()->GetList("select * from `@#_link` where `type`='1'",array("type"=>1,"key"=>'',"cache"=>0)); ?>			
			<?php $ln=1;if(is_array($link_size)) foreach($link_size AS $size): ?>	
			<li><a href="<?php echo $size['url']; ?>" target="_blank"><?php echo $size['name']; ?></a></li>
			<?php  endforeach; $ln++; unset($ln); ?>	
			<?php if(defined('G_IN_ADMIN')) {echo '<div style="padding:8px;background-color:#F93; color:#fff;border:1px solid #f60;text-align:center"><b>This Tag</b></div>';}?>
			<script>new srcMarquee("ScrollMe",0,1,1200,27,3,3000,3000,27)</script> 
		</ul>
	</div> 
</div>
<!--新闻列表-->
<style>
.lottery_news{ width:100%; border:1px solid #000;}
</style>
<!--/新闻列表-->
</div>
</div>
</div>
<?php include templates("index","footer");?>
<script type="text/javascript">
    $(function(){
		$(".m-catlog-wrap").show();
	    var _BuyList=$("#buyList");
        var Trundle = function () {
            _BuyList.prepend(_BuyList.find("li:last")).css('marginTop', '-85px');
            _BuyList.animate({ 'marginTop': '0px' }, 800);
        }
        var setTrundle = setInterval(Trundle, 3000);
        _BuyList.hover(function () {
            clearInterval(setTrundle);
            setTrundle = null;
        },function () {
            setTrundle = setInterval(Trundle, 3000);
        });
    });
	    $(function(){
	    var _BuyList=$("#buyList1");
        var Trundle = function () {
            _BuyList.prepend(_BuyList.find("li:last")).css('marginTop', '-85px');
            _BuyList.animate({ 'marginTop': '0px' }, 1500);
        }
        var setTrundle = setInterval(Trundle, 5000);
        _BuyList.hover(function () {
            clearInterval(setTrundle);
            setTrundle = null;
        },function () {
            setTrundle = setInterval(Trundle, 5000);
        });
    });
    </script>

	<script>
   $(".w-slide-wrap").mouseover(function(){
      $(".arrows").show();
   })
    $(".w-slide-wrap").mouseout(function(){
      $(".arrows").hide();
   })
//右移动
  $(".arrows1").click(function(){
	 var arae   = $(this).attr("arae");
	 var leftpx = parseInt($("#ulNewAwary").css("left"));	
	 var leftpx1 = $("#ulNewAwary").css("left");	
	 var time = 500;
	 if(arae == 'left'){
		leftpx += 730;
		//$(".controller-nav a").attr("alt","");
		//$(this).parents(".new_publish").find(".controller-nav").find("a").attr("alt","cur")
		//$(this).parents(".new_publish").find(".controller-nav").find(".cur").css("background","#000");
	 }else{
		leftpx -= 730;
	 }	 
	 if((leftpx < (-730 * 2))){
		leftpx = 0;	
		time = 250;
	 }
	 
	 if(leftpx > 0){		
		leftpx = (-730*2);
		time = 250;
	 }	 
 
	 if(leftpx1 == "0px"){
	   $("#cur_k2").css("background","#db3652");
	   $("#cur_k1").css("background","#b7b7b7");
	   $("#cur_k3").css("background","#b7b7b7");
	 }
	 if(leftpx1 == "-730px"){
	   $("#cur_k3").css("background","#db3652");
	   $("#cur_k1").css("background","#b7b7b7");
	   $("#cur_k2").css("background","#b7b7b7");
	 }
	  if(leftpx1 == "-1460px"){
	   $("#cur_k1").css("background","#db3652");
	   $("#cur_k2").css("background","#b7b7b7");
	   $("#cur_k3").css("background","#b7b7b7");
	 }
	 	 $("#ulNewAwary").animate({left:leftpx+"px"});	
  });
//左移动
  $(".arrows2").click(function(){
	 var arae   = $(this).attr("arae");
	 var leftpx = parseInt($("#ulNewAwary").css("left"));	
	 var leftpx1 = $("#ulNewAwary").css("left");	 
	 var time = 500;
	 if(arae == 'left'){
		leftpx += 730;
	 }else{
		leftpx -= 730;
	 }	 
	 if((leftpx < (-730 * 2))){
		leftpx = 0;	
		time = 250;
	 }
	 
	 if(leftpx > 0){		
		leftpx = (-730*2);
		time = 250;
	 }	 
 
	 if(leftpx1 == "0px"){
	   $("#cur_k3").css("background","#db3652");
	   $("#cur_k1").css("background","#b7b7b7");
	   $("#cur_k2").css("background","#b7b7b7");
	 }
	 if(leftpx1 == "-1460px"){
	   $("#cur_k2").css("background","#db3652");
	   $("#cur_k1").css("background","#b7b7b7");
	   $("#cur_k3").css("background","#b7b7b7");
	 }
	  if(leftpx1 == "-730px"){
	   $("#cur_k1").css("background","#db3652");
	   $("#cur_k2").css("background","#b7b7b7");
	   $("#cur_k3").css("background","#b7b7b7");
	 }
	 	 $("#ulNewAwary").animate({left:leftpx+"px"});	
  }); 
$("#cur_k1").click(function(){
     var qarae   = $(this).attr("qarae");
	 var leftpx = parseInt($("#ulNewAwary").css("left"));	
	 if(qarae == 'lee'){
		leftpx =0;
	 }else{
		leftpx = leftpx-730;
	 }	 
	  $("#ulNewAwary").animate({left:leftpx+"px"});	 
       $(this).css("background","#db3652");
	   $("#cur_k2").css("background","#b7b7b7");
	   $("#cur_k3").css("background","#b7b7b7");
  });
  $("#cur_k2").click(function(){
     var warae   = $(this).attr("qarae");
	 var leftpx = parseInt($("#ulNewAwary").css("left"));	
	  if(warae == 'lel'){
		leftpx = -730;
	 }else{
		leftpx =leftpx+730;
	 }	 
	  $("#ulNewAwary").animate({left:leftpx+"px"});	
       $(this).css("background","#db3652");
       $("#cur_k1").css("background","#b7b7b7");
	   $("#cur_k3").css("background","#b7b7b7");
  });
  $("#cur_k3").click(function(){
     var earae   = $(this).attr("qarae");
	 var leftpx = parseInt($("#ulNewAwary").css("left"));	
	  if(earae == 'lcc'){
		leftpx = -1460;
	 }else{
		leftpx =leftpx+730;
	 }	 
	  $("#ulNewAwary").animate({left:leftpx+"px"});	
       $(this).css("background","#db3652");
	   $("#cur_k1").css("background","#b7b7b7");
	   $("#cur_k2").css("background","#b7b7b7");
	    
  });  
</script>
<script>
   $(".rect_rem").mouseover(function(){
      $(".arr_row").show();
   })
    $(".rect_rem").mouseout(function(){
      $(".arr_row").hide();
   })
//banner 右侧左右移动
  $(".arr_row").click(function(){
	 var arae1   = $(this).attr("arae1");
	 var leftpx1 = parseInt($("#prpr_po").css("left"));	
	 if(arae1 == 'left1'){
		leftpx1 += 230;
	 }else{
		leftpx1 -= 230;
	 }	 
	 if((leftpx1 < (-230 * 2))){
		leftpx1 = 0;	
	 }
	 
	 if(leftpx1 > 0){		
		leftpx1 = (-230*2);
	 }	 
	 $("#prpr_po").animate({left:leftpx1+"px"});

  });
</script>
