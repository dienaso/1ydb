<?php 

set_time_limit(0);
class up_file_140604 extends SystemAction{


	/*字段添加*/
	function init(){
		/*AFTER 字段添加顺序*/
	
		$db = System::load_sys_class("model");	
		/*商品表*/
		$q5 = $db->Query("ALTER TABLE `@#_shoplist` MODIFY COLUMN `yunjiage` decimal(10,2) unsigned DEFAULT '1.00'");		
		/*晒单表*/	
		$q6 = $db->Query("ALTER TABLE `@#_shaidan` ADD `sd_qishu` int(10) unsigned DEFAULT NULL AFTER `sd_shopid`");
		$q6 = $db->Query("ALTER TABLE `@#_shaidan` ADD `sd_shopsid` int(10) unsigned DEFAULT NULL AFTER `sd_shopid`");
	
		/*管理员表*/
		$info = $db->GetList("SELECT * FROM `@#_admin` WHERE 1");
		foreach($info as $v){
			$pass = md5($v['userpass']);
			$db->Query("UPDATE `@#_admin` SET `userpass` = '$pass' WHERE `uid` = '$v[uid]'");
		}
		
		_message("栏目字段升级成功,跳转到数据修复! 不要关闭本页面",WEB_PATH."/api/".ROUTE_C."/sqlup");
	}
	
	
	/*晒单数据修复升级*/	
	function sqlup(){
		$db = System::load_sys_class("model");
		$sds = $db->GetList("SELECT * FROM `@#_shaidan` WHERE 1");
		foreach($sds as $k=>$v){
			$ginfo = $db->GetOne("SELECT sid,qishu FROM `@#_shoplist` WHERE `id` = '$v[sd_shopid]'");
			if($ginfo){
				$db->Query("UPDATE `@#_shaidan` SET `sd_shopsid` = '$ginfo[sid]',`sd_qishu`='$ginfo[qishu]' WHERE `sd_id` = '$v[sd_id]'");
			}
		}
	
		_message("晒单数据修复升级成功,跳转到数据修复! 不要关闭本页面",WEB_PATH."/api/".ROUTE_C."/upok");
	
	}
	


	/*完成*/
	function upok(){		
		rename(__FILE__,__FILE__.".".time());
		_message("数据库全部修复成功,请进入后台清空缓存!",WEB_PATH);
	}
	
	



}