<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/lottery/css.css"/>
<script type="text/javascript" src="<?php echo G_TEMPLATES_CSS; ?>/lottery/jQueryRotate.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_CSS; ?>/lottery/js.js"></script>

<div class="bg111">
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top" style="position: absolute;left: 100px;top: 210px;">
				<div class="bg222" style="position: relative;">
					<div id="marqueebox1" style="color: #FFC;">
						<ul>
							<?php $ln=1;if(is_array($LotteryList)) foreach($LotteryList AS $item): ?>
								<li>【<?php echo userid($item['uid'],'username'); ?>***】：抽中<?php echo $item['title']; ?>，获得<?php echo $item['desc']; ?>；</li>
							<?php  endforeach; $ln++; unset($ln); ?>
							<?php 
							for($i=19;$i>count($LotteryList);$i--){
								echo '<li>　</li>';
							}
							 ?>
						</ul>
					</div>
				</div>
			</td>
			<td>
				<div id="lottery" style="position: absolute; left: 670px; top: 210px;">
					<img id="imgs" src="<?php echo G_TEMPLATES_CSS; ?>/lottery/disc-rotate.gif" style="position: absolute; left: 47px; top: 47px; width: 352px; height: 352px;" class="image">
					<div class="arrow"></div>
					<div class="first" id="lot-btn">
						<span></span>
					</div>
				</div>
					<div style="position: absolute;left: 780px;color: yellow;top: 660px;font-size: 20px;" id="lottery_tips">
						<?php 
						if ( !$this->userinfo ){
							echo '您还没有登陆，无法参与抽奖哦';
						}else if ($this->userinfo['score'] > 1000) {
							echo '您拥有的夺宝币足够抽奖啦！';
						}else{
							echo '抱歉，您还没有抽奖机会快去赚夺宝币吧！';
						}
						 ?>
					</div>
			</td>
		</tr>
	</table>

<style>
#userrecharge{
	position: absolute;
	left: 850px;
	top: 760px;
	background: rgb(238,5,50);
	text-shadow: 2px 2px rgba(0,0,0,.3);
	padding: 8px 15px 10px 15px;
	border-radius: 10px;
}
#userrecharge a{
	color: white;
	font-weight: bold;
	font-size: 35px;
	font-family: "Microsoft YaHei",微软雅黑,"Microsoft JhengHei",华文细黑,STHeiti,MingLiu;
}
#userrecharge a:hover{
	color: #F2CC34;
}

</style>
	<div id="userrecharge">
		<a href="">去得夺宝币</a>
	</div>


</div>

<div class="part4 ">
	<div class="wrap">
	<dl class="activeRegulation fl">
		<dt>活动规则：</dt>
		<dd>
			<i>1</i>活动时间:结束时间以网站公告为准（应广大会员要求，活动时间再次延长）
		</dd>
		<dd>
			<i>2</i>活动内容：在活动时间内，所有注册会员购买商品，做任务得到夺宝币满1000获得一次抽奖机会哦！
					</dd>
		<dd>
			<i>3</i>活动奖品：一等奖10元商城红包，二等奖8元商城红包，三等奖6元商城红包，四等奖4元商城红包，五等奖3元商城红包，六等奖2元商城红包，七等奖1元商城红包。
		</dd>
		<dd>
			<i>4</i>活动说明：响应广大会员要求，活动时间再次延长，本次活动中奖率100%，获得对应红包后会即时到您的<?php echo _cfg('web_name_two'); ?>帐户，红包金额不得提现。
		</dd>
		<dd>
			<i>5</i>对于查实的作弊行为，扣除一切红包，取消抽奖资格。借助网站及其他平台，恶意获取红包，一经查实，扣除一切红包金额，清除云币账户且封号。
		</dd>
	</dl>
    </div>
</div>

<script>
var WEB_PATH = "<?php echo WEB_PATH; ?>";
</script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_CSS; ?>/lottery/jQueryRotate.js"></script>
<script type="text/javascript" src="<?php echo G_TEMPLATES_CSS; ?>/lottery/js.js"></script>

<?php include templates("index","footer");?>