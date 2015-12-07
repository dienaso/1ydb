<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
  
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/index/css/index.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/css/jquery.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/css/tendina.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/css/common.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/plugins/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/plugins/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/plugins/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/plugins/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/custom/general.js"></script>
<script type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/index/js/custom/dashboard.js"></script>
 </head>
 <body>
 <body>

    <!--菜单-->
    <div class="layout_left_menu">
        <ul id="menu">
            <li class="childUlLi">
               <a href="main.html"  target="menuFrame"><i class="glyph-icon icon-home"></i>常用配置</a>
                <ul>
            <li ><a href="<?php echo G_MODULE_PATH; ?>/setting/config" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i></span>基本信息</a></li>
		    <li><a href="<?php echo WEB_PATH; ?>/pay/pay/pay_list" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>支付方式</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/member/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>会员中心</a></li>
            <li><a href="<?php echo G_MODULE_PATH; ?>/setting/email" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>邮箱配置</a></li>
		    <li><a href="<?php echo G_ADMIN_PATH; ?>/setting/mobile" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>短信配置</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/sign/sign_admin/lists/" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>签到模块</a></li>
            <li><a href="<?php echo G_ADMIN_PATH; ?>/content/goods_add" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加新商品</a></li>
            <li><a href="<?php echo G_ADMIN_PATH; ?>/dingdan/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>订单列表</a></li>
            <li><a href="<?php echo WEB_PATH; ?>/member/member/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>会员列表</a></li>
            <li><a href="<?php echo G_ADMIN_PATH; ?>/cache/init" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>清空缓存</a></li>
          
                </ul>
            </li>

            <li class="childUlLi">
               <a href="main.html"  target="menuFrame"><i class="glyph-icon icon-home"></i>系统设置</a>
                <ul>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/setting/webcfg" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>SEO设置</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/setting/config" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>基本信息</a></li>
					<li><a href="<?php echo WEB_PATH; ?>/header/set/index" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>顶部设置</a></li>
					 <li><a href="<?php echo WEB_PATH; ?>/pay/pay/pay_list" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>支付方式</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/setting/upload" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>上传设置</a></li>
                   
                    <li><a href="<?php echo G_MODULE_PATH; ?>/setting/mobile" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>短信配置</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/template/temp" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>通知模板配置</a></li>
                   
                    <li><a href="<?php echo G_MODULE_PATH; ?>/setting/domain" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>手机域名绑定</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/qq_admin" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>官方QQ群</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/user/lists" target="_blank"><i class="glyph-icon icon-chevron-right"></i>管理员管理</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/user/reg" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加管理员</a></li>
                </ul>
            </li>
            <li class="childUlLi">
                <a href="user.html"  target="menuFrame"> <i class="glyph-icon icon-reorder"></i>内容管理</a>
                <ul>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/content/article_add" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加文章</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/content/article_list" target="_blank"><i class="glyph-icon icon-chevron-right"></i>文章列表</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/category/lists/article" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>文章分类</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/category/addcate/danweb" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加单页</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/category/lists/single" target="_blank"><i class="glyph-icon icon-chevron-right"></i>单页列表</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/upload/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>上传文件管理</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/content/model" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>内容模型</a></li>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/category/lists" target="_blank"><i class="glyph-icon icon-chevron-right"></i>栏目管理</a></li>
                    <li><a href="<?php echo WEB_PATH; ?>/group/quanzi" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>圈子模块</a></li>
                    
                    <li><a href="<?php echo G_MODULE_PATH; ?>/cache/init" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>清空缓存</a></li> 
                </ul>
            </li>
            <li class="childUlLi">
                <a href="role.html" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>商品管理</a>
                <ul>
                    <li><a href="<?php echo G_MODULE_PATH; ?>/content/goods_add" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加商品</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/content/goods_list" target="_blank"><i class="glyph-icon icon-chevron-right"></i>商品列表</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/category/lists/goods" target="_blank"><i class="glyph-icon icon-chevron-right"></i>商品分类</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/brand/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>品牌管理</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/brand/insert" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加品牌</a></li> 
         
                    <li><a href="<?php echo G_MODULE_PATH; ?>/dingdan/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>订单列表</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/dingdan/select" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>订单查询</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/dingdan/lists/zj" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>中奖订单</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/dingdan/lists/notsend" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>等待发货</a></li> 
                </ul>
            </li>
            <li class="childUlLi">
               <a href="role.html" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>直购管理</a>
                <ul>
                  	<li><a href="<?php echo G_MODULE_PATH; ?>/content/jf_goods_add" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加商品</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/content/jf_goods_list" target="_blank"><i class="glyph-icon icon-chevron-right"></i>商品列表</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/category/lists/jf_goods" target="_blank"><i class="glyph-icon icon-chevron-right"></i>商品分类</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/jf_brand/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>品牌管理</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/jf_dingdan/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>订单列表</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/jf_dingdan/select" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>订单查询</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/jf_dingdan/lists/notsend" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>等待发货</a></li> 
                </ul>
            </li>

            <li class="childUlLi">
               <a href="role.html" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>用户管理</a>
                <ul>
                  	 <li><a href="<?php echo WEB_PATH; ?>/member/member/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>会员列表</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/member/member/select" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>查找会员</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/member/member/insert" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>添加会员</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/member/member/config" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>会员配置</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/member/member/recharge" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>充值记录</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/member/member/pay_list" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>消费记录</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/member/member/member_group" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>会员组</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/member/member/commissions" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>佣金管理</a></li>
                     <li><a href="<?php echo G_MODULE_PATH; ?>/content/goods_list/xianshi" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>限时揭晓</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/go/shaidan_admin/init" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>晒单查看</a></li>
                </ul>
            </li>

            <li class="childUlLi">
               <a href="role.html" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>界面管理</a>
                <ul>
                   	 <li><a href="<?php echo G_MODULE_PATH; ?>/ments/navigation" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>导航条管理</a></li>
                     <li><a href="<?php echo WEB_PATH; ?>/mobile/wap" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>手机幻灯管理</a></li>


                     <li><a href="<?php echo G_MODULE_PATH; ?>/template" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>模板设置</a></li>
                     <li><a href="<?php echo G_MODULE_PATH; ?>/template/see" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>查看模板</a></li>
                     
                     <li><a href="<?php echo WEB_PATH; ?>/admanage/admanage_admin" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>广告模块</a></li>
                </ul>
            </li>

			            <li class="childUlLi">
               <a href="role.html" target="menuFrame"> <i class="glyph-icon icon-reorder"></i>极光助手</a>
                <ul>
					<li><a href="<?php echo WEB_PATH; ?>/api/qqlogin/qq_set_config" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>QQ登陆</a></li> 
					<li><a href="<?php echo WEB_PATH; ?>/api/qqlogin/wx_set_config" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>微信登陆</a></li> 
                    <li><a href="<?php echo WEB_PATH; ?>/admin/fund/fundset" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>公益基金</a></li> 
                    <li><a href="<?php echo WEB_PATH; ?>/autojujgaaa/auto_p/show" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>自动购买</a></li> 
                    <li><a href="<?php echo G_MODULE_PATH; ?>/auto_register/show" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>批量注册</a></li> 
                    <li><a href="<?php echo WEB_PATH; ?>/cardrecharge/cardrecharge" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>生成卡密</a></li> 
                    <li><a href="<?php echo WEB_PATH; ?>/cardrecharge/cardrecharge/lists" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>管理列表</a></li> 
                    <li><a href="<?php echo WEB_PATH; ?>/cardrecharge/cardrecharge/update_pwd" target="mainFrame"><i class="glyph-icon icon-chevron-right"></i>修改密码</a></li> 
                </ul>
            </li>
        </ul>
    </div>
   
   
</body>
 </body>
</html>
