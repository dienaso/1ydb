<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tbody tr{ line-height:30px; height:30px;} 
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
<form action="#" method="post">
 添加时间: <input name="posttime1" type="text" id="posttime1" class="input-text posttime"  readonly="readonly" /> -  
 		  <input name="posttime2" type="text" id="posttime2" class="input-text posttime"  readonly="readonly" />
<script type="text/javascript">
		date = new Date();
		Calendar.setup({
					inputField     :    "posttime1",
					ifFormat       :    "%Y-%m-%d %H:%M:%S",
					showsTime      :    true,
					timeFormat     :    "24"
		});
		Calendar.setup({
					inputField     :    "posttime2",
					ifFormat       :    "%Y-%m-%d %H:%M:%S",
					showsTime      :    true,
					timeFormat     :    "24"
		});
				
</script>

<select name="sotype">
<option value="uid">uid</option>
</select>
<input type="text" name="sosotext" class="input-text wid100"/>
<input class="button" type="submit" name="sososubmit" value="搜索">
</form>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="80px">id</th>
		<th width="80px">uid</th>
		<th width="*" align="center">分享用户</th>
		<th width="*" align="center">奖励</th>
		<th width="80px" align="center">绑定时间</th>
		</tr>
    </thead>
    <tbody>
		<?php foreach($arr as $v){ ?>
		<tr>
			<td align="center"><?php echo $v['id']; ?></td>
			<td align="center"><?php echo $v['uid']; ?></td>
			<td align="center"><?php
				if ($v['username']) {
					echo $v['username'];
				}
				else if ($v['mobile']) {
					echo $v['mobile'];
				}
				else if ($v['email']) {
					echo $v['email'];
				}
			?></td>
			<td align="center"><?php echo $v['award_name'] .' x '. $v['award_count'];?></td>
			<td align="center"><?php echo date("Y-m-d H:m:s",$v['addtime']);?></td>
		</tr>
		<?php } ?>
  	</tbody>
</table>
</div><!--table-list end-->
<div id="pages" style="margin:10px 10px">		
	<ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul>
</div>
<script>
</script>
</body>
</html> 