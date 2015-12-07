<?php
  
if(isset($_POST['submit'])){
//是否开启
	$encourage_awardadd=$_POST['encourage_awardadd'];
    if($encourage_awardadd=='N'){
	$db = System::load_sys_class("model");	
	$db->query("delete from `@#_encourage_type");
	}
    if($encourage_awardadd=='Y'){
	$db = System::load_sys_class("model");	
	$db->query("delete from `@#_encourage_type"); 
  //奖品内容  
    $hideoption=$_POST['hideoption'];
	$ff_content=$_POST['ff_content'];
	$jb_content=$_POST['jb_content'];
	$qt_content=$_POST['qt_content']; 
	$eadd_time=time();
 //保存鼓励奖表 
     $e_content="";
	for($i=0;$i<count($hideoption);$i++){
	    $m=$i+1;
	    $optnum='option'.$m;
		$option[$i]=$_POST["$optnum"];		
		if(empty($option[$i][0])) _message("请选择奖励方式");		
		$str[$i]=($m+1).','.$option[$i][0].','.$ff_content[$i].','.$jb_content[$i].','.$qt_content[$i].'#';
        $e_content=$e_content.$str[$i];		
	} 
	$e_num=count($hideoption);
	
	$e_add=$db->query("INSERT INTO `@#_encourage_type`(e_num,e_content,e_qzsp,e_qiyong,e_time) VALUES('$e_num','$e_content','1','Y','$eadd_time')"); 	 
		if($e_add){
				_message("添加成功");
		}else{
				_message("添加失败");
		} 
	}			
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加游戏</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>

<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
</head>
<style type="text/css">
.header-title {
line-height: 40px;
margin-top: 10px;
background-color: #eef3f7;
border: 1px solid #d5dfe8;
text-indent: 30px;
font-size: 12px;
color: #666;
}
.lr10 {
margin: 0 10px;
}
.wid101{width:200px;}
</style>
<body>
<div class="bk10"></div>
<div class="header-title lr10">
<b>鼓励奖设置</b>
</div>
<div class="table-list lr10">

<!--start-->

<form name="myform" action=""  method="post">
	<table width="100%" cellspacing="0" >
	<tr >
		<td width="120" align="right">是否开启鼓励奖：</td>
		<td>
		<?php
       //判断是否开启
		$db = System::load_sys_class("model");	
		$e_qiyong=$db->GetOne("select * from `@#_encourage_type` where e_qiyong='Y'  LIMIT 1");		
		?>
		<input type="radio" name="encourage_awardadd" id="encourage_award1" value="Y" class="input-text"
		<?php 
		if(!isset($e_qiyong)||!empty($e_qiyong)){
		echo "checked='checked'";
		}
		?>
		>是
		<input type="radio" name="encourage_awardadd" id="encourage_award3" value="N" 
		<?php 
		if(isset($e_qiyong)&&empty($e_qiyong)){
		echo "checked='checked'";
		}
		?>
		class="input-text">否
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
		<td width="120" align="right"></td>
		<td>
			<input type="button" id="addItem" value="增加鼓励奖" class="button" onclick="add_option()">
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

</table>

	<table width="100%" cellspacing="0" >
		<tr>
		<td width="120" align="right"></td>
		<td><input type="submit" class="button" name="submit" id="submit" value=" 提交 " ></td>
		</tr>
	</table>
</form>
	<?php
	$eshow=$db->GetList("select * from `@#_encourage_award` where `e_get`='N' ");
	if(isset($eshow)&&!empty($eshow)){
	?>
	<div style="text-align: center;height: 30px;color: red;font-size: 16px;font-weight: bold;">
	*以下是还没有领取的鼓励奖(若鼓励奖奖品是其他类的需要手动处理)*
	</div>
    <table width="100%" cellspacing="0" >
		<tr>
		<td width="120" align="right"></td>
		<td>得奖等级</td>
		<td>得奖人昵称</td>
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
		<td><?php echo $eshow[$key]["e_username"]; ?></td>
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
	*现在没有还没领取的鼓励奖*
	</div>
    <?php } ?>
</div>
</div><!--table-list end-->
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
		  }); 
	$('#encourage_award3').click(function(){
		$("#encourage_award").hide();  
		  }); 
})

</script>