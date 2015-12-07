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
<form name="myform" action=""  method="post">
	<table width="100%" cellspacing="0" >
	<tr >
		<td width="120" align="right">是否开启鼓励奖：</td>
		<td>
		<input type="radio" name="encourage_awardset" id="encourage_award1" value="Y" class="input-text"
		<?php 
		if(isset($encourage_awardset)&&!empty($encourage_awardset)&&$encourage_awardset=='Y'){
		echo "checked='checked'";
		}
		?>
		>是
		<input type="radio" name="encourage_awardset" id="encourage_award3" value="N" 
		<?php 
		if(isset($encourage_awardset)&&!empty($encourage_awardset)&&$encourage_awardset=='N'){
		echo "checked='checked'";
		}
		?>
		class="input-text">否
		<font color="red">*鼓励奖从二等奖开始*</font>
		</td>
	</tr>
	</table>

</table>

	<table width="100%" cellspacing="0" >
		<tr>
		<td width="120" align="right"></td>
		<td><input type="submit" class="button" name="e_setsubmit" id="submit" value=" 提交 " ></td>
		</tr>
	</table>
</form>
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