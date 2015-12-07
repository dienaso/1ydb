<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class zhuanpan_admin extends admin {
	private $db;
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");
		$this->ment=array(
			array("lists","转盘管理",ROUTE_M.'/'.ROUTE_C."/lists"),
			array("addcate","奖励设置",ROUTE_M.'/'.ROUTE_C."/award"),
			array("addcate","次数设置",ROUTE_M.'/'.ROUTE_C."/config"),
		);
		
	}
	public function lists(){
		$uid=intval($this->segment(4));
		$list_where = '';
		if(!$uid){
			$list_where = "1";
		}else{
			$uid = "`uid` = '$uid'";
		}

		if(isset($_POST['sososubmit'])){
			$posttime1 = !empty($_POST['posttime1']) ? strtotime($_POST['posttime1']) : NULL;
			$posttime2 = !empty($_POST['posttime2']) ? strtotime($_POST['posttime2']) : NULL;
			$sotype = $_POST['sotype'];
			$sosotext = $_POST['sosotext'];
			if($posttime1 && $posttime2){
				if($posttime2 < $posttime1)_message("结束时间不能小于开始时间");
				$list_where = "`addtime` > '$posttime1' AND `addtime` < '$posttime2'";
			}
			if($posttime1 && empty($posttime2)){				
				$list_where = "`addtime` > '$posttime1'";
			}
			if($posttime2 && empty($posttime1)){				
				$list_where = "`addtime` < '$posttime2'";
			}
			if(empty($posttime1) && empty($posttime2)){				
				$list_where = false;
			}

			if(!empty($sosotext)){			
				if($sotype == 'uid'){
					$sosotext = intval($sosotext);
					if($list_where)
						$list_where .= " AND a.uid = '$sosotext'";
					else
						$list_where = "a.uid = '$sosotext'";
				}
			}else{
				if(!$list_where) $list_where='1';					
			}	
		}

		$num=20;
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_zhuanpan` a LEFT JOIN `@#_member` b ON a.uid=b.uid WHERE $list_where");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");
		$arr=$this->db->GetPage("SELECT a.*,b.username,b.email,b.mobile FROM `@#_zhuanpan` a LEFT JOIN `@#_member` b ON a.uid=b.uid WHERE $list_where ORDER BY id DESC", array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		include $this->tpl(ROUTE_M,'zhuanpanmanage');
	}
	
	public function award(){
		$arr=$this->db->Getlist("select * from `@#_zhuanpan_award` where 1");
		include $this->tpl(ROUTE_M,'award');
	}

	public function config(){
		$arr=$this->db->Getlist("select * from `@#_zhuanpan_config` where 1");
		include $this->tpl(ROUTE_M,'config');
	}

	public function save(){
		$id = htmlspecialchars($_POST['id']);
		$field = htmlspecialchars($_POST['field']);
		$val = htmlspecialchars($_POST['val']);
		$sql = "UPDATE `@#_zhuanpan_award` SET `$field`='$val' WHERE `id`='$id'";
		if ($field == 'award_name') {
			$text = htmlspecialchars($_POST['text']);
			$sql = "UPDATE `@#_zhuanpan_award` SET `$field`='$text',`field`='$val' WHERE `id`='$id'";
		}

		$this->db->Query($sql);
		if($this->db->affected_rows()){
			// _message("修改成功");
		}else{
			// _message("修改失败");
		}
	}

	public function config_save(){
		$id = htmlspecialchars($_POST['id']);
		$field = htmlspecialchars($_POST['field']);
		$val = htmlspecialchars($_POST['val']);
		$sql = "UPDATE `@#_zhuanpan_config` SET `$field`='$val' WHERE `id`='$id'";
		if ($field == 'award_name') {
			$text = htmlspecialchars($_POST['text']);
			$sql = "UPDATE `@#_zhuanpan_config` SET `$field`='$text',`field`='$val' WHERE `id`='$id'";
		}

		$this->db->Query($sql);
		if($this->db->affected_rows()){
			// _message("修改成功");
		}else{
			// _message("修改失败");
		}
	}

	public function config_allsave(){
		$money = htmlspecialchars($_POST['money']);
		$count = htmlspecialchars($_POST['count']);

		$this->db->Query("INSERT INTO `@#_zhuanpan_config`(money,count)VALUES('$money','$count')");
		if($this->db->affected_rows()){
			// _message("插入成功");
			echo 1;
		}else{
			// _message("插入失败");
			echo 0;
		}
	}

	public function del(){
		$delid=intval($this->segment(4));
		if($delid){
			$this->db->Query("DELETE FROM `@#_zhuanpan_award` WHERE `id`='$delid'");
			if($this->db->affected_rows()){
				_message("删除成功");
			}else{
				_message("删除失败");
			}
		}
	}
	
	public function config_del(){
		$delid=intval($this->segment(4));
		if($delid){
			$this->db->Query("DELETE FROM `@#_zhuanpan_config` WHERE `id`='$delid'");
			if($this->db->affected_rows()){
				_message("删除成功");
			}else{
				_message("删除失败");
			}
		}
	}

	public function allsave(){
		$text = htmlspecialchars($_POST['text']);
		$count = htmlspecialchars($_POST['count']);
		$jilv = htmlspecialchars($_POST['jilv']);
		$field = htmlspecialchars($_POST['field']);

		$this->db->Query("INSERT INTO `@#_zhuanpan_award`(text,count,jilv,field)VALUES('$text','$count','$jilv','$field')");
		if($this->db->affected_rows()){
			// _message("插入成功");
			echo 1;
		}else{
			// _message("插入失败");
			echo 0;
		}
	}
}
?>