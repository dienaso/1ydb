<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('memberbase',null,'no');
System::load_app_fun('user','go');
System::load_app_fun('my','go');
System::load_sys_fun('send');
class weixin extends memberbase {
	public function __construct(){
		parent::__construct();
		$this->db = System::load_sys_class("model");
	}

	
	//微信登录
	function wxlogin(){
		$user = $this->userinfo;
	    $pro = $this->segment(4);
	    file_put_contents('t.txt', "\n\r\r\n-----pro:".$pro,FILE_APPEND);

		$this->db=System::load_sys_class('model');
		$wx_set =$this->db->GetOne("SELECT * from `@#_wxset` ");

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
		$redirect_uri = urlencode("".$wx_set['back']."/?mobile/user/wx_callback/".$code."/");
		$wxurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$wx_set['appid']."&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=$state#wechat_redirect";
		header("Location: $wxurl");
	}


    function wx_callback(){
         session_start();
		 if($_GET["state"] != $_SESSION["wxState"]){ _messagemobile("登录验证失败!","".$wx_set['back']."/?/mobile/user/login");  }

		 $this->db=System::load_sys_class('model');
		 $wx_set =$this->db->GetOne("SELECT * from `@#_wxset` ");

		 $code = $_GET["code"];
	     $procode = $this->segment(4);
	     file_put_contents('t.txt', "\n\r\r\n-----procode:".$procode,FILE_APPEND);
	     $response = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$wx_set['appid']."&secret=".$wx_set['secret']."&code=$code&grant_type=authorization_code");
	     $jsondecode = json_decode($response,true);
         $wx_openid =$jsondecode["openid"];
         if(empty($wx_openid)){
         	_messagemobile("绑定出错，请联系管理员。");die;
         }
		 $access_token =$jsondecode["access_token"];
		 $response= file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$wx_openid");
		 $jsondecode = json_decode($response,true);

		 $nickname = $jsondecode["nickname"];
		 $go_user_info = $this->db->GetOne("select * from `@#_member_band` where `b_code` = '$wx_openid' and `b_type` = 'weixin' LIMIT 1");
		 if(!$go_user_info){
		    $userpass = md5("123456");
			$go_user_img  ='photo/member.jpg';
		    $go_user_time = time();
		    $q1 = $this->db->Query("INSERT INTO `@#_member` (`username`,`password`,`img`,`band`,`time`,`money`,`first`,code) VALUES ('$nickname','$userpass','$go_user_img','weixin','$go_user_time',0,1,'$procode')");
		    $uid = $this->db->insert_id();
			$this->db->Query("INSERT INTO `@#_member_band` (`b_uid`, `b_type`, `b_code`, `b_time`) VALUES ('$uid', 'weixin', '$wx_openid', '$go_user_time')");
			$member = $this->db->GetOne("select uid,password,mobile,email from `@#_member` where `uid` = '$uid' LIMIT 1");

		    $se1 = _setcookie("uid",_encrypt($member['uid']),60*60*24*7);
		    $se2 = _setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);
			$callback_url =  WEB_PATH."/mobile/home/mobilebind";
			header("Location:$callback_url");
		 }else{
		    $uid = $go_user_info["b_uid"];
			$member = $this->db->GetOne("select uid,password,mobile,email from `@#_member` where `uid` = '$uid' LIMIT 1");
			$se1 = _setcookie("uid",_encrypt($member['uid']),60*60*24*7);
		    $se2 = _setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])),60*60*24*7);

			if(!$member['mobile']){
			    $callback_url =  WEB_PATH."/mobile/home/mobilebind";
			    header("Location:$callback_url");
            }else{
			  	$callback_url =  WEB_PATH."/mobile/activity/";
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