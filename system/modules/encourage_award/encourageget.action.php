<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
class encourageget extends base {
	public function __construct(){	
		parent::__construct();
		$this->db = System::load_sys_class("model");
		$member=$this->userinfo;
		if(empty($member['uid'])){
			_message('请先登录',WEB_PATH.'/member/user/login');
		}
	}
	
	
	//鼓励奖奖品领取
	public function init(){	 
		
		$this->db = System::load_sys_class("model");
		$member=$this->userinfo;
		$e_id=intval($this->segment(4));
		$encourage_award=$this->db->GetOne("select * from `@#_encourage_award` where `e_id`='$e_id'");
		$e_content=$encourage_award["e_content"];
		$user_id=$encourage_award['user_id'];
		$e_z=explode(":",$e_content);
		if($e_z[0]=="夺宝币"){
         $this->db->Query("UPDATE `@#_member` SET `score`=`score`+'$e_z[1]' where uid='$user_id'");
		 $this->db->Query("UPDATE  `@#_encourage_award`  SET  `e_get`='Y'  where `e_id`='$e_id'");
		// _message("领取成功！");
		 echo "<script>alert('领取成功!');window.location.href='".WEB_PATH."/member/home';</script>";
		 }
		if($e_z[0]=="云币"){
	     $this->db->Query("UPDATE  `@#_member`  SET  `money`=`money`+'$e_z[1]'  where uid='$user_id'");
		 $this->db->Query("UPDATE  `@#_member_account` SET  `money`=`money`+'$e_z[1]'  where uid='$user_id'");
		 $this->db->Query("UPDATE  `@#_encourage_award`  SET  `e_get`='Y'  where `e_id`='$e_id'");
		 // _message("领取成功！");
		 echo "<script>alert('领取成功!');window.location.href='".WEB_PATH."/member/home';</script>";
		}
		if($e_z[0]=="其他"){		
		 // _message("其他奖励请联系客服！");
		 echo "<script>alert('其他奖励请联系客服！');window.location.href='".WEB_PATH."/member/home';</script>";
		}
	}
	
}

?>