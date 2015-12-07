var data;
$(function(){ 
	//多期参与介绍
	$(".w_popup_window a").click(function(){
		  $(".alertsbg").show();
   		  $(".alertsBox").show();
   		alerts("如何一次参与多期云购？",$(".pss").html(),"438","596");
		  })
	$("#Contracts").css({left:($(window).width()-$("#Contracts").width())/2+"px"});
	  $(".close").click(function(){
			$("#Contracts").hide();
			$(".c_remind_bj").hide();
		});
	//即将揭晓翻页按钮显示和隐藏
		$(".c_pop_shop").hover(function(){
			$(this).find(".c_pop_btn").show();
		},function(){
			$(this).find(".c_pop_btn").hide();
		})
		//加载购物袋数据
		cartAjax();
		//加载即将揭晓数据
		getGoodsList(page);
		//关闭提示用户协议未读
	$(".cartClose").click(function(){
		$("#Contracts").hide();
		$(".c_remind_bj").hide();
	});
	//温馨提示确定按钮
	$(".c_tel_next").click(function(){
		$(".c_update_tel").hide();
		$(".c_remind_bj").hide();
	});
	//温馨提示关闭按钮
	$(".c_qq_close").click(function(){
		$(".c_update_tel").hide();
		$(".c_remind_bj").hide();
	});
	
	
})
//温馨提示方法
function showHint(i){
	$("#showTieleP").html($("#title_"+i).html()+"已达该商品的购买上限!");
	$(".c_update_tel").show();
	$(".c_remind_bj").show();
}
	var row = 0;
	var failure =  new Array();
	//加载购物车数据
function cartAjax(){
	failure =[];
$.ajax({
	type:'get',
	url:"/cart/select.do?" +'randomTime=' + (new Date()).getTime(),
	dataType:'json',
	success:function(json){
		var str = '';
		if(json.status){
			data = json.cartList;
			row = json.cartList.length;
			if(json.cartList.length > 0){
				$("#cartListLength").html(json.cartList.length);
				for(i=0;i<json.cartList.length;i++){
					$("#null").hide();
					$("#data").show();
					var url = 'javascript:gotoGoods('+json.cartList[i].online.gid+','+json.cartList[i].online.periodCurrent+")";
					var a =json.cartList[i].online.priceTotal-json.cartList[i].online.priceSell;
					str += '<tr id="tr_'+i+'"><td class="checkbox"><input name="checkbox" id="check_'+i+'" value="'+json.cartList[i].gid+"-"+json.cartList[i].type+'" class="check-one check" type="checkbox" checked onclick="setTotal(-1)"/></td>';     
					str += '<td class="goods"><a href="'+url+'"><img src="'+imageGoodsPath+json.cartList[i].online.showImages.split(",")[0]+'" alt=""/></a>';     
					if(json.cartList[i].type!=3){
						str += '<span>';
						if(json.cartList[i].online.priceArea>1){
							str += '<em>'+NoToChinese(json.cartList[i].online.priceArea)+'元专区</em>';
						}else if(json.cartList[i].online.maxBuy>0){
							str += '<em class="w_add_limit">限购专区</em>';
						}
						str += '<a href="'+url+'" id="title_'+i+'">'+json.cartList[i].online.title+'</a></span><b class="c_goods_price">';     
						str += '总需<i>'+json.cartList[i].online.priceTotal+'</i>人次参与，还剩<i>'+a+'</i>人次</b></td>'; 
						str += '<td class="price w_price" id="surplus_'+i+'">'+a+'</td>';     
						str += '<td class="count"><div class="w_one_new">';  
						str += '<span class="reduce" onclick="minusTimes('+i+')" onmousedown="stare1('+i+')" onmouseout="end1('+i+')"  onmouseup="end1('+i+') ">-</span>';
						if(json.cartList[i].times<0){
							json.cartList[i].times=0;
						}
						str +='<input width="60px" class="count-input" type="text" id="times_'+i+'" value="'+json.cartList[i].times;
						str +='"  onafterpaste="update('+i+');" onblur="update('+i+')"/>';
						str +='<span class="add" onclick="addTimes('+i+')" onmouseout="end2('+i+')"  onmousedown="stare2('+i+')" onmouseup="end2('+i+')">+</span>';     
						if(json.cartList[i].online.maxBuy>0){
							str += '<p>限购'+json.cartList[i].online.maxBuy+'人次</p>';
						}
						str += '</div></td><td class="w_one"><div class="w_one_new">';
						if(json.cartList[i].online.preSell==1){
							str += '<span class="w_pre w_pre_one" >-</span>';
							str +='<input  class="count-input1 count-input-other" type="text" id="buyPeriod_'+i+'" value="'+json.cartList[i].buyPeriod;
							str +='"  disabled />';
							str +='<span class="w_next w_next_one" >+</span>';  
						}else{
							str += '<span class="w_pre " onclick="minusPeriod('+i+')" onmousedown="stare3('+i+')" onmouseout="end3('+i+')"  onmouseup="end3('+i+')" onclick="minusPeriod('+i+')">-</span>';
							str +='<input  class="count-input1 " type="text" id="buyPeriod_'+i+'" value="'+json.cartList[i].buyPeriod;
							str +='" onafterpaste="update('+i+');" onkeyup="update('+i+')"/>';
							str +='<span class="w_next" onclick="addPeriod('+i+')" onmousedown="stare4('+i+')" onmouseout="end4('+i+')"  onmouseup="end4('+i+')" >+</span>';  
						}
						var price = json.cartList[i].times*(json.cartList[i].buyPeriod);
						str += '<p id="td_period_'+i+'"></p></div></td><td class="subtotal" id="price_'+i+'">'+price+'</td>'; 
						str +='<input  type="hidden" id="area_'+i+'" value="'+json.cartList[i].online.priceArea+'"/>';     
					}else{
						str += '<span>';
						str += '<em class="w_new_baoyuan">直购</em>';
						str += '<a href="'+url+'">'+json.cartList[i].online.title+'</a></span><b class="c_goods_price w_goods_price">';     
						str += '价值：'+json.cartList[i].online.priceAll+'</b></td>';
						str += '<td class="price w_price">-</td>';
						str += '<td class="count"><span class="reduce reduce_one">-</span>';
						str += '<input class="count-input" type="text" value="'+json.cartList[i].online.priceAll+'" disabled/>';
						str += '<span class="add add_one">+</span>';
						str += '</td><td class="w_one"><span class="w_pre w_pre_one">-</span>';
						str += '<input class="count-input1 count-input-other" type="text" value="1" disabled/>';
						str += '<span class="w_next w_next_one">+</span>';
						str += '</td><td class="subtotal" id="price_'+i+'">'+json.cartList[i].online.priceAll+'</td>';
						str +='<input  type="hidden" id="area_'+i+'" value="1"/>';     
					}
					str +='<input  type="hidden" id="gid_'+i+'" value="'+json.cartList[i].gid+'"/>';     
					str +='<input  type="hidden" id="id_'+i+'" value="'+json.cartList[i].id+'"/></td>';     
					str += '<td class="operation"><span class="delete" onclick="del('+i+')">删除</span></td></tr>';     
				}
				$("#listTable").html(str);
				//复选框与全选同步
				$("[name='checkbox']").click(function(){
					var obj =$("input[name='checkbox']");
					var s=0;
					for(var i=0; i<obj.length; i++){
						if(obj[i].checked) s++; 
					}
					if(s==obj.length){
						$(".check-all").attr("checked",'true');
					}else{
						$(".check-all").removeAttr("checked");
					}
				})
				setTotal(-1);
			}else{
				$("#cartListLength").html(0);
				$("#null").show();
				$("#nullImg").attr("src","../static/img/front/cloud_global/shop_bag.png");
				$("#data").hide();
			}
		}
	}
	})	
}
	var interval;
//按住鼠标后触发
function stare1(i){
	interval =setInterval('minusTimes('+i+')',200)
}
function end1(i){
	clearTimeout(interval);
}
function stare2(i){
	interval =setInterval('addTimes('+i+')',200)
}
function end2(i){
	clearTimeout(interval);
}
function stare3(i){
	interval =setInterval('minusPeriod('+i+')',200)
}
function end3(i){
	clearTimeout(interval);
}
function stare4(i){
	interval =setInterval('addPeriod('+i+')',200)
}
function end4(i){
	clearTimeout(interval);
}
//按住鼠标后触发 end
//给cook加次数
function addTimes(a){
	var times = $("#times_"+a).val();
	var buyPeriod =parseInt($("#buyPeriod_"+a).val());
	if((!isNaN(times))&&((parseInt(times)<parseInt($("#surplus_"+a).html())&&buyPeriod==1))||buyPeriod>1){
		$.ajax({
			type:'get',
			url:"/cart/check.do",
			dataType:'json',
			data: {buyPeriod:$("#buyPeriod_"+a).val(),
				times:parseInt(times)+1*$("#area_"+a).val(),
				gid:$("#gid_"+a).val(),
				time:new Date().getTime()},
			success:function(result){
				if(result.status){
					$("#times_"+a).val(parseInt(times)+1*$("#area_"+a).val());
					setTotal(a);
					var cart = jaaulde.utils.cookies.get("cart");
					cart = eval( cart );
					cart[a].times=(times/1)+1*$("#area_"+a).val();
					jaaulde.utils.cookies.set('cart',JSON.stringify(cart),{path:"/"});
				}else{
					showHint(a);
				}
			}
		});
	}else if(parseInt(times)==parseInt($("#surplus_"+a).html())){
		showHint(a);
	}
}
//给cook减期数
function minusTimes(a){
	var times = $("#times_"+a).val();
	if((!isNaN(times))&&times>1){
		$("#times_"+a).val(parseInt(times)-1*$("#area_"+a).val());
		setTotal(a);
		var cart = jaaulde.utils.cookies.get("cart");
		var list = eval( cart );
		list[a].times=(times/1)-1*$("#area_"+a).val();
		jaaulde.utils.cookies.set('cart',JSON.stringify(list),{path:"/"});
	}
}
//修改cook
function update(a){
	var times = $("#times_"+a).val();
	var buyPeriod = $("#buyPeriod_"+a).val();
	if((!isNaN(times))&&(!isNaN(buyPeriod))&&parseInt(times)>0&&parseInt(buyPeriod)>=0
			&&times.indexOf('.') <0&&buyPeriod.indexOf('.') <0&&times!=''&&buyPeriod!=''){
		if(times.length>11){
			$("#times_"+a).val($("#surplus_"+a).html());
		}
		if($("#buyPeriod_"+a).val().length>11){
			$("#buyPeriod_"+a).val(1);
		}
		times= $("#times_"+a).val();
		var area = $("#area_"+a).val();
		if(area>1){
			if(times%area!=0){
				times= times-(times%area)+area*1
			}
		}
		if(times!=$("#times_"+a).val()){
			$("#times_"+a).val(times)
		}
		$.ajax({
			type:'get',
			url:"/cart/check.do",
			dataType:'json',
			async: false,
			data: {buyPeriod:$("#buyPeriod_"+a).val(),
				times:times,
				gid:$("#gid_"+a).val(),
				time:new Date().getTime()},
			success:function(result){
				if(typeof(result.buyPeriod) != "undefined"){
					if(result.buyPeriod!=$("#buyPeriod_"+a).val()){
						showHint(a);
						//$("#td_period_"+a).html('最多可参与<span>'+parseInt(result.buyPeriod)+'</span>期');
					}
					$("#buyPeriod_"+a).val(result.buyPeriod);
				}
				if(typeof(result.times) != "undefined"){
					if(result.times!=times){
						showHint(a);
					}
					$("#times_"+a).val(result.times);
				}
				setTotal(a);
				var cart = jaaulde.utils.cookies.get("cart");
				var list = eval( cart );
				list[a].buyPeriod=$("#buyPeriod_"+a).val();
				list[a].times=$("#times_"+a).val();
				jaaulde.utils.cookies.set('cart',JSON.stringify(list),{path:"/"});
			}
		});
	}else{
		if(isNaN(times)||parseInt(times)<1||times.indexOf('.') >0||times==''){
			$("#times_"+a).val($("#area_"+a).val());
		}
		if(isNaN(buyPeriod)||parseInt(buyPeriod)<0||buyPeriod.indexOf('.') >0||buyPeriod==''){
			$("#buyPeriod_"+a).val(1);
		}
		setTotal(a);
		var cart = jaaulde.utils.cookies.get("cart");
		var list = eval( cart );
		list[a].buyPeriod=$("#buyPeriod_"+a).val();
		list[a].times=$("#times_"+a).val();
		jaaulde.utils.cookies.set('cart',JSON.stringify(list),{path:"/"});
	}
}
//给cook加期数
function addPeriod(a){
	var period = $("#buyPeriod_"+a).val();
	if(!isNaN(period)){
		$("#buyPeriod_"+a).val(parseInt(period)+1);
		$.ajax({
			type:'get',
			url:"/cart/check.do",
			dataType:'json',
			data: {buyPeriod:$("#buyPeriod_"+a).val(),
				times:$("#times_"+a).val(),
				gid:$("#gid_"+a).val(),
				time:new Date().getTime()},
			success:function(result){
				if(result.status){
					setTotal(a);
					var cart = jaaulde.utils.cookies.get("cart");
					var list = eval( cart );
					list[a].buyPeriod=$("#buyPeriod_"+a).val();
					jaaulde.utils.cookies.set('cart',JSON.stringify(list),{path:"/"});
				}else{
					var period = $("#buyPeriod_"+a).val();
					$("#buyPeriod_"+a).val(parseInt(period)-1);
					showHint(a);
				}
			}
		});
	}
	
}
//给cook减期数
function minusPeriod(a){
	var period = $("#buyPeriod_"+a).val();
	if((!isNaN(period))&&period>1){
		$("#buyPeriod_"+a).val(parseInt(period)-1);
		setTotal(a);
		var cart = jaaulde.utils.cookies.get("cart");
		var list = eval( cart );
		list[a].buyPeriod=(period/1)-1;
		jaaulde.utils.cookies.set('cart',JSON.stringify(list),{path:"/"});
	}
	if($("#buyPeriod_"+a).val()=="1"){
		update(a);
	}
}
	//计算总价
function setTotal(a){
	if(a>=0){
		var times = $("#times_"+a).val()==''?1:$("#times_"+a).val();
		var buyPeriod = $("#buyPeriod_"+a).val()==''?1:$("#buyPeriod_"+a).val();
		if(typeof(buyPeriod) == "undefined")
			buyPeriod=1;
		if(typeof(times) == "undefined")
			times=$("#buyAllTimes_"+a).html()==null?1:$("#buyAllTimes_"+a).html();
		var price=times*(parseInt(buyPeriod));
		$("#price_"+a).html(price);
	}
	var sum = 0;
	for(var i=0;i<row;i++){
		if(failure.toString().indexOf(i+',') <0){
			if($('#check_'+i).attr("checked")){
				if($("#price_"+i).html()!=''||typeof($("#price_"+i)) != "undefined"){
				   sum+=parseInt($("#price_"+i).html());
				}
			}
		}
	}
	$("#priceTotal").html(sum);
}
//全部删除
function deleteAll(){
	var obj =$("input[name='checkbox']");
	var s='';
	var check=0;
	var cart =jaaulde.utils.cookies.get('cart');
	var list = eval( cart );
	for(var i=0; i<obj.length; i++){
		if(obj[i].checked) {
			s+=obj[i].value+','; 
		}
	}
	if(s!=''){
		for(var i=0; i<list.length; i++){
			if(s.indexOf(list[i].gid+'-'+list[i].type+',') >-1){
				list.splice(i,1);
				i--;
			}
		}
		if(list.length==0){
			jaaulde.utils.cookies.set('cart','',{path:"/"});
		}else{
			jaaulde.utils.cookies.set('cart',JSON.stringify(list),{path:"/"});
		}
		cartCount();
		cartAjax();
	}else{
		alerts("提示：","请选择要删除的商品！","350","150")
	}
}
	//删除
function del(a){
	var cart =jaaulde.utils.cookies.get('cart');
	var list = eval( cart );
	if(list.length==1){
		list = '';
		jaaulde.utils.cookies.set('cart','',{path:"/"});
	}else{
		list.splice(a,1);
		jaaulde.utils.cookies.set('cart',JSON.stringify(list),{path:"/"});
	}
	cartCount();
	cartAjax();
}
//结算
function settlement(){
	var obj =$("input[name='checkbox']");
	var s='';
	for(var i=0; i<obj.length; i++){
		if(obj[i].checked) s+=obj[i].value+','; 
	}
	if($("#agreement").attr("checked")){
		for(var i=0;i<row;i++){
			if(failure.toString().indexOf(i+',') <0){
				if($('#check_'+i).attr("checked")){
					if($("#price_"+i).html()!=''||typeof($("#price_"+i)) != "undefined"){
					   if($("#price_"+i).html()==0){
						   showHint(i);
						   return;
					   }
					}
				}
			}
		}
		if($("#priceTotal").html()>0&&$("#priceTotal").html()<=100000 && s!=''){
			//百度要的东西
			try{
				var prod=[];
				var cart =jaaulde.utils.cookies.get('cart');
				var list = eval( cart );
				for(var i=0; i<data.length; i++){
					if(data[i].type!=3){
						var str = {
								"p_id" : data[i].online.gid,
								"p_price" : data[i].online.priceTotal,
								"p_num" : list[i].times
						}
					}else{
						var str = {
							"p_id" : data[i].online.gid,
							"p_price" : data[i].online.priceAll,
							"p_num" : data[i].online.priceAll
						}
					}
					prod.push(str);
				}
				baiduTag_cart(prod);
			}catch (e){
			} 
			//end
			window.location.href = "/cart/cartOrder.do?row="+s;
		}else if($("#priceTotal").html()>100000){
			alerts("提示","商品总金额应<=10万","350","150");
		}
	}else{
		$("#Contracts").show().removeClass("hide").removeClass("fade");
		$(".c_remind_bj").show();
	}
}
//全选
function selectAll(){
	if($("#SelectAll").attr("checked")){
		$("[name='checkbox']").attr("checked",'true');//全选
	}else{
		$("[name='checkbox']").removeAttr("checked");//取消全选
	}
	setTotal(-1);
}
//获得即将揭晓的商品
var page = 1;
function getGoodsList(page){
	$.ajax({
		url:'/goods/getGoods.do',
		type:'post',
		dataType:"json",
		data:{
			size:"8",
			order:"publicTime",
			page:page
		},
		success:function(result){
			if(result.status){
				if(result.goods.dataList.length > 0){
					var goodsList = result.goods.dataList;
					for(i=0;i<goodsList.length;i++){
						var str ='';
						var surplus = goodsList[i].priceTotal-goodsList[i].priceSell;
						str +='<li><span class="span" ><img height="210px" width="204px" id="goods_'+i+'"';
						str +='src="'+imageGoodsPath+goodsList[i].showImages.split(",")[0]+'" /></span>';
						str +='<b title="'+goodsList[i].title+'">'+cutString(goodsList[i].title,40)+'</b>';
						str +='<i>剩余<em >'+surplus+'</em>人次</i>';
						str +='<div class="c_pop_hover">';
						str +='<div class="c_pop_bj"></div>';
						str +='<div class="c_divide_btn">';
						str +='<a href="javascript:;" class="c_add_cart" onclick="cartoon('+i+')">加入购物袋</a>';
						str +='<a href="javascript:gotoGoods('+goodsList[i].gid+','+goodsList[i].periodCurrent+')" class="c_know_detail">查看详情</a>';
						str +='</div>';
						str +='</div>';
						str +='<input type="hidden" id="soon_gid_'+i+'" value="'+goodsList[i].gid+'"/>';
						str +='<input type="hidden" id="soon_pid_'+i+'" value="'+goodsList[i].periodCurrent+'"/>';
						str +='<input type="hidden" id="soon_priceArea_'+i+'" value="'+goodsList[i].priceArea+'"/>';
						str +='<input type="hidden" id="soon_priceSell_'+i+'" value="'+goodsList[i].priceSell+'"/>';
						str +='<input type="hidden" id="soon_period_'+i+'" value="'+goodsList[i].period+'"/>';
						str +='<input type="hidden" id="soon_priceTotal_'+i+'" value="'+goodsList[i].priceTotal+'"/>';
						str +='<input type="hidden" id="soon_surplus_'+i+'" value="'+surplus+'"/>';
						str +='<input type="hidden" id="soon_thumbPath_'+i+'" value="'+goodsList[i].thumbPath+'"/>';
						str +='<input type="hidden" id="soon_title_'+i+'" value="'+goodsList[i].title+'"/>';
						str +='</li>';
					$("#goodsList").append(str);
					}
					$(".c_pop_list li").hover(function(){
						$(".c_pop_list li").find(".c_pop_hover").hide();
						$(this).find(".c_pop_hover").show();
					},function(){
						$(".c_pop_list li").find(".c_pop_hover").hide();
					})
				}
			}
		}
	});
}
//加入购物车动画
function cartoon(a){
		addCart(a);
		var img = $("#goods_"+a);
		var flyElm = img.clone().css('opacity', 0.75);
		$('body').append(flyElm);
		flyElm.css({
			'z-index': 9000,
			'display': 'block',
			'position': 'absolute',
			'top': img.offset().top +'px',
			'left': img.offset().left +'px',
			'width': img.width() +'px',
			'height': img.height() +'px'
		});
		flyElm.animate({
			top: $('.shoppingCartRightFix').offset().top,
			left: $('.shoppingCartRightFix').offset().left,
			width: 40,
			height: 37
		}, 'slow', function() {
			flyElm.remove();
		});
} 
//加入购物车
function addCart(a){
	var gid = $("#soon_gid_"+a+"").val();
	var pid = $("#soon_pid_"+a+"").val();
	var times = 1;
	var cart = jaaulde.utils.cookies.get("cart")
	if (cart == null || cart=='' || cart == "undefined") {
		cart = '[{"buyPeriod":1,"client":1,"gid":' + gid
				+ ',"times":'+$("#soon_priceArea_"+a).val()+',"type":2}]';
	} else {
		var check = 0;
		var list = eval(cart);
		if(list.length>=30){
			return;
		}else{
			for (var i = 0; i < list.length; i++) {
				if (list[i].gid == gid && list[i].type==2) {
					list[i].times = list[i].times / 1 + 1*$("#soon_priceArea_"+a).val();
					check = 1;
					break;
				}
			}
			if (check == 0) {
				if(typeof(cart)=="object"){
					cart = JSON.stringify(cart);
				}
				cart = cart.substring(0, cart.length -1);
				cart = cart + ',{"buyPeriod":1,"client":1,"gid":'
				+ gid+ ',"times":'+$("#soon_priceArea_"+a).val()+',"type":2}]';
			} else {
				cart = JSON.stringify(list)+"";
			}
		}
	}
	jaaulde.utils.cookies.set('cart', cart,{path:"/"});
	cartAjax();
	//设置购物袋数量
	cartCount();
}
//数字转中文
function NoToChinese(num) {
var AA = new Array("零", "一", "二", "三", "四", "五", "六", "七", "八", "九");
var BB = new Array("", "十", "百", "千", "万", "亿", "点", "");
var a = ("" + num).replace(/(^0*)/g, "").split("."), k = 0, re = "";
for (var i = a[0].length - 1; i >= 0; i--) {
switch (k) {
case 0: re = BB[7] + re; break;
case 4: if (!new RegExp("0{4}\\d{" + (a[0].length - i - 1) + "}$").test(a[0]))
re = BB[4] + re; break;
case 8: re = BB[5] + re; BB[7] = BB[5]; k = 0; break;
}
if (k % 4 == 2 && a[0].charAt(i + 2) != 0 && a[0].charAt(i + 1) == 0) re = AA[0] + re;
if (a[0].charAt(i) != 0) re = AA[a[0].charAt(i)] + BB[k % 4] + re; k++;
}

if (a.length > 1) //加上小数部分(如果有小数部分)
{
re += BB[6];
for (var i = 0; i < a[1].length; i++) re += AA[a[1].charAt(i)];
}
if(re.substr(0, 1)=="一"&&re.length==2){
	re=re.substr(1,1)
}
return re;
} 
/*
 * Author：gaoxiaopeng@ddtkj.com
 * Time:2015-9-10
 * 描述：百度的统计代码，用于抓去用户购物车操作行为
 * 用法：在购物袋页面初始化调用，
 * 参数1：prod(商品集合)
 * */
function baiduTag_cart(prod){
    var _hmt = _hmt || [];
    var rtTag ={
        "data": {
         "ecom_cart": {
            "prod": prod
         }
        }
    };
    _hmt.push(['_trackRTEvent', rtTag]);
}