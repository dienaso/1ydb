<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin',G_ADMIN_DIR,'no');

class install extends SystemAction {
	
	public function __construct(){
		$this->db=System::load_sys_class('model');
	}
		
	public function init(){		
		$q = $this->db->Query("
		CREATE TABLE `@#_goodspecify` (
		  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `uid` int(10) unsigned NOT NULL COMMENT '会员ID',
		  `gid` int(10) unsigned NOT NULL COMMENT '商品ID',
		  `num` int(10) unsigned NOT NULL COMMENT '购买次数',
		  `ok` char(20) NOT NULL DEFAULT '进行中',
		  `utitle` varchar(255) DEFAULT NULL,
		  `gtitle` varchar(255) DEFAULT NULL,
		  PRIMARY KEY (`id`),
		  KEY `uid` (`uid`),
		  KEY `gid` (`gid`)
		) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
		");
		if($q){
			 unset(__FILE__);
			_message("安装成功!");
		}
		
	
	}	
}