<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>﻿<?php include templates("index","header");?>
<div class="layout980 clearfix">
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/layout-home.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE; ?>/css/encourage.css"/>
<?php include templates("member","left");?>
<div class="center">
	<div class="per-info">
	  <div class="i-main span-19 last">
		<ul>
		<div class="i-tip yellow-tip">
				<span class="c-999">温馨提示:最近有不法分子利用伪装客服行骗,请认准一元聚购唯一客服QQ：53403713</span>
				<p class="orange"><a href="" class="green" target="_blank" hidefocus="true"></a></p>
					 <!--鼓励奖插件开始-->
					<?php 	
					System::load_app_fun("encourageshow","encourage_award");
					$dd= encourageshow($member['uid']);
					 ?>	
					<?php if($dd): ?>
					<div class="eyghelp" >	
						 <ul class="Erecord_title">
							<li class="gljcss">鼓励奖等级</li>
							<li class="gljcsspl">商品名称</li>
							<li class="gljcss">商品期数</li>
							<li class="gljcss">获奖闪购码</li>
							<li class="much">奖品</li>
							<li class="gljcss">是否领取</li>
						</ul>
						<?php $ln=1;if(is_array($dd)) foreach($dd AS $eshow): ?> 
						<ul class="Erecord_content">
							<li class="gljcss"><?php echo $eshow['e_type']; ?>等奖</li>
							<li class="gljcsspl"><?php echo $eshow['e_shopname']; ?></li>
							<li class="gljcss"><?php echo $eshow['e_qishu']; ?></li>
							<li class="gljcss"><?php echo $eshow['e_code']; ?></li>
							<li class="much"><?php echo $eshow['e_content']; ?></li>
							 <li class="gljcss">		    
							<?php if($eshow['e_get']=='Y'): ?>已领取<?php endif; ?>			
							<?php if($eshow['e_get']=='N'): ?>	
							<a href="<?php echo WEB_PATH; ?>/encourage_award/encourageget/init/<?php echo $eshow['e_id']; ?>"  style="display: block;width: 50px;height: 23px;background: #FFF;line-height: 22px;text-align: center;border-radius: 2px;color: #f40;">	
							去领取</a>		
							<?php endif; ?>								
							</li>
						</ul>			
					<?php  endforeach; $ln++; unset($ln); ?>
				</div> 	
				<?php endif; ?>		
			 <!--鼓励奖插件结束-->	
		</div>
		<h5>我的账号</h5>
		<div class="i-mod-bg my-account w700">
		 <div class="i-mod-wrapper gradient-white">
			<div class="title">
				  <span class="c-999">账号名：</span>
				  <a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($member['uid']); ?>" target="_blank" class="blue"><s></s>
					  <b>	<?php if($member['username']!=null): ?>
						<?php echo $member['username']; ?>
						<?php elseif ($member['mobile']!=null): ?>
						<?php echo $member['mobile']; ?>
						<?php  else: ?>
						<?php echo $member['email']; ?>
						<?php endif; ?>
						</b>
						<?php if($member['username']!=null): ?>
						(
						<?php if($member['mobile']!=null): ?>
						<?php echo $member['mobile']; ?>
						<?php  else: ?>
						<?php echo $member['email']; ?>
						<?php endif; ?>
						)
						<?php endif; ?></b>
					</a>
				<span class="grade"><span class="vip normal"></span><a href="<?php echo WEB_PATH; ?>/uname/<?php echo idjia($member['uid']); ?>" class="blue" hidefocus="true">[个人主页]</a><b>（ID：<?php echo $member['uid']; ?>）</b></span>
			</div>
			<div class="desc clearfix">
				<div class="msg clearfix fl lower">
					<li class="account-money">
						<em class = "gray02">账户安全：</em> 
						<span class="class-icon0 gray01"><s></s>
						<?php if($member['mobile']!=null && $member['mobilecode']=='1'): ?><?php echo $member['mobile']; ?><span>手机已验证</span>
						<?php  else: ?>
						<a href="<?php echo WEB_PATH; ?>/member/home/mobilechecking" class="blue">[绑定手机]</a><?php endif; ?>&nbsp;
						<?php if($member['email']!=null && $member['emailcode']=='1'): ?>	<?php echo $member['email']; ?><span>邮箱已验证</span>
						<?php  else: ?>
						<a href="<?php echo WEB_PATH; ?>/member/home/mailchecking" class="blue">[绑定邮箱]</a><?php endif; ?>&nbsp;
						<?php if($member_qq['b_id']!=null || $member_qq['b_type']=='qq'): ?><span>QQ已绑定</span>
						<?php  else: ?>
						<a href="<?php echo WEB_PATH; ?>/member/home/qqclock" class="blue">[绑定QQ]</a>
						</span><span class = "gray02">(为了您账号的安全建议绑定手机或邮箱)</span>
						<?php endif; ?>
					</li>			
					<li class="account-money">
						<em class = "gray02">经验值：<?php echo $member['jingyan']; ?></em> 
						<span class="class-icon0<?php echo $dengji_1['groupid']; ?> gray01"><s></s><?php echo $dengji_1['name']; ?></span>
						<?php if($dengji_2): ?>
							<span class = "gray02">（还差<?php echo $dengji_x; ?>经验值升级到<?php echo $dengji_2['name']; ?>）</span>
						<?php  else: ?>
							<span class = "gray02">（还差<?php echo $dengji_x; ?>经验值升级到最高等级）</span>
						<?php endif; ?>
					</li>
				</div>
			</div>
		</div>
	</div>
 	<li class="account-money">
		<h5>帐户余额：<span class="money-red"><s></s><?php echo uidcookie('money'); ?></span>&nbsp;&nbsp;
		<a href="<?php echo WEB_PATH; ?>/member/home/userrecharge" title="充值" class="blue">[我要充值]</a>
		夺宝币：<span class="money-red"><em><?php echo $member['score']; ?></em></span> <span class="c-999">（夺宝币可以购物使用）</span></h5>
	<div class="grey-bg w700">
		<div class="p0-15">
			<p>
				<span class="green-price"><span class="c-999"></span></span>  夺宝币兑换现金比例：
					<span class="money-red">
									5夺宝币 / 100夺宝币&nbsp;(1元=1000夺宝币)	 = 
					<?php echo $shourutotal; ?>元&nbsp;(取整数)
					</span>&nbsp;&nbsp;
			</p>
			<p>推广提成：<b class="orange">0</b>元&nbsp;&nbsp;（邀请好友可以获得6%现金提成+邀请好友注册完成可获得500夺宝币奖励）</a></p></span>
			<p>
				<span class="btn"><a class="i" href="<?php echo WEB_PATH; ?>/member/home/commissions" hidefocus="true">邀请返利收入</a></span>
				<span class="btn"><a class="i" href="<?php echo WEB_PATH; ?>/member/home/commissions" hidefocus="true">佣金明细</a></span>
				<span class="btn"><a class="i" href="<?php echo WEB_PATH; ?>/member/home/cashout" hidefocus="true">佣金提现</a></span>
				<span class="btn"><a class="i" href="<?php echo WEB_PATH; ?>/member/home/record" hidefocus="true">提现记录</a></span>
			</p>
		</div>
	</div>
	<h5>我的邀请：［邀请好友： 100夺宝币 5经验］ <a class="c-999" target="_blank" href="<?php echo WEB_PATH; ?>/member/home/invitefriends" hidefocus="true">赶紧邀请去&gt;&gt;</a> </h5>
	<p class="c-999">说明:[资料昵称完善： 200夺宝币 100经验][商品购买： 50夺宝币 20经验][手机验证完善： 1000夺宝币 20经验]</p>
	</li>
	</ul>	
</div>
			 
</div>

</div>
<!--center_center_end-->
<div class="right">				
	<div class="groups-shadow clearfix">
		<div class="R-grtit">
			<h3>圈子热门话题</h3>
		</div>
		<div class="m-results-leastRemain-title-ft"></div>
		<ul class="R-list">
			<?php $ln=1;if(is_array($quanzi)) foreach($quanzi AS $tm): ?>
			<li>
				<p class="groups-t"><a href="<?php echo WEB_PATH; ?>/group/nei/<?php echo $tm['id']; ?>" target="_blank" class="gray"><?php echo $tm['title']; ?></a></p>
				<p class="groups-c gray02"><?php echo qztitle($tm['qzid']); ?><span class="gray03"> | </span><?php echo tiezi($tm['id']); ?>条回复</p>
			</li>
			<?php  endforeach; $ln++; unset($ln); ?>
		</ul>
	</div> 
	<p class="r-line"></p>
	<!-- <div class="gg-content">
		<div class="R-grtit"><h3>公告栏</h3></div>
		<ul class="gg-list">	
			<li><span class="point"></span><span class="info"><a href="http://group.1yyg.com/Topic-621.html" target="_blank" class="gray" title="关于“幸运聚购码”计算结果错误的公告">关于“幸运聚购码”计算结果错误的公告</a></span></li>
		</ul>
	</div> -->
</div>
<!--center_rjght_end-->

</div>

<?php include templates("index","footer");?>