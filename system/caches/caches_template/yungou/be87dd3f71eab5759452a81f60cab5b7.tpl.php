<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $webname; ?></title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="<?php echo G_TEMPLATES_IMAGE; ?>/mobile/touch-icon.png" rel="apple-touch-icon-precomposed" />
    <link href="favicon.ico" rel="shortcut icon" />
    <link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/comm.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo G_TEMPLATES_CSS; ?>/mobile/index.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo G_TEMPLATES_JS; ?>/mobile/jquery190.js" language="javascript" type="text/javascript"></script>
	<script id="pageJS" data="<?php echo G_TEMPLATES_JS; ?>/mobile/Index.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<div class="h5-1yyg-v1" id="loadingPicBlock">    

<?php include templates("mobile/index","header");?>

<!-- 内页顶部 -->

    <input name="hidStartAt" type="hidden" id="hidStartAt" value="0" />
    <!-- 焦点图 -->
    <section id="sliderBox" class="hotimg"></section>
	    <!-- 最新揭晓 -->
    <section class="g-main">
		    <ul class="m-lott-lipro">
			        <li>
		                <a href="<?php echo WEB_PATH; ?>/mobile/mobile/glist" class="u-lott-pic">
		                    <img src="http://m.yungoutest.com/statics/templates/quyu-1yygkuan/images/nava1.png" border="0" alt="" />
		                </a>
		                <span><a href="<?php echo WEB_PATH; ?>/mobile/mobile/glist">最新奖品</a></span>
			        </li>
				<li>
		                <a href="<?php echo WEB_PATH; ?>/mobile/shaidan/" class="u-lott-pic">
		                    <img src="http://m.yungoutest.com/statics/templates/quyu-1yygkuan/images/nava2.png" border="0" alt="" />
		                </a>
		                <span><a href="<?php echo WEB_PATH; ?>/mobile/shaidan/">最新晒单</a></span>
			        </li>
					 <li>
		                <a href="<?php echo WEB_PATH; ?>/mobile/home/userbuylist" class="u-lott-pic">
		                    <img src="http://m.yungoutest.com/statics/templates/quyu-1yygkuan/images/nava3.png" border="0" alt="" />
		                </a>
		                <span><a href="<?php echo WEB_PATH; ?>/mobile/home/userbuylist">聚购记录</a></span>
			        </li>
					 <li>
		                <a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" class="u-lott-pic">
		                    <img src="http://m.yungoutest.com/statics/templates/quyu-1yygkuan/images/nava4.png" border="0" alt="" />
		                </a>
		                <span><a href="<?php echo WEB_PATH; ?>/mobile/home/userrecharge" >账户充值</a></span>
			        </li>
		    </ul>

    </section>
    <!-- 最新揭晓 -->
    <section class="g-main">
	    <div class="m-tt1">
		    <h2 class="fl"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery">最新揭晓</a></h2>
		    <div class="fr u-more">
			    <a href="<?php echo WEB_PATH; ?>/mobile/mobile/lottery" class="u-rs-m1"><b class="z-arrow"></b></a>
		    </div>
	    </div>
	    <article class="h5-1yyg-w310 m-round m-lott-li" id="divLottery">
		<div class="w-slide-wrap">
		    <ul class="clearfix">
		    <?php $ln=1;if(is_array($shopqishu)) foreach($shopqishu AS $qishu): ?>
            <?php 
            $qishu['q_user'] = unserialize($qishu['q_user']);
             ?>
			        <li>
		                <a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $qishu['id']; ?>" class="u-lott-pic">
		                    <img src="<?php echo G_TEMPLATES_IMAGE; ?>/loading.gif" src2="<?php echo G_UPLOAD_PATH; ?>/<?php echo $qishu['thumb']; ?>" border="0" alt="" />
		                </a>
		                <span>恭喜<a href="<?php echo WEB_PATH; ?>/mobile/mobile/userindex/<?php echo $qishu['q_uid']; ?>" class="blue z-user"><?php echo get_user_name($qishu['q_uid']); ?></a>获得</span>
			        </li>
		        
			   <?php  endforeach; $ln++; unset($ln); ?>     
		        
		    </ul>
		</div>
	    </article>
		<script type="text/javascript" src="<?php echo G_TEMPLATES_JS; ?>/mobile/GLotteryFun.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){gg_show_time_init("divLottery",'<?php echo WEB_PATH; ?>',0);});
        </script>
    </section>
    <!-- 热门推荐 -->
    <section class="g-main">
	    <div class="m-tt1">
		    <h2 class="fl"><a href="<?php echo WEB_PATH; ?>/mobile/mobile/glist">热门推荐</a></h2>
		    <div class="fr u-more">
			    <a href="<?php echo WEB_PATH; ?>/mobile/mobile/glist" class="u-rs-m1"><b class="z-arrow"></b></a>
		    </div>
	    </div>
	    <article class="clearfix h5-1yyg-w310 m-round m-tj-li">
		    <ul id="ulRecommend">
		        <?php $ln=1;if(is_array($shoplistrenqi)) foreach($shoplistrenqi AS $renqi): ?>
			        <li id="<?php echo $renqi['id']; ?>">
			            <div class="f_bor_tr">
			                <div class="m-tj-pic">
			                    <a href="<?php echo WEB_PATH; ?>/mobile/mobile/item/<?php echo $renqi['id']; ?>" class="u-lott-pic">
			                        <img src="<?php echo G_TEMPLATES_IMAGE; ?>/loading.gif" src2="<?php echo G_UPLOAD_PATH; ?>/<?php echo $renqi['thumb']; ?>" border=0 alt="" />
			                    </a>
			                    <ins class="u-promo">价值:￥<?php echo $renqi['money']; ?></ins>
			                </div>
			                <div class="Progress-bar">
								<p class="u-progress" title="已完成<?php echo percent($renqi['canyurenshu'],$renqi['zongrenshu']); ?>">
								<span class="pgbar" style="width:<?php echo $renqi['canyurenshu']/$renqi['zongrenshu']*100; ?>%;">
								<span class="pging"></span>
								</span>
								</p>
								<ul class="Pro-bar-li">
									<li class="P-bar01"><em><?php echo $renqi['canyurenshu']; ?></em>已参与</li>
									<li class="P-bar02"><em><?php echo $renqi['zongrenshu']; ?></em>总需人次</li>
									<li class="P-bar03"><em><?php echo $renqi['zongrenshu']-$renqi['canyurenshu']; ?></em>剩余</li>
								</ul>
							</div>
			            </div>
                    </li>
                <?php  endforeach; $ln++; unset($ln); ?>
		    </ul>
	    </article>
    </section>
    

<?php include templates("mobile/index","footer");?>
<script language="javascript" type="text/javascript">
  var Path = new Object();
  Path.Skin="<?php echo G_WEB_PATH; ?>/statics/templates/yungou";  
  Path.Webpath = "<?php echo WEB_PATH; ?>";
  
    var Base = {
        head: document.getElementsByTagName("head")[0] || document.documentElement,
        Myload: function(B, A) {
            this.done = false;
            B.onload = B.onreadystatechange = function() {
                if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                    this.done = true;
                    A();
                    B.onload = B.onreadystatechange = null;
                    if (this.head && B.parentNode) {
                        this.head.removeChild(B)
                    }
                }
            }
        },
        getScript: function(A, C) {
            var B = function() {};
            if (C != undefined) {
                B = C
            }
            var D = document.createElement("script");
            D.setAttribute("language", "javascript");
            D.setAttribute("type", "text/javascript");
            D.setAttribute("src", A);
            this.head.appendChild(D);
            this.Myload(D, B)
        },
        getStyle: function(A, B) {
            var B = function() {};
            if (callBack != undefined) {
                B = callBack
            }
            var C = document.createElement("link");
            C.setAttribute("type", "text/css");
            C.setAttribute("rel", "stylesheet");
            C.setAttribute("href", A);
            this.head.appendChild(C);
            this.Myload(C, B)
        }
    }
    function GetVerNum() {
        var D = new Date();
        return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0': D.getMinutes().toString().substring(0, 1))
    }
    Base.getScript('<?php echo G_TEMPLATES_JS; ?>/mobile/Bottom.js?v=' + GetVerNum());
</script>

</div>
</body>
</html>
