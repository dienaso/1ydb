<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
</head>
<body>
<div class="bk10"></div>
<div class="header-data  lr10">
	<span style="color:#09c">往期准备测试记录查看</span>
</div>
<div class="bk10"></div>

<div class="table-list lr10">
<form name="myform" action="" method="post">
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
		<th width="50%" align="left">&nbsp;&nbsp;准备的商品</th>
		<th width="25%" align="left">&nbsp;&nbsp;准备的用户</th>
		<th width="15%" align="left">&nbsp;&nbsp;准备的次数</th>
		<th width="15%" align="left">&nbsp;&nbsp;测试状态</th>
		</tr>
    </thead>
  	<tbody>
    	<?php foreach($plist as $p){ ?>
        <tr>
		<td align="left" width="50%">&nbsp;&nbsp;<a href="#" title="点击查看此商品准备测试信息"><?php echo $p['gtitle']; ?></a></td>	
		<td align="left" width="20%"><a href="#" title="点击查看此会员准备测试信息"><?php echo $p['utitle']; ?></a></td>	
		<td align="left" width="15%"><?php echo $p['num']; ?></td>	
		<td align="left" width="15%"><?php echo $p['ok']; ?></td>
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