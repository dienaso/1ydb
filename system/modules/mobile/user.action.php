<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('memberbase',null,'no');
System::load_app_fun('user','go');
System::load_app_fun('my','go');
System::load_sys_fun('send');
class user extends memberbase {
	public function __construct(){
		parent::__construct();
		$this->db = System::load_sys_class("model");
	}

	public function cook_end(){
		_setcookie("uid","",time()-3600);
		_setcookie("ushell","",time()-3600);
		//_message("退出成功",WEB_PATH."/mobile/mobile/");
		header("location: ".WEB_PATH."/mobile/mobile/");
	}
	//返回登录页面
	public function login(){
		$webname=$this->_cfg['web_name'];
		$user = $this->userinfo;
		if($user){
			header("Location:".WEB_PATH."/mobile/home/");exit;
		}

		include templates("mobile/user","login");

	}
	//返回注册页面
	public function register(){
	  	$webname=$this->_cfg['web_name'];
		include templates("mobile/user","register");
	}

	//返回发送验证码页面
	public function mobilecode(){
	    $webname=$this->_cfg['web_name'];
	    $mobilename=$this->segment(4);

		include templates("mobile/user","mobilecheck");
	}

	public function mobilecheck(){
	    $webname=$this->_cfg['web_name'];
		$title="验证手机";
		$time=3000;
		$name=$this->segment(4);
		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' LIMIT 1");
		 //var_dump($member);exit;
		if(!$member)_message("参数不正确!");
		if($member['mobilecode']==1){
			_message("该账号验证成功",WEB_PATH."/mobile/mobile");
		}
		if($member['mobilecode']==-1){
			$sendok = send_mobile_reg_code($name,$member['uid']);
			if($sendok[0]!=1){
				_message($sendok[1]);
			}
			header("location:".WEB_PATH."/mobile/user/mobilecheck/".$member['mobile']);
			exit;
		}
		$enname=substr($name,0,3).'****'.substr($name,7,10);
		$time=120;
		include templates("mobile/user","mobilecheck");
	}

		private function create_code($len = 6){
		$randpwd = '';
		for ($i = 0; $i < $len; $i++){
			$randpwd .= chr(mt_rand(33, 126));
		}
		$randpwd = base64_encode($randpwd);
		return $randpwd;
	}


	//微信登录
	function wxlogin(){
		$user = $this->userinfo;
	    $pro = $this->segment(4);
	    file_put_contents('t.txt', "\n\r\r\n-----pro:".$pro,FILE_APPEND);

		$this->db=System::load_sys_class('model');
		$wx_set =$this->db->GetOne("SELECT * from `@#_wxset` ");

		//网站根目录下的t.txt文件不可删除，没有自己创建
		if(!$user){
			$code = $this->create_code();
			if($pro){
				_setcookie("procode",$pro);
				$pu = $this->db->GetOne("select * from `@#_activity_code` where `code`='$pro'");
				if(empty($pu)){
					$pu = $this->db->GetOne("select * from `@#_member` where `code`='$pro'");
				}
			}else{
				$pro=_getcookie("procode");
				$pu = $this->db->GetOne("select * from `@#_activity_code` where `code`='$pro'");
			}
			$p_mobile = $pu['mobile'] ? $pu['mobile'] : '';
			$this->db->Query("insert into `@#_activity_code`(`code`,`status`,`pro`) values('$code',0,'{$p_mobile}')");
		}else{
			if(empty($user['code'])){
				$user['code'] = $this->create_code();
				$this->db->GetOne("update `@#_member` set code='{$user['code']}' where `uid`='{$user['uid']}'");
			}
		}

		if(!empty($user) && !empty($pro) && $pro==$user['code']){
			$mylink = '';
			include templates("mobile/index","activity_share");die;
		}

		session_start();
		$state  = md5(uniqid(rand(), TRUE));
		$_SESSION["wxState"]	=   $state;
		$redirect_uri = urlencode("".$wx_set['mback']."/?mobile/user/wx_callback/".$code."/");
		//设置微信登录回调地址http://m.xxxx.com/和公众号设置回调一样的
		$wxurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$wx_set['mappid']."&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=$state#wechat_redirect";
		header("Location: $wxurl");
	}


    function wx_callback(){
         session_start();
		  if($_GET["state"] != $_SESSION["wxState"]){ _messagemobile("登录验证失败!","".$wx_set['mback']."/?/mobile/user/login");  }

			//登录失败返回地址http://m.xxx.com/
			$this->db=System::load_sys_class('model');
			$wx_set =$this->db->GetOne("SELECT * from `@#_wxset` ");
			//$go_user_info = $this->db->GetOne("select * from `@#_member_band`");

		 $code = $_GET["code"];
	     $procode = $this->segment(4);
	     file_put_contents('t.txt', "\n\r\r\n-----procode:".$procode,FILE_APPEND);
	     $response = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$wx_set['mappid']."&secret=".$wx_set['msecret']."&code=$code&grant_type=authorization_code");
	     $jsondecode = json_decode($response,true);
         $wx_openid =$jsondecode["unionid"];
         if(empty($wx_openid)){
			 
         	_messagemobile("绑定出错，请联系管理员。");die;
         }
		 $access_token =$jsondecode["access_token"];
		 $response= file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$wx_openid");
		 $jsondecode = json_decode($response,true);
	
		 $nickname = $jsondecode["nickname"];
		 $tximg = $jsondecode["headimgurl"];
		 $go_user_info = $this->db->GetOne("select * from `@#_member_band` where `b_code` = '$wx_openid' and `b_type` = 'weixin' LIMIT 1");
		$bb_code = $go_user_info['b_code'];
	
		 if($bb_code!=$wx_openid){
			 $IMG = file_get_contents($tximg); 
			 $path = 'statics/uploads/wximg/';
			 $mulu = time();
			  
			 //file_put_contents($path ."/". $mulu . '.jpg', $IMG);
			file_put_contents($path ."/". $mulu . '.jpg',$IMG);	
			file_put_contents($path ."/". $mulu . '.jpg_160160.jpg',$IMG);	
			file_put_contents($path ."/". $mulu . '.jpg_3030.jpg',$IMG);
			file_put_contents($path ."/". $mulu . '.jpg_8080.jpg',$IMG);	

		    $userpass = md5("123456");
			$go_user_img  = 'wximg/'.$mulu . '.jpg';
		    $go_user_time = time();
		    $q1 = $this->db->Query("INSERT INTO `@#_member` (`username`,`password`,`img`,`band`,`time`,`money`,`first`,`code`,`wxband`) VALUES ('$nickname','$userpass','$go_user_img','weixin','$go_user_time',0,1,'$procode','weixin')");
		    $uid = $this->db->insert_id();
			$this->db->Query("INSERT INTO `@#_member_band` (`b_uid`, `b_type`, `b_code`, `b_time`) VALUES ('$uid', 'weixin', '$wx_openid', '$go_user_time')");
			$member = $this->db->GetOne("select uid,password,mobile,email from `@#_member` where `uid` = '$uid' LIMIT 1");

		    $se1 = _setcookie("uid",_encrypt($member['uid']),60*60*24*7);
		    $se2 = _setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
			$callback_url =  WEB_PATH."/mobile/home/mobilechecking";
			header("Location:$callback_url");
		 }else{
		    $uid = $go_user_info["b_uid"];
			$member = $this->db->GetOne("select uid,password,mobile,email from `@#_member` where `uid` = '$uid' LIMIT 1");
			$se1 = _setcookie("uid",_encrypt($member['uid']),60*60*24*7);
		    $se2 = _setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);

			if(!$member['mobile']){
			    $callback_url =  WEB_PATH."/mobile/home";
			    header("Location:$callback_url");
            }else{
			  	$callback_url =  WEB_PATH."/mobile/home";
			  	header("Location:$callback_url");
			}
		 }

	}
	



	public function findpassword(){
	  	$webname=$this->_cfg['web_name'];
		include templates("mobile/user","findpassword");
	}


	public function buyDetail(){
		$webname=$this->_cfg['web_name'];
		$member=$this->userinfo;
		$itemid=intval($this->segment(4));

		$itemlist=$this->db->GetList("select *,a.time as timego,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$member[uid]' and b.id='$itemid' group by a.id order by a.time" );

		if(!empty($itemlist)){
			if($itemlist[0]['q_end_time']!=''){
				//商品已揭晓
				$itemlist[0]['codeState']='已揭晓...';
				$itemlist[0]['class']='z-ImgbgC02';
			}elseif($itemlist[0]['shenyurenshu']==0){
				//商品购买次数已满
				$itemlist[0]['codeState']='已满员...';
				$itemlist[0]['class']='z-ImgbgC01';
			}else{
				//进行中
				$itemlist[0]['codeState']='进行中...';
				$itemlist[0]['class']='z-ImgbgC01';
			}
			$bl=($itemlist[0]['canyurenshu']/$itemlist[0]['zongrenshu'])*100;

			foreach ($itemlist as $k => $v) {
				$count += $v['gonumber'];
			}
		}
		$count = $count ? $count : 0;
		include templates("mobile/user","userbuyDetail");
	}

}//

?>