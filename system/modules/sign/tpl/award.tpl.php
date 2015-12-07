<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<style>
tbody tr{ line-height:30px; height:30px;} 
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0" id="mytable">
    <thead>
		<tr>
		<th width="80px">id</th>
		<th width="*" align="center">奖励类别</th>
		<th width="*" align="center">奖励个数</th>
		<th width="*" align="center">奖励几率</th>
		<th width="100px" align="center">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($arr as $v){ ?>
		<tr>
			<td align="center"><?php echo $v['id']; ?></td>
			<td align="center">
				<select name="text">
					<option value="0">请选择</option>
					<option value="score" <?php if($v['field'] == 'score')echo 'selected';?>>夺宝币</option>
					<option value="money" <?php if($v['field'] == 'money')echo 'selected';?>>现金</option>
				</select>
			</td>
			<td align="center">
				<input type="text" name="count" value="<?php echo $v['count'];?>">
			</td>
			<td align="center">
				<input type="text" name="jilv" value="<?php echo $v['jilv'];?>">
			</td>
			<td align="center">
				<a href="<?php echo WEB_PATH; ?>/sign/sign_admin/del/<?php echo $v['id'];?>" onClick="return confirm('是否真的删除！');">删除</a>
			</td>	
		</tr>
		<?php } ?>
  	</tbody>
</table>
<div class="btn_paixu">
	<input type="button" class="button" value=" 添加 " onclick="dd();">
</div>
</div><!--table-list end-->

<script>
	function dd(){
		var tmpHtml = '';
		tmpHtml += '<tr>';
		tmpHtml += '	<td align="center"></td>';
		tmpHtml += '	<td align="center">';
		tmpHtml += '		<select name="text">';
		tmpHtml += '			<option value="0">请选择</option>';
		tmpHtml += '			<option value="score">夺宝币</option>';
		tmpHtml += '			<option value="money">现金</option>';
		tmpHtml += '		</select>';
		tmpHtml += '	</td>';
		tmpHtml += '	<td align="center">';
		tmpHtml += '		<input type="text" name="count">';
		tmpHtml += '	</td>';
		tmpHtml += '	<td align="center">';
		tmpHtml += '		<input type="text" name="jilv">';
		tmpHtml += '	</td>';
		tmpHtml += '	<td align="center">';
		tmpHtml += '		<a class="allsave" href="javascript:void(0)">保存</a>';
		tmpHtml += '	</td>';
		tmpHtml += '</tr>';
		
		$('#mytable tbody').append(tmpHtml);
	}

	$('#mytable tbody input').blur(function (){
		$.post("<?php echo WEB_PATH; ?>/sign/sign_admin/save",{
				id : $(this).parent().parent().find('td').first().html(),
				field : $(this).attr('name'),
				val : $(this).val()
			},
			function (result) {
		    	// alert(result)
			}
		);
	})

	$('#mytable tbody select').change(function (){
		var thisVal = $(this).val();
		if (thisVal != 0) {
			var thisText = $('option:selected', this).text();
			$.post("<?php echo WEB_PATH; ?>/sign/sign_admin/save",{
					id : $(this).parent().parent().find('td').first().html(),
					field : $(this).attr('name'),
					text : thisText,
					val : thisVal

				},
				function (result) {
			    	// alert(result)
				}
			);
		};
	})

	$('a.allsave').live({
		click : function (){
			$.post("<?php echo WEB_PATH; ?>/sign/sign_admin/allsave",{
					text : $(this).parent().parent().find('select option:selected').text(),
					count : $(this).parent().parent().find('input[name=count]').val(),
					jilv : $(this).parent().parent().find('input[name=jilv]').val(),
					field : $(this).parent().parent().find('select option:selected').val(),
				},
				function (result) {
			    	if (result == 1) {
			    		location.reload();
			    	} else {
			    		alert('添加失败！');
			    	}
				}
			);
		}
	})
</script>
</body>
</html> 