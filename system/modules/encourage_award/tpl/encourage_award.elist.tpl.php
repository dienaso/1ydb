<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tr{height:40px;line-height:40px}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">

<!--start-->
	<?php
	if(isset($eshow)&&!empty($eshow)){
	?>
	<div style="text-align: center;height: 30px;color: red;font-size: 16px;font-weight: bold;">
	*暂无*
	</div>
    <table width="100%" cellspacing="0" >
		<tr>
		<td width="120" align="right"></td>
		<td>鼓励奖等级</td>
		<td>商品名称</td>
		<td>商品期数</td>
		<td>获取时间</td>
		<td>获奖闪购码</td>
		<td>奖品</td>
		<td>是否领取</td>
		<td>修改状态</td>
		</tr>
         <?php 
		foreach($eshow as $key=>$v){
		?>
		<tr>
		<td width="120" align="right"></td>
		<td><?php echo $eshow[$key]["e_type"]; ?></td>
		<td><?php echo $eshow[$key]["e_shopname"]; ?></td>
		<td><?php echo $eshow[$key]["e_qishu"]; ?></td>
		<td><?php echo $eshow[$key]["e_time"]; ?></td>
		<td><?php echo $eshow[$key]["e_code"]; ?></td>
		<td><?php echo $eshow[$key]["e_content"]; ?></td>
		<td>未领取</a>
				</td>
		<td><a href="<?php echo WEB_PATH;?>/encourage_award/encourageqtget/init/<?php echo $eshow[$key]['e_id'];?>"  style="display: block;width: 50px;height: 23px;background: #FFF;line-height: 22px;text-align: center;border-radius: 2px;color: #f40;">	
        修改状态</a>
      </td>
		</tr>	
	  <?php } ?>	
	</table>
    <?php 
	} 
	else {?>
	<div style="text-align: center;height: 30px;color: red;font-size: 16px;font-weight: bold;">
	*暂    无*
	</div>
    <?php } ?>
</div>


<script type="text/javascript">
 var i = 2;
function add_option() {  
	if(i<10){
		var htmloptions = '';
		htmloptions += '<div id='+i+'><span><br>'+(i+1)+'等奖奖励方式:&nbsp;<input type="radio" name="option'+i+'[]" value="夺宝币:" class="input-text">夺宝币&nbsp;&nbsp;<input type="text"  name="ff_content[]" size="40" msg="必填" value="" class="input-text wid100"/>&nbsp;&nbsp;<input type="radio" name="option'+i+'[]" value="云币:" class="input-text">云币&nbsp;&nbsp;<input type="text"  name="jb_content[]" size="40" msg="必填" value="" class="input-text wid100"/>&nbsp;&nbsp;&nbsp;<input type="radio" name="option'+i+'[]" value="其他:" class="input-text">其他&nbsp;&nbsp;<input type="text"  name="qt_content[]" size="40" msg="必填" value="" class="input-text wid100"/><input  type="hidden" name="hideoption[]" value="'+(i+1)+'"/><input type="button" value="删除"  onclick="del('+i+')" class="button"/><br></span></div>';
		$(htmloptions).appendTo('#new_option'); 
		var htmloptions = '';	
	}	i = i+1;
}
function del(o){
 $("div [id=\'"+o+"\']").remove();	
}

$(function(){
	$('#encourage_award1').click(function(){
		$("#encourage_award").show();  
		  }); 
	$('#encourage_award3').click(function(){
		$("#encourage_award").hide();  
		  }); 
})

</script>
</body>
</html> 