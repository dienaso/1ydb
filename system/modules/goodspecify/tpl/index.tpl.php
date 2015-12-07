<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>
<script>
var g_chche = new Array();
var s_goods = '';
var s_user = '';
var s_cishu = 0;
var s_num = 0;

$(function(){		   
	$("#category").change(function(){ 
			$("#brand").attr("disabled",true);
			$("#goods").attr("disabled",true);
			var parentId=$("#category").val();		
			if(g_chche[parentId]){
				$("#brand").html(g_chche[parentId]);	
				$("#brand").attr("disabled",false);		
				return 0;
			}
			if(null!= parentId && ""!=parentId){ 
					$.getJSON("<?php echo WEB_PATH; ?>/api/brand/json_brand/"+parentId,{cid:parentId},function(myJSON){
						var optionstr="";	
						if(myJSON.length>0){ 			
							optionstr+='<option value="0">≡≡≡&nbsp;请选择品牌&nbsp;≡≡≡</option>';				
							for(var i=0;i<myJSON.length;i++){ 
								optionstr+="<option value="+myJSON[i].id+">"+myJSON[i].name+"</option>"; 
							} 
							$("#brand").html(optionstr);
							g_chche[parentId] = optionstr;
							$("#brand").attr("disabled",false);						
						} 
				   }); 
			}  
	});

$("#brand").change(function(){		
		$("#goods").attr("disabled",true);					
		var cateId = $("#category").val();
		var brandId= $("#brand").val();	
		if(g_chche[cateId+brandId]){			
				$("#goods").html(g_chche[cateId+brandId]);
				$("#goods").attr("disabled",false);	
				return 0;
		}
		$.getJSON("<?php echo WEB_PATH; ?>/goodspecify/goodspecify/json_goods/"+cateId+'/'+brandId,{xxxx:"xccxc"},function(myJSON){
			var optionstr='<option sy="0" value="0">≡≡≡≡≡≡&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请选择商品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;≡≡≡≡≡≡≡</option>';	
			if(myJSON.length>0){ 
				for(var i=0;i<myJSON.length;i++){
					optionstr+='<option sy='+myJSON[i].shenyurenshu+' value='+myJSON[i].id+'>(第'+myJSON[i].qishu+'期)'+myJSON[i].title+'</option>';	
				} 
				$("#goods").html(optionstr);
				$("#goods").attr("disabled",false);
				g_chche[cateId+brandId] = optionstr;
			}else{
				window.parent.message("没有找到可用商品！");	
			}
		});
	
});	
	
	
$("#goods").change(function(){
		var text = $("#goods").find("option:selected").text();
		var id 	 = $(this).val();
		s_num  = $("#goods").find("option:selected").attr('sy');		
		if(id != 0){
			s_goods = text;			
			$("#good_shenyu").html("该商品还可以购买<font color='red'>"+s_num+' 次</font>');
		}else{
			s_goods = '';
			s_num = 0;
		}
});

}); //jieshu
</script>

<script>
function get_user_info(T){
	if(!T.value){
		window.parent.message("请输入准备测试的UID 或 邮箱 或 手机号码!");	return false;
	}else{
		$.post("<?php echo WEB_PATH; ?>/api/member/get_user_json",{value:T.value},function(data){
			data = $.parseJSON(data);
			if(data.error == -1){
				$(T).css("border","1px solid #ff0000");
				$(T).val("没有这个会员");
				s_user = '';
			}else{
				if(data.email != ''){
						var text = data.text.email;
				}
				if(data.mobile != null){
						var text = data.text.mobile;
				}					
				$(T).css("border","1px solid #00cc00");
				$(T).val(text);
				s_user = text;
			}
			
		});	
	}
}


function select_goods_id(T){


}

function system_add_user(T){
	if(this.onc=='yes'){
		$(T).css("background-color","#ccc").css("color","#111");	
		this.onc='no';
		$(T).val("使用系统创建随机账户");
		$("#user_id").val(this.text);
		s_user = '';
		$("#system_add_user").show();
	}else{
		$(T).css("background-color","#0c0").css("color","#fff");	
		this.onc='yes';
		this.text = $("#user_id").val();	
		$("#user_id").val("system_rand");
		$("#system_add_user").hide();
		$(T).val("使用系统创建随机账户 (再次点击取消)");
		s_user = "使用系统创建随机账户";
	}
	


}

function get_user_gonum(T){
	var num = parseInt($(T).val());
	if(num <= 0 || num >= s_num){
		window.parent.message("闪购人次不能小于0次 或 不能大于商品的剩余人次");
		$(T).val(1);
	}
}

function checkform(T){
	if(s_goods == '' || s_user == ''){
		window.parent.message("未选择商品或者准备会员!");
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div class="header lr10">
	<b><a href="<?php echo G_MODULE_PATH ?>/goodspecify/pecifylist">查看往期准备测试~</a></b>
</div>
<div class="bk10"></div>
<div class="header-data lr10">
	<b>提示 ：</b>	 <font color="#ff0000">准备测试人功能启用必须数据库购买记录条数大于100条！</font>
	<br />
	<b>提示 ：</b>  <font color="#ff0000">准备测试人需要一个已存在的会员,必须保证该会员账户里有足够的金额能购买商品!</font>
	<br />
	<b>提示 ：</b>  <font color="#ff0000">如果准备测试人的账户金额不够,请去会员管理修改该会员账户金额!</b></font>
	<br />
	<b>提示 ：</b>	<font color="red"> 多准备几次同一个会员买同一个商品效果更好！</font>
</div>
<div class="bk20 lr10"></div>

<div class="table_form lr10">
<form action="" method="post" id="myform" onSubmit="return checkform(this)">
<table width="100%" class="lr10">
    <!--定制功能start-->
		<tr>
			<td align="right" width="120" style="font-weight:bold">请选择商品：</td>
			<td>
				<span id="select_goods_id">
				<select id="category">
					<option value="0">≡≡≡&nbsp;请选择栏目&nbsp;≡≡≡</option>
					<?php foreach($clist as $cate){ ?>
					<option value="<?php echo $cate['cateid']; ?>"> <?php echo $cate['name']; ?></option>
					<?php } ?>
				</select>
				<select id="brand" disabled="true">
					<option value="0">≡≡≡&nbsp;请选择品牌&nbsp;≡≡≡</option>
				</select>
				<select name="user_goods" id="goods" disabled="true">
					<option value="0">≡≡≡≡≡≡&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请选择商品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;≡≡≡≡≡≡≡</option>			
				</select>
				<span class="lr10">&nbsp;</span>
				</span>		
				
                <b id="good_shenyu"></b>
			</td>
		</tr>
      	<tr>        	
            <td align="right" width="120" style="font-weight:bold;">准备测试人：</td>            
            <td>		
            		 <span id="system_add_user">
            		 <input type="text" name="user_id" id="user_id" onBlur="get_user_info(this);" class="input-text wid150">&nbsp;
                      输入该测试人的<font color="#0C0">手机号</font>或<font color="#0C0">邮箱</font>或<font color="#0C0">UID</font>   
                     <span class="lr10">&nbsp;</span><span class="lr10">&nbsp;</span><span class="lr10">&nbsp;</span><span class="lr10">&nbsp;</span>
					 <span class="lr10">&nbsp;</span><span class="lr10">&nbsp;</span><span class="lr10">&nbsp;</span><span class="lr10">&nbsp;</span>
					 <span class="lr5">&nbsp;</span>
                     </span>                     
                     <!--<input type="button" class="button" onClick="system_add_user(this);" value=" 使用系统创建随机账户 "> -->      
            </td>
        </tr>	
        <tr>        	
            <td align="right" width="120" style="font-weight:bold">准备购买次数：</td>          
            <td>
            		<input type="text" name="user_go_num" onBlur="get_user_gonum(this);" class="input-text wid50">&nbsp;
                    <b>次</b>       
       		</td>
        </tr>		
		<tr id="goods_message" style="display:none">
			<td align="right" width="120">您的选择是:</td>
			<td id="goods_text" style="padding-left:20px; font-weight:bold;"></td>
		</tr>
        <!--定制功能end-->
        <tr>
        	 <td align="right" width="120" style="font-weight:bold"></td> 
             <td><input type="submit" value=" 提交 " name="dosubmit" class="button"></td>
        </tr>
</table>
   	<div class="bk15"></div>
</form>
</div><!--table-list end-->
</body>
</html> 