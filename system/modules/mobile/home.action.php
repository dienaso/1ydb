<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
class home extends base {
	public function __construct(){
		parent::__construct();
		if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if( !$this->userinfo){
			header("location:".WEB_PATH."/mobile/user/login");	
			}
		}
		$this->db = System::load_sys_class('model');

	}
	public function init(){
	    $webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$title="我的用户中心";
		//$quanzi=$this->db->GetList("select * from `@#_quanzi_tiezi` order by id DESC LIMIT 5");

	 //获取购买等级  购买新手  购买小将==
	  $memberdj=$this->db->GetList("select * from `@#_member_group`");

	  $jingyan=$member['jingyan'];
	  if(!empty($memberdj)){
	     foreach($memberdj as $key=>$val){
		    if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
			   $member['yungoudj']=$val['name'];
			}
		 }
	  }

		include templates("mobile/user","index");
	}


//手机验证
	public function mobilechecking(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="手机验证";
		
		if(!empty($member['mobile'])){
			echo "<script type='text/javascript'>alert('请勿重复验证！');</script>";

			//_messagemobile("您的手机已经验证成功,请勿重复验证！");
		}	else{
		include templates("mobile/user","mobilechecking");
		}
	}
	
	//手机验证
	public function mobilesuccess(){
		
		$title="手机验证";
		$member=$this->userinfo;
		
		if(isset($_POST['submit'])){
			$mobile=isset($_POST['mobile']) ? $_POST['mobile'] : "";
			if(!_checkmobile($mobile) || $mobile==null){
				_messagemobile("手机号错误",null,3);	
			}
			$member2=$this->db->GetOne("select mobilecode,uid,mobile from `@#_member` where `mobile`='$mobile' and `uid` != '$member[uid]'");
			if($member2 && $member2['mobilecode'] == 1){
			echo "<script type='text/javascript'>alert('手机号已被注册！');</script>";
				_messagemobile("手机号已被注册！");
			}					
			if($member['mobilecode']!=1){
				//验证码
				$ok = send_mobile_reg_code($mobile,$member['uid']);			
				if($ok[0]!=1){
					_messagemobile("发送失败,失败状态:".$ok[1]);
				}else{
					_setcookie("mobilecheck",base64_encode($mobile));
				}					
			}
			$time=120;
			include templates("mobile/user","mobilesuccess");
		}
	}
	//重发手机验证码
	public function sendmobile(){
		$member=$this->userinfo;
		$mobilecodes=rand(100000,999999).'|'.time();//验证码

		if($member['mobilecode']==1){_message("该账号验证成功",WEB_PATH."/member/home");}			
		
		$checkcode=explode("|",$member['mobilecode']);
		$times=time()-$checkcode[1];
		if($times > 120){
			//重发验证码			
				$ok = send_mobile_reg_code($member['mobile'],$member['uid']);
				if($ok[0]!=1){
					_messagemobile("发送失败,失败状态:".$ok[1]);
				}
			
			_messagemobile("正在重新发送...",WEB_PATH."/mobile/user/mobilecheck/"._encrypt($member['mobile']),2);				
		}else{
			_messagemobile("重发时间间隔不能小于2分钟!",WEB_PATH."/mobile/user/mobilecheck/"._encrypt($member['mobile']));
		}
		
	}
	public function mobilecheck(){	
		$member=$this->userinfo;
		if(isset($_POST['submit'])){
			$shoujimahao =  base64_decode(_getcookie("mobilecheck"));
			if(!_checkmobile($shoujimahao))_messagemobile("手机号码错误!");			
			$checkcodes=isset($_POST['mobile']) ? $_POST['mobile'] : _messagemobile("参数不正确!");
			if(strlen($checkcodes)!=6)_messagemobile("验证码输入不正确!");
			$usercode=explode("|",$member['mobilecode']);	

			if($checkcodes!=$usercode[0])_messagemobile("验证码输入不正确!");
			$this->db->Query("UPDATE `@#_member` SET `mobilecode`='1',`mobile` = '$shoujimahao' where `uid`='$member[uid]'");
			//夺宝币、经验添加			
			$isset_user=$this->db->GetList("select `uid` from `@#_member_account` where `content`='手机认证完善奖励' and `type`='1' and `uid`='$member[uid]' and (`pay`='经验' or `pay`='夺宝币')");	
			if(empty($isset_user)){
				$config = System::load_app_config("user_fufen");//夺宝币/经验
				$time=time();
				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','夺宝币','手机认证完善奖励','$config[f_phonecode]','$time')");
				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','经验','手机认证完善奖励','$config[z_phonecode]','$time')");			
				$this->db->Query("UPDATE `@#_member` SET `score`=`score`+'$config[f_phonecode]',`jingyan`=`jingyan`+'$config[z_phonecode]' where uid='".$member['uid']."'");
			}
			_setcookie("uid",_encrypt($member['uid']));	
			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])));		
//夺宝币、经验添加			
			$isset_user=$this->db->GetOne("select `uid` from `@#_member_account` where `pay`='手机认证完善奖励' and `type`='1' and `uid`='$member[uid]' or `pay`='经验'");	
			if(empty($isset_user)){
				$config = System::load_app_config("user_fufen");//夺宝币/经验
				$time=time();

				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','夺宝币','手机认证完善奖励','$config[f_overziliao]','$time')");
				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','经验','手机认证完善奖励','$config[z_overziliao]','$time')");			
				$mysql_model->Query("UPDATE `@#_member` SET `score`=`score`+'$config[f_overziliao]',`jingyan`=`jingyan`+'$config[z_overziliao]' where uid='".$member['uid']."'");
				$this->db->Query("UPDATE `@#_member` SET score='100' where `uid`='$member[uid]'");	
			}			
			echo "<script type='text/javascript'>alert('验证成功,请重新登录');</script>";
			//_messagemobile("验证成功,请重新登录！",WEB_PATH."/mobile/home");
		}else{
			_messagemobile("页面错误",null,3);
		}
	}
	//end

public function address(){
	    $mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$member_dizhi=$mysql_model->GetOne("select * from `@#_member_dizhi` where uid='".$member['uid']."' limit 5");
		if($member_dizhi['default'] == "Y"){
		header("location: ?/mobile/home/add");
		}else{
		header("location: ?/mobile/home/upadd");
		}
		
		include templates("mobile/user","address");
	} 
	public function upadd(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="收货地址";
		$member_dizhi=$mysql_model->Getlist("select * from `@#_member_dizhi` where uid='".$member['uid']."' limit 5");
		foreach($member_dizhi as $k=>$v){		
			$member_dizhi[$k] = _htmtocode($v);
		}
		$count=count($member_dizhi);
		include templates("mobile/user","upadd");
	}
	public function add(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="收货地址";
		$member_dizhi=$mysql_model->Getlist("select * from `@#_member_dizhi` where uid='".$member['uid']."' limit 5");
		foreach($member_dizhi as $k=>$v){		
			$member_dizhi[$k] = _htmtocode($v);
		}
		$count=count($member_dizhi);
		include templates("mobile/user","add");
	}
	public function morenaddress(){
		
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$member_dizhi=$mysql_model->Getlist("select * from `@#_member_dizhi` where uid='".$member['uid']."'");
		foreach($member_dizhi as $dizhi){
			if($dizhi['default']=='Y'){
				$mysql_model->Query("UPDATE `@#_member_dizhi` SET `default`='N' where uid='".$member['uid']."'");
			}
		}
		$id = $this->segment(4);
		$id = abs(intval($id));
		if(isset($id)){
		$mysql_model->Query("UPDATE `@#_member_dizhi` SET `default`='Y' where id='".$id."'");				
		echo _message("修改成功",WEB_PATH."/mobile/home",3);
		}
	}
	
	public function deladdress(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$id=$this->segment(4);
		$id = abs(intval($id));
		$dizhi=$mysql_model->Getone("select * from `@#_member_dizhi` where `uid`='$member[uid]' and `id`='$id'");
		if(!empty($dizhi)){
			$mysql_model->Query("DELETE FROM `@#_member_dizhi` WHERE `uid`='$member[uid]' and `id`='$id'");
			header("location:".WEB_PATH."/mobile/home/address");
		}else{
			echo _message("删除失败",WEB_PATH."/mobile/home",0);
		}
	}
	public function updateddress(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid=$member['uid'];
		$id = $this->segment(4);
		$id = abs(intval($id));
		if(isset($_POST['submit'])){
			$sheng=isset($_POST['sheng']) ? $_POST['sheng'] : "";
			$shi=isset($_POST['shi']) ? $_POST['shi'] : "";
			$xian=isset($_POST['xian']) ? $_POST['xian'] : "";
			$jiedao=isset($_POST['jiedao']) ? $_POST['jiedao'] : "";
			$youbian=isset($_POST['youbian']) ? $_POST['youbian'] : "";
			$shouhuoren=isset($_POST['shouhuoren']) ? $_POST['shouhuoren'] : "";
			$tell=isset($_POST['tell']) ? $_POST['tell'] : "";
			$mobile=isset($_POST['mobile']) ? $_POST['mobile'] : "";
			$time=time();
			if($sheng==null or $jiedao==null or $shouhuoren==null or $mobile==null){
				echo "带星号不能为空;";
				exit;
			}			
			if(!_checkmobile($mobile)){
				echo "手机号错误;";
				exit;
			}
		$mysql_model->Query("UPDATE `@#_member_dizhi` SET 
		`uid`='".$uid."',
		`sheng`='".$sheng."',
		`shi`='".$shi."',
		`xian`='".$xian."',
		`jiedao`='".$jiedao."',
		`youbian`='".$youbian."',
		`shouhuoren`='".$shouhuoren."',
		`tell`='".$tell."',
		`mobile`='".$mobile."' where `id`='".$id."'");				
		_messagemobile("修改成功",WEB_PATH."/mobile/home",3);
		}
	}
	public function useraddress(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid=$member['uid'];
		if(isset($_POST['submit'])){
			foreach($_POST as $k=>$v){
				$_POST[$k] = _htmtocode($v);
			}
			$sheng=isset($_POST['sheng']) ? $_POST['sheng'] : "";
			$shi=isset($_POST['shi']) ? $_POST['shi'] : "";
			$xian=isset($_POST['xian']) ? $_POST['xian'] : "";
			$jiedao=isset($_POST['jiedao']) ? $_POST['jiedao'] : "";
			$youbian=isset($_POST['youbian']) ? $_POST['youbian'] : "";
			$shouhuoren=isset($_POST['shouhuoren']) ? $_POST['shouhuoren'] : "";
			$tell=isset($_POST['tell']) ? $_POST['tell'] : "";
			$mobile=isset($_POST['mobile']) ? $_POST['mobile'] : "";
			$time=time();
			if($sheng==null or $jiedao==null or $shouhuoren==null or $mobile==null){
				echo "带星号不能为空;";
				exit;
			}			
			if(!_checkmobile($mobile)){
				echo "手机号错误;";
				exit;
			}
			$member_dizhi=$mysql_model->GetOne("select * from `@#_member_dizhi` where `uid`='".$member['uid']."'");
			if(!$member_dizhi){
				$default="Y";
			}else{
				$default="N";
			}
			$mysql_model->Query("INSERT INTO `@#_member_dizhi`(`uid`,`sheng`,`shi`,`xian`,`jiedao`,`youbian`,`shouhuoren`,`tell`,`mobile`,`default`,`time`)VALUES
			('$uid','$sheng','$shi','$xian','$jiedao','$youbian','$shouhuoren','$tell','$mobile','$default','$time')");
			_messagemobile("收货地址添加成功",WEB_PATH."/mobile/home",3);
		}
	}
	  
	 
	public function password(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="密码修改";	
		include templates("mobile/user","password");
	}
	public function oldpassword(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		if($member['password']==md5($_POST['param'])){
			echo '{
					"info":"",
					"status":"y"
				}';
		}else{
			echo "原密码错误";
		}
	}
	public function userpassword(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		//$member=$mysql_model->GetOne("select * from `@#_member` where uid='".$member['uid']."'");	
		$password=isset($_POST['password']) ? $_POST['password'] : "";
		$userpassword=isset($_POST['userpassword']) ? $_POST['userpassword'] : "";
		$userpassword2=isset($_POST['userpassword2']) ? $_POST['userpassword2'] : "";
		if($password==null or $userpassword==null or $userpassword2==null){
				echo "密码不能为空;";
				exit;
			}
		if($_POST['password']<6 and $_POST['password']<20){
			echo "密码小于6位数";
			exit;
		}
		if($_POST['userpassword']!=$_POST['userpassword2']){
			echo "新密码不一致";
			exit;
		}		
		$password=md5($password);
		$userpassword=md5($userpassword);
		if($member['password']!=$password){
			echo _messagemobile("原密码错误,请重新输入!",null,3);
		}else{
			$mysql_model->Query("UPDATE `@#_member` SET password='".$userpassword."' where uid='".$member['uid']."'");
			echo _messagemobile("密码修改成功,请重新登录!",null,3);
		}
	} 


	//购买记录
	public function userbuylist(){
	  $mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$title="购买记录 - "._cfg("web_name");		
		
		$total=$this->db->GetCount("select * from `@#_member_go_record` where `uid`='$uid' order by `id` DESC");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,10,$pagenum,"0");		
		$record = $this->db->GetPage("select * from `@#_member_go_record` where `uid`='$uid' order by `id` DESC",array("num"=>10,"page"=>$pagenum,"type"=>1,"cache"=>0));
		
		include templates("mobile/user","userbuylist");
	}
function invite(){
        $webname=$this->_cfg['web_name'];
        $member=$this->userinfo;
        $title="我的用户中心";
        //$quanzi=$this->db->GetList("select * from `@#_quanzi_tiezi` order by id DESC LIMIT 5");

        //获取购买等级  购买新手  购买小将==
        $memberdj=$this->db->GetList("select * from `@#_member_group`");

        $jingyan=$member['jingyan'];
        if(!empty($memberdj)){
            foreach($memberdj as $key=>$val){
                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
                    $member['yungoudj']=$val['name'];
                }
            }
        }
        include templates("mobile/user","invite");
    }
	//购买记录
	public function jf_userbuylist(){
	   $webname=$this->_cfg['web_name'];
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$title="购买记录";
		//$record=$mysql_model->GetList("select * from `@#_member_go_record` where `uid`='$uid' ORDER BY `time` DESC");
		include templates("mobile/user","jf_userbuylist");
	}
	//购买记录详细
	public function userbuydetail(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="购买详情";
		$crodid=intval($this->segment(4));
		$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `id`='$crodid' and `uid`='$member[uid]' LIMIT 1");		
		if(!$record){
			_messagemobile("页面错误",WEB_PATH."/mobile/home/userbuylist",3);
		}
		$shopinfo=$mysql_model->GetOne("select thumb from `@#_shoplist` where `id`='$record[shopid]' LIMIT 1");
		$record['thumb'] = $shopinfo['thumb'];
		if($crodid>0){
			include templates("mobile/user","userbuydetail");
		}else{
			_messagemobile("页面错误",WEB_PATH."/mobile/home/userbuylist",3);
		}
	}

	//获得的商品
	public function orderlist(){
	    $webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$title="获得的商品";
		//$record=$this->db->GetList("select * from `@#_member_go_record` where `uid`='".$member['uid']."' and `huode`>'10000000' ORDER BY id DESC");
		include templates("mobile/user","orderlist");
	}
	//账户管理

	public function userbalance(){

	    $webname=$this->_cfg['web_name'];

		$member=$this->userinfo;

		$title="账户记录";

		$account=$this->db->GetList("select * from `@#_member_account` where `uid`='$member[uid]' and `pay` = '账户' ORDER BY time DESC");

         $czsum=0;

         $xfsum=0;

		if(!empty($account)){

			foreach($account as $key=>$val){

			  if($val['type']==1){

				$czsum+=$val['money'];

			  }else{

				$xfsum+=$val['money'];

			  }

			}

		}



		include templates("mobile/user","userbalance");

	}





	public function userrecharge(){

	    $webname=$this->_cfg['web_name'];

		$member=$this->userinfo;

		$title="账户充值";

		$paylist = $this->db->GetList("SELECT * FROM `@#_pay` where `pay_start` = '1' AND pay_mobile = 1");

		// 		print_r($paylist);

		include templates("mobile/user","recharge");

	}
	/*
	public function pay(){
		if(isset($_POST['submit'])){
			$mid = TENPAY_MID; //商户编号
			$key = TENPAY_KEY; //商户密钥
			$desc = '购买系统'; //商品名称
			$oid = date("YmdHis").rand(100,999); //商户订单号
			$pri = $_POST['money']*100; //总价(单位:分)
			$url = WEB_PATH.'/member/home/tenpaysuccess'; //回调地址
			header("location:".makeUrl($key,$desc,$mid,$oid,$pri,$url));
		}
	}
	public function tenpaysuccess(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$cmd_no         = $_GET['cmdno'];
		$pay_result     = $_GET['pay_result'];
		$pay_info       = $_GET['pay_info'];
		$bill_date      = $_GET['date'];
		$bargainor_id   = $_GET['bargainor_id'];
		$transaction_id = $_GET['transaction_id'];
		$sp_billno      = $_GET['sp_billno'];
		$total_fee      = $_GET['total_fee']/100+$member['money'];
		$fee_type       = $_GET['fee_type'];
		$attach         = $_GET['attach'];
		$sign           = $_GET['sign'];
		if($pay_result<1){
			$mysql_model->Query("UPDATE `@#_member` SET money='".$total_fee."' where uid='".$member['uid']."'");
			_message("支付成功",WEB_PATH.'/member/home/userbalance',3);
		}
	}
	*/
	//绑定大厅
	public function band(){
		 $webname=$this->_cfg['web_name'];
		include templates("mobile/user","band");
	}
	//任务中心
	//晒单
	public function wrenwu(){
		 $webname=$this->_cfg['web_name'];
		include templates("mobile/user","wrenwu");
	}

	//晒单
	public function singlelist(){
		 $webname=$this->_cfg['web_name'];
		include templates("mobile/user","singlelist");
	}

	//Wap晒单
	public function singlelister(){
		$member=$this->userinfo;
		$title="我的晒单";
		$cord=$this->db->Getlist("select * from `@#_member_go_record` where `uid`='$member[uid]' and `huode` > '10000000'");
		
		$shaidan=$this->db->Getlist("select * from `@#_shaidan` where `sd_userid`='$member[uid]' order by `sd_id`");

		$sd_id = $r_id = array();
		foreach($shaidan as $sd){
			if(!empty($sd['sd_shopid'])){
				$sd_id[]=$sd['sd_shopid'];
			}
		}

		foreach($cord as $rd){
			if(!in_array($rd['shopid'],$sd_id)){
				$r_id[]=$rd['shopid'];
			}
		}
		if(!empty($r_id)){
			$rd_id=implode(",",$r_id);
			$rd_id = trim($rd_id,',');
		}else{
			$rd_id="0";
		}
		
		$record = $this->db->Getlist("select a.shopid,a.id from `@#_member_go_record` as a left join `@#_shoplist` as b on a.shopid=b.id where a.shopid in ($rd_id) and a.`uid`='$member[uid]' and a.`huode`>'10000000' and b.q_showtime='N'");

		$total=$this->db->GetCount("select * from `@#_shaidan` where `sd_userid`='$member[uid]' order by `sd_id`");
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}
		$page=System::load_sys_class('page');
		$page->config($total,10,$pagenum,"0");

		$shaidan=$this->db->GetPage("select * from `@#_shaidan` where `sd_userid`='$member[uid]' order by `sd_id`",array("num"=>10,"page"=>$pagenum,"type"=>1,"cache"=>0));

		include templates("mobile/user","singlelister");
	}
	
	
	/*添加晒单*/
	public function singleinsert(){	
		$member=$this->userinfo;
		$uid=_getcookie('uid');
		$ushell=_getcookie('ushell');
		$title="添加晒单";		
		
		$recordid=intval($this->segment(4));
		$shopid = $recordid;
		$shaidan=$this->db->GetOne("select * from `@#_member_go_record` where `id`='$recordid' and `uid` = '$member[uid]'");
		if(!$shaidan){
			_message("该商品您不可晒单!");
		}
		$shaidanyn=$this->db->GetOne("select sd_id from `@#_shaidan` where `sd_shopid`='$recordid' and `sd_userid` = '$member[uid]'");
		if($shaidanyn){
			_message("不可重复晒单!");
		}
		$ginfo=$this->db->GetOne("select id,sid,qishu from `@#_shoplist` where `id`='$shaidan[shopid]' LIMIT 1");
		if(!$ginfo){
			_message("该商品已不存在!");
		}
			

	

		if(isset($_POST['submit'])){		
	
			
			if($_POST['title']==null)_messagemobile("标题不能为空");	
			if($_POST['content']==null)_messagemobile("内容不能为空");	
			System::load_sys_class('upload','sys','no');
			$img=$_POST['fileurl_tmp'];
			$num=count($img);
			$pic="";
			for($i=0;$i<$num;$i++){
				$pic.=trim($img[$i]).";";
			}
			$src=trim($img[0]);
			
			$size=getimagesize(G_UPLOAD.$src);
			$width=220;
			$height=$size[1]*($width/$size[0]);			
		
			$src_houzhui = upload::thumbs($width,$height,false,G_UPLOAD.'/'.$src);			
			$thumbs=$src."_".intval($width).intval($height).".".$src_houzhui;			
			
			
			$sd_userid = $this->userinfo['uid'];
			$sd_shopid = $ginfo['id'];	
			$sd_shopsid = $ginfo['sid'];	
			$sd_qishu = $ginfo['qishu'];	
			$sd_title = _htmtocode($_POST['title']);
			$path = 'shaidan/';
			$sd_thumbs = $path .$_POST['shaitu']. '.jpg';
			$sd_content = $_POST['content'];
			$sd_photolist= $path .$_POST['shaitu']. '.jpg;';
			$sd_time=time();		
			$sd_ip = _get_ip_dizhi();	

			
			
			$this->db->Query("INSERT INTO `@#_shaidan`(`sd_userid`,`sd_shopid`,`sd_shopsid`,`sd_qishu`,`sd_ip`,`sd_title`,`sd_thumbs`,`sd_content`,`sd_photolist`,`sd_time`)VALUES
			('$sd_userid','$sd_shopid','$sd_shopsid','$sd_qishu','$sd_ip','$sd_title','$sd_thumbs','$sd_content','$sd_photolist','$sd_time')");

			_messagemobile("晒单分享成功",WEB_PATH."/mobile/home/singlelist");
		}		
		
		include templates("mobile/user","singleinsert");
	}
	
	//编辑
	public function singleupdate(){
		_message("不可编辑!");
		if(isset($_POST['submit'])){
			System::load_sys_class('upload','sys','no');
			if($_POST['title']==null)_message("标题不能为空");	
			if($_POST['content']==null)_message("内容不能为空");				
			$sd_id=$_POST['sd_id'];
			$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");			
			$pic=null;$thumbs=null;
			if(isset($_POST['fileurl_tmp'])){
				if($shaidan['sd_photolist']==null){				
					$img=$_POST['fileurl_tmp'];
					$num=count($img);
					for($i=0;$i<$num;$i++){
						$pic.=trim($img[$i]).";";
					}
					$src=trim($img[0]);
					$size=getimagesize(G_UPLOAD_PATH."/".$src);
					$width=220;
					$height=$size[1]*($width/$size[0]);			
					$thumbs=tubimg($src,$width,$height);
				}else{
					$img=$_POST['fileurl_tmp'];
					$num=count($img);
					for($i=0;$i<$num;$i++){
						$pic.=$img[$i].";";
					}
				}
			}
			if($thumbs!=null){
				$sd_thumbs=$thumbs;
			}else{
				$sd_thumbs=$shaidan['sd_thumbs'];
			}
			$uid=$this->userinfo;
			$sd_userid=$uid['uid'];
			$sd_shopid=$shaidan['sd_shopid'];
			$sd_title=$_POST['title'];
			$sd_content=$_POST['content'];
			$sd_photolist=$pic.$shaidan['sd_photolist'];
			$sd_time=time();			
			$this->db->Query("UPDATE `@#_shaidan` SET
			`sd_userid`='$sd_userid',
			`sd_shopid`='$sd_shopid',
			`sd_title`='$sd_title',
			`sd_thumbs`='$sd_thumbs',
			`sd_content`='$sd_content',
			`sd_photolist`='$sd_photolist',
			`sd_time`='$sd_time' where sd_id='$sd_id'");
			_message("晒单修改成功",WEB_PATH."/mobile/home/singlelist");
		}
		$member=$this->userinfo;
		$title="修改晒单";	
		$uid=_getcookie('uid');
		$ushell=_getcookie('ushell');
		$sd_id=intval($this->segment(4));
		if($sd_id>0){
			$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
			include templates("mobile","singleupdate");
		}else{
			_message("页面错误");
		}	
	}
	public function singoldimg(){
		if($_POST['action']=='del'){
			$sd_id=$_POST['sd_id'];
			$sd_id = abs(intval($sd_id));
			$oldimg=$_POST['oldimg'];
			$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
			$sd_photolist=str_replace($oldimg.";","",$shaidan['sd_photolist']);
			$this->db->Query("UPDATE `@#_shaidan` SET sd_photolist='".$sd_photolist."' where sd_id='".$sd_id."'");
		}
	}


	# 我的修改 夺宝币签到
	public function qiandao() {
		# 签到时间限制（不能夸天哦。。）
		$time_start = '00:01';
		$time_stop= '23:59';

		# 每日签到增加夺宝币
		$time_score = 50;

		# 连续签到的天数
		$time_day = 30;
		# 连续签到增加的夺宝币
		$time_day_score = rand(10000,15000);

		if ( $this->segment(4) == 'mobile' ) {
			function x__message($a,$b=null,$c=2) {
				_messagemobile($a,$b,$c);
			}
		} else {
			function x__message($a,$b=null,$c=2) {
				_message($a,$b,$c);
			}
		}



		$member=$this->userinfo;
		if ( isset($_REQUEST['submit']) || $this->segment(5)=='submit' ) {
			if ( !$member['mobile']) {
				x__message("非常抱歉只有手机验证会员才能签到喔",WEB_PATH."/mobile/home/qiandao/".$this->segment(4));

			}else if ( $member['sign_in_date'] == date('Y-m-d') ) {
				x__message("您今天已经过签到了。",WEB_PATH."/mobile/home/qiandao/".$this->segment(4));

			}else if ( strtotime(date('Y-m-d').$time_start ) > time() || strtotime(date('Y-m-d').$time_stop ) < time() ) {
				x__message("现在不是签到时间！签到时间为{$time_start}点到{$time_stop}点",WEB_PATH."/mobile/home/qiandao/".$this->segment(4));

			} else {
				$mysql_model = System::load_sys_class('model');
				if ( $member['sign_in_date'] == date('Y-m-d',strtotime('-1 day')) ){
					# 连续签到

					if ( $member['sign_in_time'] >= $time_day ) {
						$member['sign_in_time'] = 0;
					}

					$sign_in_time = $member['sign_in_time'] + 1;
					$sign_in_time_all = $member['sign_in_time_all'] + 1;
					$sign_in_date = date('Y-m-d');
					$score = $member['score'] + $time_score;

					if ( $sign_in_time >= $time_day ) {
						# 领取大礼包了
						$score += $time_day_score;
						$big = true;
					} else {
						$big = false;
					}

					$mysql_model->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('".$member['uid']."', '1', '夺宝币', '每日签到', '$time_score', '".time()."')");
					$mysql_model->Query("UPDATE `@#_member` SET score='".$score."',sign_in_time='".$sign_in_time."', sign_in_time_all='".$sign_in_time_all."', sign_in_date='".$sign_in_date."' where uid='".$member['uid']."'");
					if ( $big ) {
						$mysql_model->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('".$member['uid']."', '1', '夺宝币', '签到大礼包', '$time_day_score', '".time()."')");
						x__message("签到成功，成功领取{$time_score}夺宝币。<br />恭喜您获得{$time_day_score}夺宝币的大礼包。<br />您的当前夺宝币为{$score}",WEB_PATH."/mobile/home/qiandao/".$this->segment(4),10);
					} else {
						x__message("签到成功，成功领取{$time_score}夺宝币。<br />您的当前夺宝币为{$score}。<br />再连续签到".($time_day-$sign_in_time)."天就能领取大礼包啦，加油！！！",WEB_PATH."/mobile/home/qiandao/".$this->segment(4));
					}

				} else {
					$sign_in_time = 1;
					$sign_in_time_all = $member['sign_in_time_all'] + 1;
					$sign_in_date = date('Y-m-d');
					$score = $member['score'] + $time_score;
					$mysql_model->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('".$member['uid']."', '1', '夺宝币', '每日签到', '$time_score', '".time()."')");
					$mysql_model->Query("UPDATE `@#_member` SET score='".$score."',sign_in_time='".$sign_in_time."', sign_in_time_all='".$sign_in_time_all."', sign_in_date='".$sign_in_date."' where uid='".$member['uid']."'");
					x__message("签到成功，成功领取{$time_score}夺宝币。<br />您的当前夺宝币为{$score}",WEB_PATH."/mobile/home/qiandao/".$this->segment(4));
				}
			}
			die;
		}

		if ( !$member['sign_in_date'] ) {
			$member['sign_in_date'] = '-';

		}else if ( $member['sign_in_date'] != date('Y-m-d') && $member['sign_in_date'] != date('Y-m-d',strtotime('-1 day')) ) {

			$member['sign_in_time'] = 0;
		}
		if ( !$this->segment(4) == 'mobile' ) {
			include templates("mobile/user","qiandao");
		} else {
			include templates("member","qiandao");
		}
	}
	
	//晒单上传
	public function singphotoup(){
		
		if(!empty($_FILES)){
			/*
				更新时间：2014-04-28
				xu
			*/
			/*
			$uid=isset($_POST['uid']) ? $_POST['uid'] : NULL;		
			$ushell=isset($_POST['ushell']) ? $_POST['ushell'] : NULL;
			$login=$this->checkuser($uid,$ushell);
			if(!$login){echo "上传失败";exit;}
			
			*/
			System::load_sys_class('upload','sys','no');
			upload::upload_config(array('png','jpg','jpeg','gif'),1000000,'shaidan');
			upload::go_upload($_FILES['Filedata']);
			if(!upload::$ok){
				echo _message(upload::$error,null,3);
			}else{
				$img=upload::$filedir."/".upload::$filename;					
				$size=getimagesize(G_UPLOAD_PATH."/shaidan/".$img);
				$max=700;$w=$size[0];$h=$size[1];
				if($w>700){
					$w2=$max;
					$h2=$h*($max/$w);
					upload::thumbs($w2,$h2,1);						
				}					
				echo trim("shaidan/".$img);
			}					
		} 
	}	
	public function singdel(){
		$action=isset($_GET['action']) ? $_GET['action'] : null; 
		$filename=isset($_GET['filename']) ? $_GET['filename'] : null;
		if($action=='del' && !empty($filename)){
			$filename=G_UPLOAD_PATH.'shaidan/'.$filename;			
			$size=getimagesize($filename);			
			$filetype=explode('/',$size['mime']);			
			if($filetype[0]!='image'){
				return false;
				exit;
			}
			unlink($filename);
			exit;
		}
	}
	//晒单删除
	public function shaidandel(){
		_message("已添加的晒单不可删除!");
		$member=$this->userinfo;
		//$id=isset($_GET['id']) ? $_GET['id'] : "";
		$id=$this->segment(4);
		$id=intval($id);
		$shaidan=$this->db->Getone("select * from `@#_shaidan` where `sd_userid`='$member[uid]' and `sd_id`='$id'");
		if($shaidan){
			$this->db->Query("DELETE FROM `@#_shaidan` WHERE `sd_userid`='$member[uid]' and `sd_id`='$id'");
			_message("删除成功",WEB_PATH."/mobile/home/singlelist");
		}else{
			_message("删除失败",WEB_PATH."/mobile/home/singlelist");
		}
	}



	



	/*
	*	设置发货
	**/
	public function set_record(){
		
		
		if(!isset($_POST['uid']) || !isset($_POST['oid'])){exit;}
		$uid = abs(intval($_POST['uid']));
		$oid = abs(intval($_POST['oid']));
		if(!$oid || !$uid){
			echo "0";
			exit;
		}
		$info = $this->db->GetOne("SELECT uid,status FROM `@#_member_go_record` WHERE `id` = '$oid' and `uid` = '$uid' limit 1");
		if(!$info)_message("参数错误");
		$status = @explode(",",$info['status']);
		if(is_array($status) &&  $status[1]=='已发货'){
			$status = '已付款,已发货,已完成';
			$q = $this->db->Query("UPDATE `@#_member_go_record` SET `status` = '$status' WHERE `id` = '$oid'");
			echo $q ? '1' : '0';
		}else{
			echo "0";
		}	
		
		
	}

    /*
	*	设置发货
	**/
	public function set_jf_record(){
		
		
		if(!isset($_POST['uid']) || !isset($_POST['oid'])){exit;}
		$uid = abs(intval($_POST['uid']));
		$oid = abs(intval($_POST['oid']));
		if(!$oid || !$uid){
			echo "0";
			exit;
		}
		$info = $this->db->GetOne("SELECT uid,status FROM `@#_member_go_jf_record` WHERE `id` = '$oid' and `uid` = '$uid' limit 1");
		if(!$info)_message("参数错误");
		$status = @explode(",",$info['status']);
		if(is_array($status) &&  $status[1]=='已发货'){
			$status = '已付款,已发货,已完成';
			$q = $this->db->Query("UPDATE `@#_member_go_jf_record` SET `status` = '$status' WHERE `id` = '$oid'");
			echo $q ? '1' : '0';
		}else{
			echo "0";
		}	
		
		
	}

}

?>