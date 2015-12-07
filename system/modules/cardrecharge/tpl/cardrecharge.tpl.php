<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<style>
tr{height:40px;line-height:40px}
</style>
</head>
<body>
<div class="header-title lr10">
	<b>卡密充值</b>
</div>
<div class="bk10"></div>
<div class="table_form lr10">	
<form action="<?php echo WEB_PATH?>/cardrecharge/cardrecharge/cardrg" method="post" id="myform">
<table width="100%" class="lr10">
 
   <tr>
    <td>操作类型</td>
    <td>
		<input type="radio"  id="random" name="operationtype" checked onclick="showdiv('randomtr','fixedtr');" value="random" />&nbsp;&nbsp;随机生成&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio"  id="fixed" name="operationtype" onclick="showdiv('fixedtr','randomtr');" value="fixed"/>&nbsp;&nbsp;固定生成
	</td>
  </tr>  
  
  <tr id="randomtr">
    <td>随机充值</td>
    <td>总金额：<input type="text" class="input-text wid60" name="allmoney" value="" onKeyUp="value=value.replace(/\D/g,'')"/>(元)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;此次（限制）<br/>
		充值额：<input type="text" class="input-text wid60" name="mixmoney" value="" onKeyUp="value=value.replace(/\D/g,'')"/>~
		<input type="text" class="input-text wid60" name="maxmoney" value="" onKeyUp="value=value.replace(/\D/g,'')"/>(元) 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>
		卡数量：<input type="text" class="input-text wid150" name="zhang1" value="" onKeyUp="value=value.replace(/\D/g,'')"/>(张)
				
	</td>
  </tr>   

  <tr id="fixedtr" style="display:none" >
    <td>固定充值</td>
    <td>
		充值额：<input type="text" class="input-text wid150" name="money" value="" onKeyUp="value=value.replace(/\D/g,'')"/>(元) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br/>
		卡数量：<input type="text" class="input-text wid150" name="zhang2" value="" onKeyUp="value=value.replace(/\D/g,'')"/>(张)
	</td>
  </tr>  
  <tr>
    <td>是否重复性</td>
    <td>
		<input type="radio"   name="isrepeat" checked  onclick="showdiv('maxrepeattag','maxrepeatcount');"   value="Y" />&nbsp;&nbsp;一次性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio"   name="isrepeat"  onclick="showdiv('maxrepeatcount','maxrepeattag');"   value="N" />&nbsp;&nbsp;可重复
		<span   id="maxrepeatcount" style="color:#f60;display:none;" >&nbsp;&nbsp;&nbsp;&nbsp;
		可重复最高次数：<input type="text" class="input-text wid80"   name="maxrepeatcount" value=""/>
		</span>
		<span   id="maxrepeattag" style="color:#f60;">&nbsp;&nbsp;&nbsp;&nbsp;
		只能使用一次！
		</span>
		
	</td>
  </tr>  
	<tr>
		<td >限制日期</td>
		<td>	 
		  <input name="rechargetime" type="text" id="rechargetime" class="input-text posttime"  readonly="readonly" />
			<script type="text/javascript">
			date = new Date();
			Calendar.setup({
				inputField     :    "rechargetime",
				ifFormat       :    "%Y-%m-%d",
				showsTime      :    true,
				timeFormat     :    "24"
			});
			</script>              
		</td>        
	</tr>

	<tr>
    	<td width="100"></td> 
   		<td> <input type="submit" value=" 确认导出 " name="dosubmit" class="button"></td>
    </tr>
</table>
</form>

</div><!--table-form end-->

<script>
   
    function showdiv(s1,s2){
	 
	   $("#"+s1+"").show();
	   $("#"+s2+"").hide();
	 }  	
</script>
</body>
</html> 