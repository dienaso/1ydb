<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo G_PLUGIN_PATH; ?>/layer/layer.min.js"></script>
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/global.js"></script>
</head>
<body>

<script type="text/javascript">
var ready=1;
var kj_width;
var kj_height;
var header_height=100;
var R_label;
var R_label_one = "当前位置: 系统设置 >";


function left(init){
	var left = document.getElementById("left");
	var leftlist = left.getElementsByTagName("ul");
	
	for (var k=0; k<leftlist.length; k++){
		leftlist[k].style.display="none";
	}
	document.getElementById(init).style.display="block";
}

function secBoard(elementID,n,init,r_lable) {
			
	var elem = document.getElementById(elementID);
	var elemlist = elem.getElementsByTagName("li");
	for (var i=0; i<elemlist.length; i++) {
		elemlist[i].className = "normal";		
	}
	elemlist[n].className = "current";
	R_label_one="当前位置: "+r_lable+" >";
	R_label.text(R_label_one);
	left(init);
}


function set_div(){
		kj_width=$(window).width();
		kj_height=$(window).height();
		if(kj_width<1000){kj_width=1000;}
		if(kj_height<500){kj_height=500;}

		$("#header").css('width',kj_width); 
		$("#header").css('height',header_height);
		$("#left").css('height',kj_height-header_height); 
	    $("#right").css('height',kj_height-header_height); 
		$("#left").css('top',header_height); 
		$("#right").css('top',header_height);
		
		$("#left").css('width',180);		
		$("#right").css('width',kj_width-182); 
		$("#right").css('left',182);
		
		$("#right_iframe").css('width',kj_width-206); 
		$("#right_iframe").css('height',kj_height-148);
		 		
		$("#iframe_src").css('width',kj_width-208); 
		$("#iframe_src").css('height',kj_height-150); 	
		
		$("#off_on").css('height',kj_height-180);
		
		var nav=$("#nav");		
		nav.css("left",(kj_width-nav.get(0).offsetWidth)/2);
		nav.css("top",61);
}


$(document).ready(function(){	
		set_div();		
		$("#off_on").click(function(){
				if($(this).attr('val')=='open'){
					$(this).attr('val','exit');
					$("#right").css('width',kj_width);
					$("#right").css('left',1);
					$("#right_iframe").css('width',kj_width-25); 
					$("iframe").css('width',kj_width-27);
				}else{
					$(this).attr('val','open');
					$("#right").css('width',kj_width-182);
					$("#right").css('left',182);
					$("#right_iframe").css('width',kj_width-206); 
					$("iframe").css('width',kj_width-208);
				}
		});
		
		left('setting');
		$(".left_date a").click(function(){
				$(".left_date li").removeClass("set");						  
				$(this).parent().addClass("set");
				R_label.text(R_label_one+' '+$(this).text()+' >');
				$("#iframe_src").attr("src",$(this).attr("src"));
		});
		$("#iframe_src").attr("src","<?php echo G_MODULE_PATH; ?>/index/Tdefault");
		R_label=$("#R_label");
		$('body').bind('contextmenu',function(){return false;});
		$('body').bind("selectstart",function(){return false;});
				
});

function api_off_on_open(key){
	if(key=='open'){
				$("#off_on").attr('val','exit');
				$("#right").css('width',kj_width);
				$("#right").css('left',1);
				$("#right_iframe").css('width',kj_width-25); 
				$("iframe").css('width',kj_width-27);
	}else{
					$("#off_on").attr('val','open');
					$("#right").css('width',kj_width-182);
					$("#right").css('left',182);
					$("#right_iframe").css('width',kj_width-206); 
					$("iframe").css('width',kj_width-208);
	}
}
</script>

<div class="header lr10">
	<?php echo $this->headerment();?>
</div>

<div class="bk10"></div>

<div class="table-list lr10">
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="10%">序号</th>
		<th width="15%" align="left">用户名</th>
		<th width="10%" align="left">所属角色</th>
		<th width="10%" align="left">最后登录IP</th>
		<th width="20%" align="left">最后登录时间</th>
		<th width="15%" align="left">E-mail</th>
		<th width="15%">管理操作</th>
		</tr>
    </thead>
  	<tbody>
    	<?php foreach($AdminList as $v){ ?>
        <tr>
	<?php if($v['mid']==0){ ?>
	<?php }else{ ?>
        <td width="10%" align="center">
		<?php echo $v['uid']; ?>
		</td>
        <td width="15%"><?php echo $v['username']; ?></td>
        <td width="10%">
		<?php if($v['mid']==0)echo "系统服务"; ?>
		<?php if($v['mid']==1)echo "测试用户"; ?>
		<?php if($v['mid']==2)echo "超级管理员"; ?>
		</td>
        <td width="10%">
		<?php if($v['mid']==0){ ?>
		localhost
		<?php }else{ ?>
		<?php echo $v['loginip']; ?>
		<?php } ?>
		</td>
        <td width="20%">
		<?php if($v['mid']==0){ ?>
		NULL
		<?php }else{ ?>
		<?php echo date("Y-m-d H:i:s",$v['logintime']); ?>
		<?php } ?>
		</td>
        <td width="15%"><?php echo $v['useremail']; ?></td>
        <td width="15%" align="center">
		<span class="span_fenge lr5">|</span>
        <?php if($v['mid']==0){ ?>
        <font color="#cccccc">修改</font>
        <?php }else{ ?>
        <a href="<?php echo G_ADMIN_PATH; ?>/user/edit/<?php echo $v['uid']; ?>">修改</a>
		<?php } ?>
        <span class="span_fenge lr5">|</span>
        <?php if($v['mid']==0){ ?>
        <font color="#cccccc">删除</font>
        <?php }else{ ?>
        <a href="javascript:window.parent.Del('<?php echo G_ADMIN_PATH.'/'.ROUTE_C; ?>/del/<?php echo $v['uid']; ?>', '是否删除该管理员?')">删除</a>
        <?php } ?>
        </td>
	<?php } ?>
        </tr>
        <?php } ?>
	</tbody>
</table>
 <div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</form>
</div><!--table-list end-->

<script>
	
</script>
</body>
</html> 