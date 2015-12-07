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
<div class="header-title lr10">
	<b>卡密充值管理</b>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
  <table width="100%" cellspacing="0">
    <thead>
		<tr>
            <th width="100px" align="center">ID</th>            

			<th width="100px" align="center">卡密号码</th>
			<th width="100px" align="center">充值卡密</th>    
            <th width="100px" align="center">卡密类型</th>
			<th width="100px" align="center">卡密金额(元)</th>
            <th width="100px" align="center">是否充值</th>
            <th width="100px" align="center">过期日期</th>
            <th width="100px" align="center">已充值次数</th>			
			<th width="80px" align="center">手机</th>	
			<th width="120px" align="center">充值时间</th>
			
		
            <th width="100px" align="center">管理</th>       
		</tr>
    </thead>
    <tbody>
    	<?php 
		for($i=0;$i<count($res);$i++){ 
		if(!empty($res[$i]['uid'])){
			$uid=$res[$i]['uid'];
			$member=$this->db->GetOne("select email,mobile from `@#_member` where `uid`='$uid'");
		}else{
			$member=array();
		}
		
		?>
		<tr>
			<td align="center"><?php echo $res[$i]['id']; ?></td>		 

			<td align="center"><?php echo $res[$i]['code']; ?></td>
			<td align="center"><?php echo $res[$i]['codepwd']; ?></td>
			<td align="center"><?php if($res[$i]['isrepeat']=='Y')echo '一次性充值';else echo '可重复充值'; ?></td>	
			<td align="center"><?php echo $res[$i]['money']; ?></td>
			<td align="center"><?php echo $res[$i]['uid']!=''?'<span style="color:red">已充值</span>':'未充值'; ?></td>	
			<td align="center"><?php echo date('Y-m-d',$res[$i]['rechargetime']); ?></td>	
			<td align="center"><?php echo $res[$i]['rechargecount']; ?></td>	
			
			<td align="center"><?php if(!empty($member)){echo $member['mobile'];} ?></td>	
			<td align="center"><?php echo $res[$i]['time']!=''?date("Y-m-d H:i:s",$res[$i]['time']):''; ?></td>			
			
			
            <td align="center">
                <a href="<?php echo WEB_PATH; ?>/cardrecharge/cardrecharge/del/<?php echo $res[$i]['id'];?>" onclick="return confirm('是否真的删除！');">删除</a>				
		   </td>            	
		</tr>
       <?php } ?>
	
  	</tbody>
	
</table>
</div><!--table-list end-->
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('two','li'); ?></ul></div>
<script>
</script>
</body>
</html> 