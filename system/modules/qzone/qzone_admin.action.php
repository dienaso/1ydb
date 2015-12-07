<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class qzone_admin extends admin {
	private $db;
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");
		$this->ment=array(
			array("lists","QZone分享",ROUTE_M.'/'.ROUTE_C."/lists"),
			array("addcate","奖励设置",ROUTE_M.'/'.ROUTE_C."/config"),
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
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_qzone` a LEFT JOIN `@#_member` b ON a.uid=b.uid WHERE $list_where");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");
		$arr=$this->db->GetPage("SELECT a.*,b.username,b.email,b.mobile FROM `@#_qzone` a LEFT JOIN `@#_member` b ON a.uid=b.uid WHERE $list_where ORDER BY id DESC", array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		include $this->tpl(ROUTE_M,'qzonemanage');
	}

	public function config(){
		$arr=$this->db->Getlist("SELECT * FROM `@#_qzone_config` ORDER BY id DESC");
		include $this->tpl(ROUTE_M,'config');
	}

	public function save(){
		$id = htmlspecialchars($_POST['id']);
		$field = htmlspecialchars($_POST['field']);
		$val = htmlspecialchars($_POST['val']);
		$sql = "UPDATE `@#_qzone_config` SET `$field`='$val' WHERE `id`='$id'";
		if ($field == 'award_name') {
			$text = htmlspecialchars($_POST['text']);
			$sql = "UPDATE `@#_qzone_config` SET `$field`='$text',`field`='$val' WHERE `id`='$id'";
		}

		$this->db->Query($sql);
		if($this->db->affected_rows()){
			// _message("修改成功");
		}else{
			// _message("修改失败");
		}
	}
}
?>