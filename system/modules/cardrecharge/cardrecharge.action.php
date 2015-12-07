<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class cardrecharge extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");

	}
	//
	public function init(){
		if(empty($_COOKIE["card"])){
			$this->card_login();
			exit;
		}
		include $this->tpl(ROUTE_M,'cardrecharge');
	}
	
   //生成卡
	public function cardrg(){
		if(empty($_COOKIE["card"])){
			$this->card_login();
			exit;
		}
		if(isset($_POST['dosubmit'])){
		 
		    $operationtype=htmlspecialchars($_POST['operationtype']);
		    $isrepeat=htmlspecialchars($_POST['isrepeat']);
		    $rechargetime=strtotime(htmlspecialchars($_POST['rechargetime']));
			$maxrepeatcount=intval($_POST['maxrepeatcount']);            		
			$time=time();
			
            if($operationtype=='random'){			 
			 //随机生成			 
			    $allmoney=intval($_POST['allmoney']);
			    $mixmoney=intval($_POST['mixmoney']);
			    $maxmoney=intval($_POST['maxmoney']);
				$zhang=intval($_POST['zhang1']);
				
				$moneysum=$maxmoney*$zhang;
				
				if(empty($allmoney) || $allmoney<0 || empty($mixmoney) || $mixmoney<0 || empty($maxmoney) || $maxmoney<0){ _message("金额输入有误！");exit;}
				
				if($allmoney<$maxmoney){
					 _message("总金额不能小于充值额的最大值！");exit;
				}
				 
				if($mixmoney>$maxmoney){
					_message("充值额的最大值不能小于最小值！");exit;
				}
				 
			    if($allmoney<$moneysum){
				 
				   _message("充值额的最大值乘以张数已大于控制的总金额！");exit;
				}
				
				
 
				if($zhang >100 || $zhang < 0 || empty($zhang)) _message("张数必须在1~100之间！");
				$str ="卡密号:卡密充值".$zhang."张\n";
				$str = iconv('utf-8','gb2312',$str);
				$i=0;
				$money=array();
				$moneysum=0;
			    for($i=0;$i<$zhang;$i++){	
				  $money[$i]=mt_rand($mixmoney,$maxmoney);                  			  
				}
 				
				$km= 'LC'.substr(md5(rand(0,time())),2,19);			
 
				$i=0;
				while($i<$zhang){				    
					$name = iconv('utf-8','gb2312', $km);
					$codepwd=substr(rand(0,time()),2,6); 
					$str .= $name."\r\n".$codepwd.'\r\n';					 
					$this->db->query("insert into `@#_card_recharge` (`money`,`code`,`isrepeat`,`rechargetime`,`codepwd`,`maxrechargecout`) values ('$money[$i]','$km','$isrepeat','$rechargetime','$codepwd','$maxrepeatcount')");
					
					$kh[$i]=$km;
					$kw[$i]=$codepwd;
					$i++;
					$km= 'LC'.substr(md5(rand($i,time())),2,19);
					
					
				}
			  
			  
			}else{
			 //固定生成
			 	$money=intval($_POST['money']);
				$zhang=intval($_POST['zhang2']);
			    if(empty($money) || $money<0) _message("金额输入有误！");
				if($zhang >100 || $zhang < 0 || empty($zhang)) _message("张数必须在1~100之间！");
				$str ="卡密号:卡密充值".$money.'元'.$zhang."张\n";
				$str = iconv('utf-8','gb2312',$str);
				$i=0;
				$km= 'LC'.substr(md5(rand(0,time())),2,19);
				while($i<$zhang){
					$name = iconv('utf-8','gb2312', $km);
					$codepwd=substr(rand(0,time()),2,6); 
					$str=$str . "卡号=>".$name."=>密码".$codepwd."\n";
					$kh[$i]=$km;
					$kw[$i]=$codepwd;
					$i++;

					$this->db->query("insert into `@#_card_recharge` (`money`,`code`,`isrepeat`,`rechargetime`,`codepwd`,`maxrechargecout`) values ('$money','$km','$isrepeat','$rechargetime','$codepwd','$maxrepeatcount')");
					$km= 'LC'.substr(md5(rand($i,time())),2,19);
				}
			   
			}		  		
			if(empty($_COOKIE["card"])){
				$this->card_login();
				exit;
			}
			if($isrepeat=='Y'){
			  $maxrepeatcount=0;
			}
			 
			
			//导出excel
			include $this->tpl(ROUTE_M,'download.cardrecharge');
			$dl_card = new download_cardrecharge($operationtype,$money,$kh,$isrepeat,$rechargetime,$kw,$maxrepeatcount,$zhang);
			$dl_card->download_card();
				
			}
	}
	
	


   //充值管理
	public function lists(){
	 
		if(empty($_COOKIE["card"])){
			$this->card_login();
			exit;
		}
		$num=20;
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_card_recharge` WHERE 1"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");	
 		
		$res=$this->db->GetPage("select * from `@#_card_recharge`",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0)); 		
 
		include $this->tpl(ROUTE_M,'cardrecharge.lists');
}

   //删除记录
	public function del(){
		if(empty($_COOKIE["card"])){
			$this->card_login();
			exit;
		}
		$id = $this->segment(4);
		$this->db->GetCount("delete from `@#_card_recharge` WHERE `id`='$id'"); 
		_message("删除成功！");
	}
    
	//登录
	public function card_login(){

		$card='';
		if($card){
			_message('已经登录！',WEB_PATH."/cardrecharge/cardrecharge/lists");
		}
		if(isset($_POST['sub'])){
			$card_pwd=htmlspecialchars($_POST['password']);
			if(empty($card_pwd)) _message('密码不能为空!');
			$card_pwd=md5($card_pwd);
			$card_pwd=$this->db->GetOne("select * from `@#_card_pwd` where `pwd`='$card_pwd'");
			if($card_pwd){
				setcookie("card", $card_pwd['pwd'], time()+3600);
				_message('登录成功',WEB_PATH.'/cardrecharge/cardrecharge/');
			}else{
				_message('卡密密码输入有误，请重新输入！');
			}
		}
		
		include $this->tpl(ROUTE_M,'cardrecharge.login');
	}
  
  
  //修改密码
	public function update_pwd(){
		if(isset($_POST['sub'])){
			if(empty($_POST['password'])) _message("原密码不能为空！");
			if(empty($_POST['pwd'])) _message("新密码不能为空！");
			if(empty($_POST['truepwd'])) _message("新密码不能为空！");

			$password=md5($_POST['password']);
			$res=$this->db->GetOne("select * from `@#_card_pwd` where `pwd`='$password'");
			if(empty($res)) _message("原密码错误！");
			$pwd=md5($_POST['pwd']);
			$truepwd=md5($_POST['truepwd']);
			if($pwd!=$truepwd) _message("2次密码不相等！");

			$res=$this->db->query("update `@#_card_pwd` set pwd='$pwd'");
			if($res) _message("卡密密码修改成功！");
			_message("卡密密码修改失败！");
		}
		include $this->tpl(ROUTE_M,'cardrecharge.update_pwd');
	}

	public function card_del(){

			setcookie("card", "", time()-3600);//清口卡密密码
			_message("退出成功！",WEB_PATH."/cardrecharge/cardrecharge/card_login");

	}
}

?>