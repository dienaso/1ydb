<?php 

defined('G_IN_SYSTEM')or exit('No permission resources.');
ini_set("display_errors","OFF");

class ekepay_url extends SystemAction {
	private $out_trade_no;
	public function __construct(){			
		$this->db=System::load_sys_class('model');		
	} 	
	
	public function houtai(){
	
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'ekepay' and `pay_start` = '1'");
		$pay_type_key = unserialize($pay_type['pay_key']);
		$key =  $pay_type_key['key']['val'];		//支付KEY
		$id =  $pay_type_key['id']['val'];		//支付商号ID
		
		//返回参数.
		$orderid        = trim($_GET['orderid']);
		$opstate        = trim($_GET['opstate']);
		$ovalue         = trim($_GET['ovalue']);
		$sysorderid		= trim($_GET['sysorderid']);
		$systime		= trim($_GET['systime']);
		$sign		= trim($_GET['sign']);
		$out_trade_no = $orderid;
		$this->out_trade_no = $out_trade_no;	
		if(!$out_trade_no){
			echo "返回参数错误";
			die("opstate=-1");
		}
		
		
		
		$sign_text  = "orderid=" . $orderid . "&opstate=" . $opstate . "&ovalue=" . $ovalue .$key;
		$sign_md5 = md5($sign_text);
		if($sign_md5 != $sign){
			echo "交易信息被篡改";
			die("opstate=-2");
		}	
		else{
			if ($opstate==0){
				$ret = $this->ekepay_chuli();
				if($ret == '已付款' || $ret == '充值完成' || $ret == '商品购买成功'){
					die("opstate=0");
				}
				if($ret == '充值失败' || $ret == '商品购买失败'){
					echo $ret;exit;
				}
			}
			
		}

		
		

	}
	
	private function ekepay_chuli(){
	
		$pay_type =$this->db->GetOne("SELECT * from `@#_pay` where `pay_class` = 'ekepay' and `pay_start` = '1'");
		$out_trade_no = $this->out_trade_no;

		$this->db->Autocommit_start();
		$dingdaninfo = $this->db->GetOne("select * from `@#_member_addmoney_record` where `code` = '$out_trade_no' for update");
		if(!$dingdaninfo){ return false;}	//没有该订单,失败
		if($dingdaninfo['status'] == '已付款'){
			return '已付款';
		}
		$c_money = intval($dingdaninfo['money']);
		$uid = $dingdaninfo['uid'];
		$time = time();		
		
		$up_q1 = $this->db->Query("UPDATE `@#_member_addmoney_record` SET `pay_type` = '点卡支付', `status` = '已付款' where `id` = '$dingdaninfo[id]' and `code` = '$dingdaninfo[code]'");
		$up_q2 = $this->db->Query("UPDATE `@#_member` SET `money` = `money` + $c_money where (`uid` = '$uid')");			
		$up_q3 = $this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('$uid', '1', '账户', '充值', '$c_money', '$time')");
		
		if($up_q1 && $up_q2 && $up_q3){			
			$this->db->Autocommit_commit();
		}else{
			$this->db->Autocommit_rollback();
			return '充值失败';
		}			
		if(empty($dingdaninfo['scookies'])){					
			return "充值完成";	//充值完成	
		}
		
		$scookies = unserialize($dingdaninfo['scookies']);			
		$pay = System::load_app_class('pay','pay');		
		$pay->scookie = $scookies;
		$ok = $pay->init($uid,$pay_type['pay_id'],'go_record');	//闪购商品	
		if($ok != 'ok'){
			$_COOKIE['Cartlist'] = '';_setcookie('Cartlist',NULL);			
			return '商品购买失败';	//商品购买失败			
		}		

		$check = $pay->go_pay(1);
		if($check){
			$this->db->Query("UPDATE `@#_member_addmoney_record` SET `scookies` = '1' where `code` = '$out_trade_no' and `status` = '已付款'");
			$_COOKIE['Cartlist'] = '';_setcookie('Cartlist',NULL);
			return "商品购买成功";
		}else{
			return '商品购买失败';
		}			

	}
	
}//

?>