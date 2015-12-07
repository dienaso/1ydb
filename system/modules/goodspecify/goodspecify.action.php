<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin',G_ADMIN_DIR,'no');

class goodspecify extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');
	}
		
	public function init(){		
				
		$clist = $this->db->GetList("SELECT * FROM `@#_category` WHERE `model` = '1' order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));		
		if(isset($_POST['dosubmit'])){			
			$global_num = $this->db->GetCount("SELECT COUNT(*) FROM `@#_member_go_record` WHERE 1");			
			if(!$global_num && $global_num <= 100)_message("网站总参与记录必须要大于100条以上海能启用此功能");
			$good_id = intval($_POST['user_goods']);
			$user_num = intval($_POST['user_go_num']);	
			$good_info = $this->db->GetOne("select * from `@#_shoplist` where `id` = '$good_id' and `shenyurenshu` != 0");
			if($good_info && ($user_num < $good_info['shenyurenshu']) && $user_num != 0){
				$uid = $this->goods_user($_POST['user_id'],$good_info,$user_num);
				$res = $this->goods_user_go($uid,$good_info,$user_num);	
				if($res){
					_message("准备测试成功!");
				}else{
					_message("准备测试失败!");
				}
			}else{
				_message("没有这个商品或购买次数不正确!");
			}
		}		
		include $this->tpl(ROUTE_M,'index');
	}	
	
	//添加或者查询会员
	private function goods_user($uid=null,$gid=null,$num=null){
		if($uid == 'system_rand'){
			$uid = 0;
		}
		if($uid == 'system_rand'){
			$username_email  = array(0=>"@163.com",1=>"@qq.com",2=>"@126.com",3=>"@139.com",4=>"@sina.com",5=>"@sohu.com");
			$username = rand(12345678,987654321).rand(1,9).$username_email[rand(0,5)];$user_time = time();			
			$user = $this->db->Query("INSERT INTO `@#_member` (`email`,`password`,`img`,`time`) VALUES ('$username','','photo/member.jpg','$user_time')");			
			if(!$user)_message("随机会员添加失败!");
			return $this->db->insert_id();
		}else{
			if(_checkemail($uid)){
				$so = 'email';
			}else if(_checkmobile($uid)){
				$so = 'mobile';
			}else{
				$so = 'uid';$uid = intval($uid);
			}
			
			$good_info = $gid;
			$reg = $this->db->GetOne("select * from `@#_member` where `$so` = '$uid' limit 1");
			$money = $good_info['yunjiage'] * $num;
			if($reg && $reg['money'] >= $money){
				return $reg;
			}else{
				_message("没有该会员或该会员账户资金不够购买 $num 次商品");
			}
		}
	}
	//准备测试
	private function goods_user_go($uid=null,$gid=null,$num=null){
		System::load_sys_fun('user');
		$good_info = $gid;
		$gid = $good_info['id'];
		$uinfo = $uid;
		$uid = $uinfo['uid'];		
		$gtitle = $good_info['title'];
		$utitle = get_user_name($uinfo);
				
		$paydb = System::load_app_class('pay','pay');
		$number = $num;
		$reg = $paydb->pay_user_go_shop($uid,$gid,$number);
		if($reg){
			$specify = $this->db->GetOne("select * from `@#_goodspecify` where `gid` = '$gid' and `uid` = '$uid'");
			if($specify){
				$number = $specify['num'] + $number;
				$this->db->Query("UPDATE `@#_goodspecify` SET `num` = '$number' where `id` = '$specify[id]'");
			}else{
				$inster = $this->db->Query("INSERT INTO `@#_goodspecify` (`uid`,`gid`,`num`,`utitle`,`gtitle`) VALUES ('$uid','$gid','$number','$utitle','$gtitle')");
				if(!$inster)_message("商品购买成功但准备会员插入失败!");
			}
		}
	
		return $reg;		
	}
	
	//ajax 根据分类与品牌获取商品
	public function json_goods(){
		$cateid = $this->segment(4);
		$bandid = $this->segment(5);
		if(!empty($cateid) && !empty($bandid)){		
			$glist = $this->db->GetList("select id,sid,title,qishu,shenyurenshu from `@#_shoplist` where (`cateid` = '$cateid' and `brandid` = '$bandid' and `q_uid` is null and  `shenyurenshu` != 0)");
			echo  json_encode($glist);exit;
		}	
	}
	
	public function pecifylist(){			
			$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_goodspecify` WHERE 1 order by id DESC");
			$page=System::load_sys_class('page');
			if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
			$page->config($total,20,$pagenum,"0");		
			$plist = $this->db->GetPage("select * from `@#_goodspecify` where 1 order by id DESC",array("num"=>20,"page"=>$pagenum,"type"=>1,"cache"=>0));
			
			include $this->tpl(ROUTE_M,'pecifylist');
	}
	
	
}