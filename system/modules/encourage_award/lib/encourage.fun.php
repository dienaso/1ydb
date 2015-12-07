<?php 
    
	//鼓励奖
	function encourage($shopid){
		$db = System::load_sys_class("model");
		$info_encourage=System::load_sys_config("encourage");
		$info_encouragelimit=$info_encourage['e_qzsp'];
		$eshoponecode=$db->GetOne("select * from `@#_shoplist` where `id`='$shopid'");
		if(isset($info_encouragelimit)&&($eshoponecode['money']>=$info_encouragelimit)){
			$e_id=encourage_num();
			if(isset($e_id) && !empty($e_id)){
				$num=$e_id["e_num"];
				$emessageshow=gljmessageshow($shopid);
				// echo "<pre/>";
				// print_r($emessageshow);exit;
				if(!isset($emessageshow)|| empty($emessageshow)){
					$q_code=$eshoponecode["q_user_code"];//幸运闪购码（一等奖）	
					$q_qishu=$eshoponecode["qishu"];//获取商品期数
					$e_shopname=$eshoponecode["title"];//获取商品名称
					$eshoplist=$db->GetList("select *  from `@#_member_go_record` where `shopid`='$shopid'");//购买此商品的用户及其闪购码
					//分解出此商品用户所有闪购码
					$eshoplistq="";		 
					foreach($eshoplist as $key=>$v){		
					   $eshoplistq.=$v["goucode"];
					   if($key<(count($eshoplist)-1)){
						 $eshoplistq.=",";	
					   }		   
					}		
					
					$eshoplistq=explode(",",$eshoplistq);
					sort($eshoplistq);	//排序此商品用户所有闪购码
					foreach($eshoplistq as $key=>$val){
					   if($val==$q_code){
										
							  if($key==0){
								for($k=1;$k<=$num;$k++){ 
								   $q_scode[$k]=$eshoplistq[($key+$k)];
								}					 
							  }elseif($key==(count($eshoplistq)-1)){
								  for($k=1;$k<=$num;$k++){ 
									 $q_scode[$k]=$eshoplistq[($key-$k)];
								  }					 
							  }else{
								 $aa=$eshoplistq[$key+1];
								 $bb=$eshoplistq[$key-1];
								 
								 if(($aa-$q_code)>($q_code-$bb)){
									 $q_scode[1]=$bb;
									  array_remove($eshoplistq,($key-1));
								 }else{
									 $q_scode[1]=$aa;	
									  array_remove($eshoplistq,($key+1));					 
								 }
								
									$j=2;			
									$rtnarr=duibi($eshoplistq,$q_code,$num,$j);
									if(!empty($rtnarr) && is_array($rtnarr)){
									  foreach($rtnarr as $key=>$val){
										$q_scode[$key]=$val;
									  }
									}
													
								 
							  }
							
					   }
					}	
					
					gljmessageadd($q_scode,$eshoplist,$e_id,$q_qishu,$e_shopname);//将鼓励奖数据存入
					$emessageshow=gljmessageshow($shopid);
					return $emessageshow;	//将鼓励奖数据读出
				}
				else{
				return $emessageshow;	
				}
			}
			else{
			return $e_id;
			}
		}
		else{
		return false;
		}
		
		
	}
	
	//读出鼓励奖
	function gljmessageshow($shopid){
	$db = System::load_sys_class("model");
	$emessageshow=$db->GetList("select * from `@#_encourage_award`  where `shop_id`='$shopid'");	
	return $emessageshow;
	}
	
	
	
		
	function duibi($eshoplistq,$q_code,$num,$j){
	  Global $arra;
	   foreach($eshoplistq as $key=>$val){
		   if($val==$q_code){
                 if(($key+2)>(count($eshoplistq))){
				    $arra[$j]=$eshoplistq[$key-1];					
					array_remove($eshoplistq,($key-1));						
				 }elseif(($key-1)<0){				     
					$arra[$j]=$eshoplistq[$key+1];	
					array_remove($eshoplistq,($key+1));
				 }else{	 				 
					 $aa=$eshoplistq[$key+1];				 
					 $bb=$eshoplistq[$key-1];                 
					 if(($aa-$q_code)>($q_code-$bb)){
						 $arra[$j]=$bb;
						  
						 array_remove($eshoplistq,($key-1));					 
					 }else{
						 $arra[$j]=$aa;	
						   
						 array_remove($eshoplistq,($key+1));						 
					 }
				 }				 
			 }
	   }	   
	 
         if($j<$num){
		   $j++; 		   
		   duibi($eshoplistq,$q_code,$num,$j);
		 }	   
	     
	     return $arra;
	   
	
	}	

	//获取鼓励奖数据的相关信息
	function gljmessageadd($q_scode,$eshoplist,$e_id,$q_qishu,$e_shopname){
	  $glj_result=array();
		foreach($q_scode as $key=>$v){		
		  foreach($eshoplist as $key2=>$val){		  
	        if(strstr($val['goucode'],$v)){		
			$glj_result[$key]=array("uid"=>$val['uid'],"username"=>$val['username'],"shopid"=>$val['shopid'],"goucode"=>$q_scode[$key]);
			}
		  }
		}
		//将鼓励奖数据存入数据库
		$db = System::load_sys_class("model");
		$e_gz=explode("#",$e_id['e_content']);
		foreach($e_gz as $key=>$va){
		  $e_gz[$key]=explode(",",$va);
		}
		$e_time=time();
		foreach($glj_result as $key=>$v){
		$gljmcnum=$key-1;
		$e_content=$e_gz[$gljmcnum];
		$e_content=$e_content[1].$e_content[2].$e_content[3].$e_content[4];
		$gljmc=$key+1;
		$eshoponecode=$db->query("insert into `@#_encourage_award` (`e_type`,`e_content`,`user_id`,`e_username`,`e_time`,`shop_id`,`e_code`,`e_get`,`e_qishu`,`e_shopname`) values ('$gljmc','$e_content','$v[uid]','$v[username]','$e_time','$v[shopid]','$v[goucode]','N','$q_qishu','$e_shopname')");
		}
	}
	
	

	
		
	//删除数组元素	
	function array_remove(&$arr,$offset){  
        array_splice($arr,$offset,1);  
    } 
		
	//查看鼓励奖类型
	function encourage_num(){
		$e_id=System::load_sys_config("encourage");
	    if($e_id['e_start']=='Y'){
			return $e_id;
		}
	}

?>