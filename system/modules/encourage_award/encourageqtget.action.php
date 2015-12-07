<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
class encourageqtget extends base {
	public function __construct(){	
		parent::__construct();
		$this->db = System::load_sys_class("model");
		$member=$this->userinfo;
		if(empty($member['uid'])){
			_message('请先登录',WEB_PATH.'/member/user/login');
		}
	}
	
	
	//鼓励奖其他商品的奖品领取
	public function init(){	 
		
		$this->db = System::load_sys_class("model");
		$e_id=intval($this->segment(4));
		 $this->db->Query("UPDATE  `@#_encourage_award`  SET  `e_get`='Y'  where `e_id`='$e_id'");
		//_message("修改成功");
		 echo "<script>alert('修改成功！');window.location.href='".WEB_PATH."/encourage_award/encourage_award/init';</script>";
	}
	
}

?>