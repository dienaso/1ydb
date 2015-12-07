<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css">
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<style>
body{ background-color:#fff}
tr{ text-align:center}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
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
<option value="title">商品标题</option>
<option value="id">商品id</option>
<option value="cateid">栏目id</option>
<option value="catename">栏目名称</option>
<option value="brandid">品牌id</option>
<option value="brandname">品牌名称</option>
</select>
<input type="text" name="sosotext" class="input-text wid100"/>
<input class="button" type="submit" name="sososubmit" value="搜索">
</form>
</div>
<div class="bk10"></div>
<form action="#" method="post" name="myform">
<div class="table-list lr10">

    <table width="100%" cellspacing="0">
     	<thead>
        		<tr>
                	<th width="5%">排序</th>
                    <th width="5%">ID</th>
                    <th width="25%">商品标题</th>
                    <th width="8%">所属栏目</th>
                    <th width="10%">已兑换/总库存</th>
                    <th width="5%">单价/元</th>
                    <th width="10%"></th>
                    <th width="10%">人气商品</th>
                    <th width="15%">管理</th>
				</tr>
        </thead>
        <tbody>
        	<?php foreach($shoplist as $v) { ?>
            <tr>
              <td align='center'><input name='listorders[<?php echo $v['id']; ?>]' type='text' size='3' value='<?php echo $v['order']; ?>' class='input-text-c'></td>
                <td><?php echo $v['id'];?></td>
                <td><span style=""><?php echo _strcut($v['title'],30);?></span></td>
                <td><a href="<?php echo G_ADMIN_PATH; ?>/content/jf_goods_list/<?php echo $v['cateid']; ?>"><?php echo $this->categorys[$v['cateid']]['name']; ?></a></td>
                <td><font color="#ff0000"><?php echo $v['canyurenshu'];?></font> / <?php echo $v['zongrenshu'];?></td>
                <td><?php echo $v['yunjiage'];?></td>
                <td></td>
                <td><?php
					if($v['renqi']==1){
						echo '<font color="#ff0000">人气</font>';
					}else{
						echo "<a href='".G_MODULE_PATH."/content/jf_goods_set/renqi/".$v['id']."'>设为人气</a>";
					}
					?>
				</td>
                <td class="action">
				[<a href="<?php echo G_ADMIN_PATH; ?>/content/jf_goods_set_money/<?php echo $v['id'];?>">重置价格</a>]
                [<a href="<?php echo G_ADMIN_PATH; ?>/content/jf_goods_edit/<?php echo $v['id'];?>">修改</a>]
                [<a onclick="del_jf(<?php echo $v['id'];?>)" href="javascript:;">删除</a>]
				</td>
            </tr>
            <?php } ?>
        </tbody>
     </table>
    </form>

   <div class="btn_paixu">
  	<div style="width:80px; text-align:center;">
          <input type="button" class="button" value=" 排序 "
        onclick="myform.action='<?php echo G_MODULE_PATH; ?>/content/goods_listorder/dosubmit';myform.submit();"/>
    </div>
  </div>
    	<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</div>
<script>
function del_jf(i){
    if(confirm("确定删除") && parseInt(i) > 0){
        $.post("<?php echo G_ADMIN_PATH; ?>/content/jf_goods_delone/"+i,{id:i},function(r){
            if(r){
                history.go(0);
            }else{
                alert("删除失败");
            }
        });
    }else{
        alert("error");
    }
}
</script>
</body>
</html>