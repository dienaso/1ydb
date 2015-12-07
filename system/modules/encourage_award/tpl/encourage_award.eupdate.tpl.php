<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>奖励配置</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">

<script language=JavaScript>
// function InputCheck(myform)
// {
  // if (myform.encourage_awardgz.value == "")
  // {
    // alert("请选择鼓励奖计算规则!");
    // myform.encourage_awardgz.focus();
    // return (false);
  // }
  // if (myform.shop_je.value == "")
  // {
    // alert("请输入商品价格限制!");
    // myform.shop_je.focus();
    // return (false);
  // }
   // if (myform.option1.value == "")
  // {
    // alert("请输入商品价格限制!");
    // myform.option1.focus();
    // return (false);
  // }
// }
</script>

<form name="myform" action=""  method="post" enctype="multipart/form-data" onSubmit="return InputCheck(this)">
	<table width="100%" cellspacing="0" >
	<tr >
		<td width="120" align="right">设置鼓励奖：</td>
		<td>
		<input type="button" name="encourage_awardadd" id="encourage_award1" value="重新设置" class="button">
		<input type="button" name="encourage_awardadd" id="encourage_award3" value="取消"  class="button">
		<font color="red">*鼓励奖从二等奖开始*</font>
		</td>
	</tr>
	</table>
	<table width="100%" cellspacing="0" id="encourage_award" style="display:none;">
	<tr >
		<td width="120" align="right">鼓励奖计算规则：</td>
		<td>
		<input type="radio" name="encourage_awardgz" id="encourage_award1" value="1" class="input-text">闪购码与一等奖（幸运码）的距离由近到远依次设置鼓励奖
		<input type="radio" name="encourage_awardgz" id="encourage_award3" value="2" class="input-text">设置中...
		</td>
	</tr>	
	<tr>
	<td width="120" align="right">商品价格限制：</td>
	<td>&nbsp;<input  class="input-text wid100"  type="text" name="shop_je"  size="20" id="shop_je"/>元（及其以上）</td>	
	</tr>
  	<tr>
		<td width="120" align="right"></td>
		<td>
			&nbsp;<input type="button" id="addItem" value="增加鼓励奖" class="button" onclick="add_option()">
			<font color="red">*鼓励奖的每个奖项对应一个中奖人，最多可以设置9个鼓励奖*</font>			
			<div id="option_list_1">
			<div><br> 
				2等奖奖励方式:
				<input type="radio" name="option1[]" value="夺宝币:" class="input-text">夺宝币&nbsp;&nbsp;
				<input class="input-text wid100 "  type="text" name="ff_content[]"  value="" size="40" require="true" id="opt1"/>
				<input type="radio" name="option1[]" value="云币:" class="input-text">云币&nbsp;&nbsp;
				<input class="input-text wid100 "  type="text" name="jb_content[]"  value="" size="40" require="true" id="opt2"/>
				<input type="radio" name="option1[]" value="其他:" class="input-text">其他&nbsp;&nbsp;
				<input class="input-text wid100 "  type="text" name="qt_content[]"   value="" size="40" require="true" id="opt3"/>
				<input  type="hidden" name="hideoption[]" value="2"/>
				<font color="red">*设置奖励内容*</font>
				
				</div>
			</div>		
			<div id="new_option"></div>
		</td>
	</tr>
		<tr>
		<td width="120" align="right"></td>
		<td><input type="submit" class="button" name="submit" id="submit" value=" 提交 " ></td>
		</tr>
</table>
</form>
<div id="encourage_awardshow">
<?php if(!isset($info_encourage['e_num'])||empty($info_encourage['e_num'])){?>
	<div style="text-align: center;height: 30px;color: red;font-size: 16px;font-weight: bold;">
	*暂无*
	</div>
<?php }else{?>
	<div style="text-align: center;height: 30px;color: red;font-size: 16px;font-weight: bold;">
	*现有鼓励奖设置情况*
	</div>
	    <table width="100%" cellspacing="0" >
		<tr>
		<td width="110" align="right"></td>
		<td>商品价格限制</td>
		<td>鼓励奖等级</td>
		<td>奖励方式</td>
		<td>奖励内容</td>
		<td>设置时间</td>
		</tr>
		<?php 
		for($i=0;$i<$info_encourage['e_num'];$i++){
			$infoe_content1=explode(',',$infoe_content[$i]);
		?>		
			<tr>
			<td width="110" align="right"></td>
			<td><?php echo $info_encourage['e_qzsp'];?>元及其以上</td>
			<td><?php echo $infoe_content1[0];?></td>
			<td><?php echo $infoe_content1[1];?></td>
			<td><?php $num=$infoe_content1[0];echo $infoe_content1[$num];?></td>
			<td><?php echo date("Y-m-d H:i:s",$info_encourage['e_time']);?></td>
			</tr>
  <?php }?>
	</table>
	
	
<?php }?>

</div>

</body>
</html> 


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
		$("#encourage_awardshow").hide();  
		  }); 
	$('#encourage_award3').click(function(){
		$("#encourage_awardshow").show();  
		$("#encourage_award").hide();  
		  }); 
})

</script>