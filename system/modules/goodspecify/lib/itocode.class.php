<?php 


class itocode {
	public function __construct() {
		$this->db = System::load_sys_class("model");
	}	
	public function  go_itocode($shop=array(),$go_code,$go_content,$count_time){		
		if(empty($shop)) return;
		if(empty($go_code)) return;
		$gid = $shop['id'];		
		$zd_shop = $this->db->GetOne("select * from `@#_goodspecify` where `gid` = '$gid'");
		if(!$zd_shop){		
			return;
		}else{
			//$this->zd_shop_info = $this->db->GetOne("select GROUP_CONCAT(goucode) as goucode from `@#_member_go_record` where `shopid` = '$gid' and `uid` =  '$zd_shop[uid]'");
			$zd_shop_info = $this->db->GetList("select goucode from `@#_member_go_record` where `shopid` = '$gid' and `uid` =  '$zd_shop[uid]'");
			$html = '';
			foreach($zd_shop_info as $cv){
				$html .= $cv['goucode'].',';
			}
			$this->zd_shop_info = array();
			$this->zd_shop_info['goucode'] = $html;
			if(strpos($html,$go_code) === true){				
				return;
			}
			unset($zd_shop_info);
		}
		if($go_content){
			$this->suan_get_code_dabai($gid,$zd_shop,$go_code,$count_time);
		}		
	}
	
	private function suan_get_code_dabai($gid,$zd_shop,$go_code,$count_time){
		$uid = $zd_shop['uid'];
		$zd_shop_info_code = explode(',',$this->zd_shop_info['goucode']);
		array_pop($zd_shop_info_code);
		asort($zd_shop_info_code);	//正序
		$zd_jin_code = '';
		if($go_code > end($zd_shop_info_code)){
				$zd_jin_code = end($zd_shop_info_code);
		}else{			
			$t=90000000;		
			foreach($zd_shop_info_code as $k=>$v){				
					$s = abs($go_code-$v);				
					if($s <= $t){			
						$t = $s; $zd_jin_code = $v;				
					}else{
						break;
					}
			}		
		}
		$zd_user_dingdan = $this->db->GetOne("select time from `@#_member_go_record` where `shopid` = '$gid' and `uid` = '$uid' order by `gonumber` ASC");
		
		if(!$zd_user_dingdan){
			return;
		}			
	
		$times = str_ireplace('.','',$zd_user_dingdan['time']);
		$times_h = substr($times,0,4);	
		$times_d = substr($times,4);		
		
		if($zd_jin_code > $go_code){	
			$c_time = $zd_jin_code - $go_code;			
			$times_d += $c_time;
		}else{
			$c_time = $go_code - $zd_jin_code;
			$times_d -= $c_time;
		}		
		$times_str = $times_h.$times_d;		
		$times_str = substr($times_str,0,10).'.'.substr($times_str,10);
		$this->db->Query("UPDATE `@#_member_go_record` SET `time` = '$times_str' where `shopid` = '$gid' and `uid` = '$uid' order by `gonumber` ASC");
		$this->db->Query("UPDATE `@#_goodspecify` SET `ok` = '未测试' where `gid` = '$gid' and `uid` != '$uid'");
		$this->db->Query("UPDATE `@#_goodspecify` SET `ok` = '测试成功' where `gid` = '$gid' and `uid` = '$uid'");
	}
}

?>