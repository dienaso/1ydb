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
		<th width="*" align="center">充值(元)</th>
		<th width="*" align="center">奖励(次)</th>
		<th width="100px" align="center">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($arr as $v){ ?>
		<tr>
			<td align="center"><?php echo $v['id']; ?></td>
			<td align="center">
				<input type="text" name="money" value="<?php echo $v['money'];?>">
			</td>
			<td align="center">
				<input type="text" name="count" value="<?php echo $v['count'];?>">
			</td>
			<td align="center">
				<a href="<?php echo WEB_PATH; ?>/zhuanpan/zhuanpan_admin/config_del/<?php echo $v['id'];?>" onClick="return confirm('是否真的删除！');">删除</a>
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
		tmpHtml += '		<input type="text" name="money">';
		tmpHtml += '	</td>';
		tmpHtml += '	<td align="center">';
		tmpHtml += '		<input type="text" name="count">';
		tmpHtml += '	</td>';
		tmpHtml += '	<td align="center">';
		tmpHtml += '		<a class="allsave" href="javascript:void(0)">保存</a>';
		tmpHtml += '	</td>';
		tmpHtml += '</tr>';
		
		$('#mytable tbody').append(tmpHtml);
	}

	$('#mytable tbody input').blur(function (){
		$.post("<?php echo WEB_PATH; ?>/zhuanpan/zhuanpan_admin/config_save",{
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
			$.post("<?php echo WEB_PATH; ?>/zhuanpan/zhuanpan_admin/config_save",{
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
			$.post("<?php echo WEB_PATH; ?>/zhuanpan/zhuanpan_admin/config_allsave",{
					money : $(this).parent().parent().find('input[name=money]').val(),
					count : $(this).parent().parent().find('input[name=count]').val()
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