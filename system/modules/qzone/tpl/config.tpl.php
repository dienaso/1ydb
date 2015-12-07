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
		<th width="*" align="center">奖项</th>
		<th width="*" align="center">数量</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($arr as $v){ ?>
		<tr>
			<td align="center"><?php echo $v['id']; ?></td>
			<td align="center">
				<select name="award_name">
					<option value="0">请选择</option>
					<option value="score" <?php if($v['field'] == 'score')echo 'selected';?>>夺宝币</option>
					<option value="money" <?php if($v['field'] == 'money')echo 'selected';?>>现金</option>
				</select>
			</td>
			<td align="center">
				<input type="text" name="award_count" value="<?php echo $v['award_count'];?>">
			</td>
		</tr>
		<?php } ?>
  	</tbody>
</table>
</div><!--table-list end-->

<script>
	$('#mytable tbody input').blur(function (){
		$.post("<?php echo WEB_PATH; ?>/qzone/qzone_admin/save",{
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
			$.post("<?php echo WEB_PATH; ?>/qzone/qzone_admin/save",{
					id : $(this).parent().parent().find('td').first().html(),
					field : $(this).attr('name'),
					text : thisText,
					val : thisVal

				},
				function (result) {
			    	//alert(result)
				}
			);
		};
	})
</script>
</body>
</html> 