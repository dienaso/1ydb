				var gid_time_Arry=new Array();
				function gg_show_Time_fun(times,objc,uhtml,data){				
					time = times - (new Date().getTime());
					i =  parseInt((time/1000)/60);
					s =  parseInt((time/1000)%60);
					ms =  String(Math.floor(time%1000));
					ms = parseInt(ms.substr(0,2));
					if(i<10)i='0'+i;
					if(s<10)s='0'+s;
					if(ms<0)ms='00';
					objc.find(".specialFamily").html(i+'：'+s+'：'+ms);				
					// objc.find(".specialFamily").html(i+'：'+s);				
					if(time<=0){						
						var obj = objc.parent();				
						obj.find(".yTimes").html('<p>正在计算，请稍后...</p>');	
						 setTimeout(function(){
							obj.html(uhtml);
							obj.attr('class',"wenzi");
							$.ajaxSetup({
								async : false
							});				
							$.post(data['path']+"/api/getshop/lottery_shop_set/",{'lottery_sub':'true','gid':data['id']},null);
						},5000);

						return;						
					}
					
					if(gid_time_Arry!=null){
				 		for(var g=0;g<gid_time_Arry.length;g++){
			                var gTA=gid_time_Arry[g].split("_");
			                if(gTA[0]==data['id']){
			                	 window.clearTimeout(gTA[1]);
			                }
				 		}
				 	}

				 	var g_time = setTimeout(function(){										 	
				 		gg_show_Time_fun(times,objc,uhtml,data);				 
				 	},30); 
				 	
				 	gid_time_Arry.push(data['id']+"_"+g_time);
				}
				function gg_show_time_add_li(div,path,info){
					var html = '';					
					html+='<li class="yTimesLi" style="margin-left:0px;margin-right:20px"><span id="yTimesLi">';					
					html+='<dl class="yTimesDl">';					
					html+='<dd class="yddImg"><a href="'+path+'/dataserver/'+info.id+'.html'+'" target="_blank"><img src="'+info.upload+'/'+info.thumb+'"></a></dd>';
					html+='<dd class="yddName"><a href="'+path+'/dataserver/'+info.id+'.html'+'" title="'+info.title+'" target="_blank">(第'+info.qishu+'期)'+info.title+'</a></dd>';
					html+='<dd class="yGray">价值  <span>￥'+info.zongrenshu+'</span></dd>';
					html+='<dd class="yTimes"><p>揭晓倒计时<span class="specialFamily">120:00:00</span></p><em></em></dd>';
					html+='</dl></span>';
					html+='</li>';
					
					var uhtml = '';				
					uhtml+='<dl>';					
					uhtml+='<dd class="yddImg"><a href="'+path+'/dataserver/'+info.id+'.html'+'" target="_blank" title="'+info.title+'"><img src="'+info.upload+'/'+info.thumb+'"></a></dd>';
					uhtml+='<dd class="yddName">恭喜 <a href="'+path+'/uname/'+(1000000000 + parseInt(info.uid))+'.html'+'" class="yddNameas">'+info.user+'</a> 获得</dd>';
					uhtml+='<dd class="yGray"><a href="'+path+'/dataserver/'+info.id+'.html'+'" title="'+info.title+'" target="_blank" >(第'+info.qishu+'期)'+info.title+'</a></dd>';
					uhtml+='<dd class="yGray">本期幸运号码：'+info.q_user_code+'</dd>';
					uhtml+='</dl><i></i>';
					var divl = $("#"+div).find('li');
					var len = divl.length;	
					if(len==4 && len  >0){
						var this_len = len - 1;
						divl.eq(this_len).remove();
					}		
					$("#"+div).prepend(html);	
					if(len==4 && len  >0){
						$("#"+div).find('li').eq(3).css({"margin-right":"0px"});
					}
					var div_li_obj = $("#yTimesLi");
					var data = new Array();
						data['id'] = info.id;
						data['path'] = path;							
					info.times = (new Date().getTime())+(parseInt(info.times))*1000;					
					gg_show_Time_fun(info.times,div_li_obj,uhtml,data,info.id);				
				}
				
				function gg_show_time_init(div,path,gid){	
					window.setTimeout("gg_show_time_init()",90*1000);	
					if(!window.GG_SHOP_TIME){	
						window.GG_SHOP_TIME = {
							gid : 'yungou',
							path : path,
							div : div,
							arr : new Array()
						};
					}
					$.get(GG_SHOP_TIME.path+"/api/getshop/lottery_shop_json/"+new Date().getTime(),{'gid':GG_SHOP_TIME.gid},function(indexData){					
						var info = jQuery.parseJSON(indexData);	
						if(info !=null){
							for(var a=0;a<info.length;a++){
								if(info[a].error == '0' && info[a].id != 'null'){							
									if(!GG_SHOP_TIME.arr[info[a].id]){
										GG_SHOP_TIME.gid =  GG_SHOP_TIME.gid +'_'+info[a].id;		
										GG_SHOP_TIME.arr[info[a].id] = true;											
										gg_show_time_add_li(GG_SHOP_TIME.div,GG_SHOP_TIME.path,info[a]);							
									}			
								}	
					 		}
						}
					});							
				}