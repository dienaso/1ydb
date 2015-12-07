<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
System::load_app_fun('member',ROUTE_M);
class home extends base {
	public function __construct(){ 
		parent::__construct();
		if(ROUTE_A!='userphotoup' and ROUTE_A!='singphotoup'){
			if(!$this->userinfo)_message("���¼",WEB_PATH."/member/user/login",3);
		}		
		
		$this->db = System::load_sys_class('model');
		
	}
	public function init(){
		$member=$this->userinfo;
		$title="��������";	
		$quanzi=$this->db->GetList("select * from `@#_quanzi_tiezi` order by id DESC LIMIT 5");
		
		$jingyan = $member['jingyan'];
		
		$dengji_1 = $this->db->GetOne("select * from `@#_member_group` where `jingyan_start` <= '$jingyan' and `jingyan_end` >= '$jingyan'"); 
		$max_jingyan_id = $dengji_1['groupid'];
		$dengji_2 = $this->db->GetOne("select * from `@#_member_group` where `groupid` > '$max_jingyan_id' order by `groupid` asc limit 1");
		if($dengji_2){
			$dengji_x = $dengji_2['jingyan_start'] - $jingyan;
 		}else{
			$dengji_x = $dengji_1['jingyan_end'] - $jingyan;	
		}
		
		
		include templates("member","index");
	}
	
	
	//��������
	public function userphoto(){	
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="�޸�ͷ��";
		$uid=_getcookie('uid');
		$ushell=_getcookie('ushell');
		include templates("member","photo");
	}
	
	//ͷ���ϴ�
	public function userphotoup(){

		if(!empty($_FILES)){			
			$uid=isset($_POST['uid']) ? $_POST['uid'] : NULL;		
			$ushell=isset($_POST['ushell']) ? $_POST['ushell'] : NULL;
			$login=$this->checkuser($uid,$ushell);			
			if(!$login){echo "δ��½";exit;}
			
			System::load_sys_class('upload','sys','no');
			upload::upload_config(array('png','jpg','jpeg'),500000,'touimg');
			upload::go_upload($_FILES['Filedata'],true);
			$files=$_POST['typeCode'];
			if(!upload::$ok){
				echo upload::$error;
			}else{
				$img=upload::$filedir."/".upload::$filename;				
				$size=getimagesize(G_UPLOAD."/touimg/".$img);
				$max=300;$w=$size[0];$h=$size[1];				
				if($w>300 or $h>300){
					if($w>$h){
						$w2=$max;
						$h2 = intval($h*($max/$w));
						upload::thumbs($w2,$h2,true);					
					}else{
						$h2=$max;
						$w2 = intval($w*($max/$h));
						upload::thumbs($w2,$h2,true);
					}
				}			
				echo "touimg/".$img;
			}					
		}
	}
	
	//ͷ��ü�
	public function userphotoinsert(){		
		$uid = $this->userinfo['uid'];		
		if(isset($_POST["submit"])){		
			$tname  = trim(str_ireplace(" ","",$_POST['img']));			
			$tname  = _htmtocode($tname);
			if(!file_exists(G_UPLOAD.$tname)){_message("ͷ���޸�ʧ��",WEB_PATH."/member/home/userphoto",3);}
			$x = (int)$_POST['x'];
			$y = (int)$_POST['y'];
			$w = (int)$_POST['w'];
			$h = (int)$_POST['h'];
			$point = array("x"=>$x,"y"=>$y,"w"=>$w,"h"=>$h);
			
			System::load_sys_class('upload','sys','no');
			upload::thumbs(160,160,false,G_UPLOAD.$tname,$point);
			upload::thumbs(80,80,false,G_UPLOAD.$tname,$point);
			upload::thumbs(30,30,false,G_UPLOAD.$tname,$point);			
			
			$this->db->Query("UPDATE `@#_member` SET img='$tname' where uid='$uid'");
			_message("ͷ���޸ĳɹ�",WEB_PATH."/member/home/userphoto",3);
			
		}
	}
	
	//��������
	public function modify(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="�༭��������";
		$member_qq=$this->db->GetOne("select * from `@#_member_band` where `b_uid`=$member[uid]");
		include templates("member","modify");
	}
	//������֤
	public function mailchecking(){	
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="������֤";
		if($member['email'] && $member['emailcode'] == 1){
			_message("���������Ѿ���֤�ɹ�,�����ظ���֤��");
		}		
		include templates("member","mailchecking");
		
	}
	public function mailchackajax(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;		
		$member2=$mysql_model->GetOne("select uid from `@#_member` where `email`='".$_POST['param']."'");
		if(!empty($member2)){
			echo "�����Ѿ�����";
		}else{
			echo '{
					"info":"",
					"status":"y"
				}';
		}
	}
	
	
	
	//������֤�ʼ�
	public function sendsuccess(){		
		if(!isset($_POST['submit']))_message("��������",WEB_PATH.'/member/home/modify');
		if(!isset($_POST['email']) || empty($_POST['email']))_message("�����ַ����Ϊ��!",WEB_PATH.'/member/home/modify');
		if(!_checkemail($_POST['email']))_message("�����ʽ����!",WEB_PATH.'/member/home/modify');
		
		$config_email = System::load_sys_config("email");
		if(empty($config_email['user']) && empty($config_email['pass'])){
					_message("ϵͳ�������ò���ȷ!",WEB_PATH.'/member/home/modify');
		}
		
		$member=$this->userinfo;
		$title="���ͳɹ�";	
		$email = $_POST['email'];
		
		$member2=$this->db->GetOne("select * from `@#_member` where `email`='$email' and `uid` != '$member[uid]'");
		if(!empty($member2) && $member2['emailcode'] == 1){
			_message("�������Ѿ����ڣ���ѡ�������������֤��",WEB_PATH.'/member/home/modify');
		}
		
		$strcode1=$email.",".$member['uid'].",".time();
		$strcode= _encrypt($strcode1);
		
		$tit=$this->_cfg['web_name_two']."����ע������";
		$content='<span>����24Сʱ�ڰ�����</span>��������ӣ�<a href="'.WEB_PATH.'/member/home/emailcheckingok/'.$strcode.'">';
		$content.=WEB_PATH.'/member/home/emailcheckingok/'.$strcode.'</a>';
		$succ=_sendemail($email,'',$tit,$content,'yes','no');
		if($succ=='no'){
				_message("�ʼ�����ʧ��!",WEB_PATH.'/member/home/modify',30);
		}else{
				include templates("member","sendsuccess");	
		}
		
	}
	
	//������֤����
	public function emailcheckingok(){
		$member=$this->userinfo;
		$key=$this->segment(4);
		if($this->segment(5)){
			$key.='/'.$this->segment(5);
		}
		
		$emailcode=_encrypt($key,'DECODE');				
		if(empty($emailcode)){
			 _message("��֤ʧ��,��������ȷ��",null,3);
		}		
		$memberx=explode(",",$emailcode);		
		$email=$memberx[0];
		$timec=(time()-$memberx[2])/(60*60);	
		$qmember=$this->db->GetOne("select * from `@#_member` where `email`='$email' and `uid` != '$member[uid]'");
		if($qmember && $qmember['emailcode']==1){
			_message("�������ѱ���֤,�����ظ���֤!",WEB_PATH.'/member/home');
		}		
		if($timec<24){
			$this->db->Query("UPDATE `@#_member` SET email='".$memberx[0]."',emailcode='1' where uid='$member[uid]'");			
			$title="������֤���";
			include templates("member","sendsuccess2");
		}else{
			_message("��֤ʱ���ѹ���!",null,3);
		}
	}
	public function mobilechecking(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="�ֻ���֤";
		if($member['mobile'] && $member['mobilecode'] == 1){
			_message("�����ֻ��Ѿ���֤�ɹ�,�����ظ���֤��");
		}	
		include templates("member","mobilechecking");
	}
	
	//�ֻ���֤
	public function mobilesuccess(){
		
		$title="�ֻ���֤";
		$member=$this->userinfo;
		
		if(isset($_POST['submit'])){
			$mobile=isset($_POST['mobile']) ? $_POST['mobile'] : "";
			if(!_checkmobile($mobile) || $mobile==null){
				_message("�ֻ��Ŵ���",null,3);	
			}
			$member2=$this->db->GetOne("select mobilecode,uid,mobile from `@#_member` where `mobile`='$mobile' and `uid` != '$member[uid]'");
			if($member2 && $member2['mobilecode'] == 1){
				_message("�ֻ����ѱ�ע�ᣡ");
			}					
			if($member['mobilecode']!=1){
				//��֤��
				$ok = send_mobile_reg_code($mobile,$member['uid']);			
				if($ok[0]!=1){
					_message("����ʧ��,ʧ��״̬:".$ok[1]);
				}else{
					_setcookie("mobilecheck",base64_encode($mobile));
				}					
			}
			$time=120;
			include templates("member","mobilesuccess");
		}
	}
	//�ط��ֻ���֤��
	public function sendmobile(){
		$member=$this->userinfo;
		$mobilecodes=rand(100000,999999).'|'.time();//��֤��

		if($member['mobilecode']==1){_message("���˺���֤�ɹ�",WEB_PATH."/member/home");}			
		
		$checkcode=explode("|",$member['mobilecode']);
		$times=time()-$checkcode[1];
		if($times > 120){
			//�ط���֤��			
				$ok = send_mobile_reg_code($member['mobile'],$member['uid']);
				if($ok[0]!=1){
					_message("����ʧ��,ʧ��״̬:".$ok[1]);
				}
			
			_message("�������·���...",WEB_PATH."/member/user/mobilecheck/"._encrypt($member['mobile']),2);				
		}else{
			_message("�ط�ʱ��������С��2����!",WEB_PATH."/member/user/mobilecheck/"._encrypt($member['mobile']));
		}
		
	}
	public function mobilecheck(){	
		$member=$this->userinfo;
		if(isset($_POST['submit'])){
			$shoujimahao =  base64_decode(_getcookie("mobilecheck"));
			if(!_checkmobile($shoujimahao))_message("�ֻ��������!");			
			$checkcodes=isset($_POST['mobile']) ? $_POST['mobile'] : _message("��������ȷ!");
			if(strlen($checkcodes)!=6)_message("��֤�����벻��ȷ!");
			$usercode=explode("|",$member['mobilecode']);	

			if($checkcodes!=$usercode[0])_message("��֤�����벻��ȷ!");
			$this->db->Query("UPDATE `@#_member` SET `mobilecode`='1',`mobile` = '$shoujimahao' where `uid`='$member[uid]'");
			//���֡��������			
			$isset_user=$this->db->GetList("select `uid` from `@#_member_account` where `content`='�ֻ���֤���ƽ���' and `type`='1' and `uid`='$member[uid]' and (`pay`='����' or `pay`='����')");	
			if(empty($isset_user)){
				$config = System::load_app_config("user_fufen");//����/����
				$time=time();
				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','����','�ֻ���֤���ƽ���','$config[f_phonecode]','$time')");
				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','����','�ֻ���֤���ƽ���','$config[z_phonecode]','$time')");			
				$this->db->Query("UPDATE `@#_member` SET `score`=`score`+'$config[f_phonecode]',`jingyan`=`jingyan`+'$config[z_phonecode]' where uid='".$member['uid']."'");
			}
			_setcookie("uid",_encrypt($member['uid']));	
			_setcookie("ushell",_encrypt(md5($member['uid'].$member['password'].$member['mobile'].$member['email'])));		
//���֡��������			
			$isset_user=$this->db->GetOne("select `uid` from `@#_member_account` where `pay`='�ֻ���֤���ƽ���' and `type`='1' and `uid`='$member[uid]' or `pay`='����'");	
			if(empty($isset_user)){
				$config = System::load_app_config("user_fufen");//����/����
				$time=time();

				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','����','�ֻ���֤���ƽ���','$config[f_overziliao]','$time')");
				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','����','�ֻ���֤���ƽ���','$config[z_overziliao]','$time')");			
				$mysql_model->Query("UPDATE `@#_member` SET `score`=`score`+'$config[f_overziliao]',`jingyan`=`jingyan`+'$config[z_overziliao]' where uid='".$member['uid']."'");
				$this->db->Query("UPDATE `@#_member` SET score='100' where `uid`='$member[uid]'");	
			}			
			_message("��֤�ɹ�",WEB_PATH."/member/home/modify");
		}else{
			_message("ҳ�����",null,3);
		}
	}
	public function usermodify(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		if(isset($_POST['submit'])){			
			$username=_htmtocode(trim($_POST['username']));
			$username = str_ireplace("'","",$username);
			$qianming=_htmtocode(trim($_POST['qianming']));
			$reg_user_str = $this->db->GetOne("select value from `@#_caches` where `key` = 'member_name_key' limit 1");
			$reg_user_str = explode(",",$reg_user_str['value']);
			if(is_array($reg_user_str) && !empty($username)){
				foreach($reg_user_str as $rv){
					if($rv == $username){
						_message("���ǳƽ�ֹʹ��!");
					}
				}
			
			}			
			//���֡��������
			$isset_user=$this->db->GetOne("select `uid` from `@#_member_account` where (`content`='�ֻ���֤���ƽ���' or `content`='�����ǳƽ���') and `type`='1' and `uid`='$member[uid]' and (`pay`='����' or `pay`='����')");	
			if(!$isset_user){			
				$config = System::load_app_config("user_fufen");//����/����
				$time=time();

				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','����','�����ǳƽ���','$config[f_overziliao]','$time')");
				$this->db->Query("insert into `@#_member_account` (`uid`,`type`,`pay`,`content`,`money`,`time`) values ('$member[uid]','1','����','�����ǳƽ���','$config[z_overziliao]','$time')");			
				$mysql_model->Query("UPDATE `@#_member` SET username='".$username."',qianming='".$qianming."',`score`=`score`+'$config[f_overziliao]',`jingyan`=`jingyan`+'$config[z_overziliao]' where uid='".$member['uid']."'");
			}	
			$mysql_model->Query("UPDATE `@#_member` SET username='".$username."',qianming='".$qianming."' where uid='".$member['uid']."'");
			_message("�޸ĳɹ�",WEB_PATH."/member/home/modify",3);
			
		}
	}
	public function address(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="�ջ���ַ";
		$member_dizhi=$mysql_model->Getlist("select * from `@#_member_dizhi` where uid='".$member['uid']."' limit 5");
		foreach($member_dizhi as $k=>$v){		
			$member_dizhi[$k] = _htmtocode($v);
		}
		$count=count($member_dizhi);
		include templates("member","address");
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
		echo _message("�޸ĳɹ�",WEB_PATH."/mobile/home",3);
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
			header("location:".WEB_PATH."/member/home/address");
		}else{
			echo _message("ɾ��ʧ��",WEB_PATH."/mobile/home",0);
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
				echo "���ǺŲ���Ϊ��;";
				exit;
			}			
			if(!_checkmobile($mobile)){
				echo "�ֻ��Ŵ���;";
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
		_message("�޸ĳɹ�",WEB_PATH."/mobile/home",3);
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
				echo "���ǺŲ���Ϊ��;";
				exit;
			}			
			if(!_checkmobile($mobile)){
				echo "�ֻ��Ŵ���;";
				exit;
			}
			$member_dizhi=$mysql_model->GetOne("select * from `@#_member_dizhi` where `uid`='".$member['uid']."'");
			if(!$member_dizhi){
				$default="Y";
			}else{
				$default="N";
			}
			$m = $mysql_model->Query("INSERT INTO `@#_member_dizhi`(`uid`,`sheng`,`shi`,`xian`,`jiedao`,`youbian`,`shouhuoren`,`tell`,`mobile`,`default`,`time`)VALUES
			('$uid','$sheng','$shi','$xian','$jiedao','$youbian','$shouhuoren','$tell','$mobile','$default','$time')");

			
			_message("�ջ���ַ��ӳɹ�",WEB_PATH."/mobile/home",3);
		}
	}
	
	public function password(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="�����޸�";	
		include templates("member","password");
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
			echo "ԭ�������";
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
				echo "���벻��Ϊ��;";
				exit;
		}
		
		if(strlen($_POST['password'])<6 || strlen($_POST['password'])>20){
			echo "���벻��С��6λ���ߴ���20λ";
			exit;
		}
		if($_POST['userpassword']!==$_POST['userpassword2']){
			echo "�������벻һ��";
			exit;
		}		
		$password=md5($password);
		$userpassword=md5($userpassword);
		if($member['password']!=$password){
			echo _message("ԭ�������",null,3);
		}else{
			$mysql_model->Query("UPDATE `@#_member` SET password='".$userpassword."' where uid='".$member['uid']."'");
			echo _message("�����޸ĳɹ�",null,3);
		}
	}
	//�۹���¼
	public function userbuylist(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$title="�۹���¼ - "._cfg("web_name");		
		
		$total=$this->db->GetCount("select * from `@#_member_go_record` where `uid`='$uid' order by `id` DESC");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,10,$pagenum,"0");		
		$record = $this->db->GetPage("select * from `@#_member_go_record` where `uid`='$uid' order by `id` DESC",array("num"=>10,"page"=>$pagenum,"type"=>1,"cache"=>0));
		
		include templates("member","userbuylist");
	}
	//�۹���¼��ϸ
	public function userbuydetail(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$title="�۹�����";
		$crodid=intval($this->segment(4));
		$record=$mysql_model->GetOne("select * from `@#_member_go_record` where `id`='$crodid' and `uid`='$member[uid]' LIMIT 1");		
		if(!$record){
			_message("ҳ�����",WEB_PATH."/member/home/userbuylist",3);
		}
		$shopinfo=$mysql_model->GetOne("select thumb from `@#_shoplist` where `id`='$record[shopid]' LIMIT 1");
		$record['thumb'] = $shopinfo['thumb'];
		if($crodid>0){
			include templates("member","userbuydetail");
		}else{
			_message("ҳ�����",WEB_PATH."/member/home/userbuylist",3);
		}
	}
	//��õ���Ʒ
	public function orderlist(){
		$member=$this->userinfo;	
		$uid = $member['uid'];
		$title="��õ���Ʒ - "._cfg("web_name");
		
		$total=$this->db->GetCount("select * from `@#_member_go_record` where `uid`='$uid' and `huode`>'10000000'");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,10,$pagenum,"0");		
		$record = $this->db->GetPage("select * from `@#_member_go_record` where `uid`='$uid' and `huode`>'10000000' ORDER BY id DESC",array("num"=>10,"page"=>$pagenum,"type"=>1,"cache"=>0));
		
		foreach($record as $ckey=>$cord){
			$jiexiao = get_shop_if_jiexiao($cord['shopid']);
			if(!$jiexiao){
				unset($record[$ckey]);
			}
		}		
		
		include templates("member","orderlist");
	}
	//�˻�����
	public function userbalance(){
		$member=$this->userinfo;	
		$uid = $member['uid'];
		$title="�˻���¼ - "._cfg("web_name");		
		
		$total=$this->db->GetCount("select * from `@#_member_account` where `uid`='$uid' and `pay` = '�˻�'");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,20,$pagenum,"0");		
		$account = $this->db->GetPage("select * from `@#_member_account` where `uid`='$uid' and `pay` = '�˻�' ORDER BY time DESC",array("num"=>20,"page"=>$pagenum,"type"=>1,"cache"=>0));
				
		include templates("member","userbalance");
	}
	
	//�˻�����
	public function userfufen(){
		$member=$this->userinfo;	
		$uid = $member['uid'];
		$title="�˻����� - "._cfg("web_name");
	
		$total=$this->db->GetCount("select * from `@#_member_account` where `uid`='$uid' and `pay` = '����'");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,20,$pagenum,"0");		
		$account = $this->db->GetPage("select * from `@#_member_account` where `uid`='$uid' and `pay` = '����' ORDER BY time DESC",array("num"=>20,"page"=>$pagenum,"type"=>1,"cache"=>0));
				
		include templates("member","userfufen");
	}	
	public function userrecharge(){
		$member=$this->userinfo;
		$title="�˻���ֵ";
		$paylist = $this->db->GetList("SELECT * FROM `@#_pay` where `pay_start` = '1' and `pay_mobile` = 0");	
		include templates("member","userrecharge");
	}	

	//Ȧ�ӹ���
	public function joingroup(){
		$member=$this->userinfo;
		$title="�����Ȧ��";
		$addgroup=rtrim($member['addgroup'],",");
		if($addgroup){
			$group=$this->db->GetList("select * from `@#_quanzi` where `id` in ($addgroup)");		
		}else{
			$group=null;
		}	
		include templates("member","joingroup");
	}
	public function topic(){
		$member=$this->userinfo;
		$title="Ȧ�ӻ���";
		$tiezi=$this->db->GetList("select * from `@#_quanzi_tiezi` where `hueiyuan`='$member[uid]'");	
		$hueifu=$this->db->GetList("select * from `@#_quanzi_hueifu` where `hueiyuan`='$member[uid]'");	
		include templates("member","topic");
	}
	public function tiezidel(){
		$member=$this->userinfo;
		$id = $this->segment(4);
		$id = abs(intval($id));
		$tiezi=$this->db->Getone("select * from `@#_quanzi_tiezi` where `hueiyuan`='$member[uid]' and  `id`='$id'");
		if($tiezi){
			$this->db->Query("DELETE FROM `@#_quanzi_tiezi` WHERE `hueiyuan`='$member[uid]' and  `id`='$id'");
			_message("ɾ���ɹ�",WEB_PATH."/member/home/topic");
		}else{
			_message("ɾ��ʧ��",WEB_PATH."/member/home/topic");
		}
	}
	public function hueifudel(){
		$member=$this->userinfo;
		$id = $this->segment(4);
		$id = abs(intval($id));
		$hueifu=$this->db->Getone("select * from `@#_quanzi_hueifu` where `id`='$id'");
		if($hueifu){
			$this->db->Query("DELETE FROM `@#_quanzi_hueifu` WHERE `id`='$id'");
			_message("ɾ���ɹ�",WEB_PATH."/member/home/topic");
		}else{
			_message("ɾ��ʧ��",WEB_PATH."/member/home/topic");
		}
	}

	
	//ɹ��
	public function singlelist(){
		$member=$this->userinfo;
		$title="�ҵ�ɹ��";
		$cord=$this->db->Getlist("select * from `@#_member_go_record` where `uid`='$member[uid]' and `huode` > '10000000'");
		
		$shaidan=$this->db->Getlist("select * from `@#_shaidan` where `sd_userid`='$member[uid]' order by `sd_id` DESC limit 10");
		
		$sd_id = $r_id = array();
		foreach($shaidan as $sd){
			$sd_id[]=$sd['sd_shopid'];			
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
		
		
		$total=$this->db->GetCount("select id from `@#_member_go_record` where shopid in ($rd_id) and `uid`='$member[uid]' and `huode`>'10000000'");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,10,$pagenum,"0");
		$record = $this->db->GetPage("select shopid,id from `@#_member_go_record` where shopid in ($rd_id) and `uid`='$member[uid]' and `huode`>'10000000'",array("num"=>10,"page"=>$pagenum,"type"=>1,"cache"=>0));
		include templates("member","singlelist");
	}	
	
	
	
	/*���ɹ��*/
	public function singleinsert(){	
		$member=$this->userinfo;
		$uid=_getcookie('uid');
		$ushell=_getcookie('ushell');
		$title="���ɹ��";		
		
		$recordid=intval($this->segment(4));
		$shopid = $recordid;
		$shaidan=$this->db->GetOne("select * from `@#_member_go_record` where `id`='$recordid' and `uid` = '$member[uid]'");
		if(!$shaidan){
			_message("����Ʒ������ɹ��!");
		}
		$shaidanyn=$this->db->GetOne("select sd_id from `@#_shaidan` where `sd_shopid`='$recordid' and `sd_userid` = '$member[uid]'");
		if($shaidanyn){
			_message("�����ظ�ɹ��!");
		}
		$ginfo=$this->db->GetOne("select id,sid,qishu from `@#_shoplist` where `id`='$shaidan[shopid]' LIMIT 1");
		if(!$ginfo){
			_message("����Ʒ�Ѳ�����!");
		}
				
		if(isset($_POST['submit'])){		
	
			
			if($_POST['title']==null)_message("���ⲻ��Ϊ��");	
			if($_POST['content']==null)_message("���ݲ���Ϊ��");	
			if(!isset($_POST['fileurl_tmp'])){
				_message("ͼƬ����Ϊ��");
			}
			System::load_sys_class('upload','sys','no');
			$img=$_POST['fileurl_tmp'];
			$num=count($img);
			$pic="";
			for($i=0;$i<$num;$i++){
				$pic.=trim($img[$i]).";";
			}
			
			$src=trim($img[0]);
			
			if(!file_exists(G_UPLOAD.$src)){
					_message("ɹ��ͼƬ����ȷ");
			}
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
			$sd_thumbs = $thumbs;
			$sd_content = $_POST['content'];
			$sd_photolist= $pic;
			$sd_time=time();		
			$sd_ip = _get_ip_dizhi();			
			$this->db->Query("INSERT INTO `@#_shaidan`(`sd_userid`,`sd_shopid`,`sd_shopsid`,`sd_qishu`,`sd_ip`,`sd_title`,`sd_thumbs`,`sd_content`,`sd_photolist`,`sd_time`)VALUES
			('$sd_userid','$sd_shopid','$sd_shopsid','$sd_qishu','$sd_ip','$sd_title','$sd_thumbs','$sd_content','$sd_photolist','$sd_time')");
			_message("ɹ������ɹ�",WEB_PATH."/member/home/singlelist");
		}		
		
		include templates("member","singleinsert");
	}
	
	//�༭
	public function singleupdate(){
		_message("���ɱ༭!");
		if(isset($_POST['submit'])){
			System::load_sys_class('upload','sys','no');
			if($_POST['title']==null)_message("���ⲻ��Ϊ��");	
			if($_POST['content']==null)_message("���ݲ���Ϊ��");				
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
			_message("ɹ���޸ĳɹ�",WEB_PATH."/member/home/singlelist");
		}
		$member=$this->userinfo;
		$title="�޸�ɹ��";	
		$uid=_getcookie('uid');
		$ushell=_getcookie('ushell');
		$sd_id=intval($this->segment(4));
		if($sd_id>0){
			$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
			include templates("member","singleupdate");
		}else{
			_message("ҳ�����");
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
	
	//ɹ���ϴ�
	public function singphotoup(){
		
		if(!empty($_FILES)){
			/*
				����ʱ�䣺2014-04-28
				xu
			*/
			/*
			$uid=isset($_POST['uid']) ? $_POST['uid'] : NULL;		
			$ushell=isset($_POST['ushell']) ? $_POST['ushell'] : NULL;
			$login=$this->checkuser($uid,$ushell);
			if(!$login){echo "�ϴ�ʧ��";exit;}
			
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
	//ɹ��ɾ��
	public function shaidandel(){
		_message("����ӵ�ɹ������ɾ��!");
		$member=$this->userinfo;
		//$id=isset($_GET['id']) ? $_GET['id'] : "";
		$id=$this->segment(4);
		$id=intval($id);
		$shaidan=$this->db->Getone("select * from `@#_shaidan` where `sd_userid`='$member[uid]' and `sd_id`='$id'");
		if($shaidan){
			$this->db->Query("DELETE FROM `@#_shaidan` WHERE `sd_userid`='$member[uid]' and `sd_id`='$id'");
			_message("ɾ���ɹ�",WEB_PATH."/member/home/singlelist");
		}else{
			_message("ɾ��ʧ��",WEB_PATH."/member/home/singlelist");
		}
	}
	
			//�������
	public function invitefriends(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;		 
		//$uid=_getcookie('uid');		// ����
		$uid = $this->userinfo['uid'];	// ������
		$notinvolvednum=0;  //δ�μӾ۹�������
		$involvednum=0;     //�μ�Ԥ��������
		$involvedtotal=0;   //��������		 
		
       
        //��ѯ���������Ϣ		
		$invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$member[uid]' ORDER BY `time` DESC");	
		$involvedtotal=count($invifriends);
		
            
		//var_dump($invifriends);
                		
		for($i=0;$i<count($invifriends);$i++){
		   $sqluid=$invifriends[$i]['uid'];
		   $sqname=get_user_name($invifriends[$i]); 
		   $invifriends[$i]['sqlname']=	 $sqname;  
		   
		   //��ѯ������ѵ�������ϸ		   
		   $accounts[$sqluid]=$mysql_model->GetList("select * from `@#_member_account` where `uid`='$sqluid'  ORDER BY `time` DESC");	
          
		
		//�ж��ĸ�����������		
		 if(empty($accounts[$sqluid])){
		    $notinvolvednum +=1;
		    $records[$sqluid]='δ����۹�';
		 }else{
		    $involvednum +=1;
		    $records[$sqluid]='�Ѳ���۹�';
		 }
		
		
		}  
        		
		include templates("member","invitefriends");
	}
	
		//Ӷ����ϸ
	public function commissions(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$recodetotal=0;   // �ж��Ƿ�Ϊ��
		$shourutotal=0;
		$zhichutotal=0;
		
		$invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$member[uid]' ORDER BY `time` DESC");
		
		 
		  //��ѯӶ���
		  for($i=0;$i<count($invifriends);$i++){
			   $sqluid=$invifriends[$i]['uid'];
			   
			   //��ѯ������Ѹ��ҷ�����Ӷ��  
			   $recodes[$sqluid]=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$sqluid' and `type`=1 ORDER BY `time` DESC");
			   
			   $user[$sqluid]['username']=	get_user_name($invifriends[$i]);	   
				 
			}
		  //�Լ����ֻ��ֵ
		  $recodes[$uid]=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$uid' and `type`!=1 ORDER BY `time` DESC");
		  $user[$uid]['username']= get_user_name($member);
		  
		  
         $recodearr='';
		 $i=0;	
		 if(!empty($recodes)){
		 foreach($recodes as $key=>$val){
			$username[$key]=$user[$key]['username'];
			foreach($val as $key2=>$val2){
			  $recodearr[$i]=$val2;		  
			  $i++;  
			} 
		 }
		 }
		 
		 $recodetotal=count($recodes);
		 
		 
		 //��ѯ   �ۼ����룺Ԫ    �ۼ�(����/��ֵ)��Ԫ    Ӷ����Ԫ
		 
		 if(!empty($recodes)){
			 foreach($recodes as $key=>$val){
			  if($uid==$key){
			     foreach($val as $key2=>$val2){  		   
					 
					$zhichutotal+=$val2['money'];	 //��Ӷ��֧��		 
					 
				   }
			    }else{
				    foreach($val as $key3=>$val3){  		   
					 
					$shourutotal+=$val3['money'];	 //��Ӷ������		 
				   }
				
				}		
			  }
			     
		  }		  
		
		  
		 $total=$shourutotal-$zhichutotal;  //����Ӷ�����	 
		 			 
		include templates("member","commissions");
	}
	
	//��������
	public function cashout(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$total=0;
		$shourutotal=0;
		$zhichutotal=0;
		$cashoutdjtotal=0;
		$cashouthdtotal=0;
        //��ѯ�������id
    	$invifriends=$mysql_model->GetList("select * from `@#_member` where `yaoqing`='$member[uid]' ORDER BY `time` DESC");

		//��ѯӶ������
		for($i=0;$i<count($invifriends);$i++){
			   $sqluid=$invifriends[$i]['uid'];			   
			   //��ѯ������Ѹ��ҷ�����Ӷ��  
			   $recodes[$sqluid]=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$sqluid' and `type`=1 ORDER BY `time` DESC");			 
		}
		
		//��ѯӶ������(����,��ֵ)	
		$zhichu=$mysql_model->GetList("select * from `@#_member_recodes` where `uid`='$uid' and `type`!=1 ORDER BY `time` DESC");	
		  
		//��ѯ��������		  
		$cashoutdj=$mysql_model->GetOne("select SUM(money) as summoney  from `@#_member_cashout` where `uid`='$uid' and `auditstatus`!='1' ORDER BY `time` DESC");	
		
		 if(!empty($recodes)){
			 foreach($recodes as $key=>$val){
			    foreach($val as $key2=>$val2){					 
					$shourutotal+=$val2['money'];	 //��Ӷ������	 
				}
			 }		 
		 }		  
		 if(!empty($zhichu)){
			foreach($zhichu as $key=>$val3){  	   
				$zhichutotal+=$val3['money'];	//��֧����Ӷ��		  
			}
		 }  
	

		$total=$shourutotal-$zhichutotal;  //����Ӷ�����
		$cashoutdjtotal= $cashoutdj['summoney'];  //����Ӷ�����
		$cashouthdtotal= $total-$cashoutdj['summoney'];  //�Ӷ�����


       if(isset($_POST['submit1'])){ //����	     
		 $money      = abs(intval($_POST['money']));
		 $username   =htmlspecialchars($_POST['txtUserName']);
		 $bankname   =htmlspecialchars($_POST['txtBankName']);
		 $branch     =htmlspecialchars($_POST['txtSubBank']);
		 $banknumber =htmlspecialchars($_POST['txtBankNo']);
		 $linkphone  =htmlspecialchars($_POST['txtPhone']);
		 $time       =time();
		 $type       = -3;  //��ȡ1/����-1/��ֵ-2/����-3
		 
		 if($total<100){
		     _message("Ӷ�������100Ԫ�������֣�");exit;
		 }elseif($cashouthdtotal<$money){
		    _message("�������Ӷ���");exit;
		 }elseif($total<$money ){  
		     _message("��������Ӷ���");exit;
		 }else{
		 
		 //�������������  ���ﲻ����Ӷ����в����¼ �Ⱥ�̨��˲Ų���
		 $this->db->Query("INSERT INTO `@#_member_cashout`(`uid`,`money`,`username`,`bankname`,`branch`,`banknumber`,`linkphone`,`time`)VALUES
			('$uid','$money','$username','$bankname','$branch','$banknumber','$linkphone','$time')"); 
			_message("����ɹ�����ȴ���ˣ�");
		 }	   
	   }
	   
	   if(isset($_POST['submit2'])){//��ֵ			
		  $money      = abs(intval($_POST['txtCZMoney']));		
		  $type       = 1;
		  $pay        ="Ӷ��";
		  $time       =time();
		  $content    ="ʹ��Ӷ���ֵ���۹��˻�";
		  
		 if($money <= 0 || $money > $total){
			  _message("Ӷ�������벻��ȷ��");exit;
		 }	
		 if($cashouthdtotal<$money){
		    _message("�������Ӷ���");exit;
         }			
		  
		  //�����¼
		 $account=$this->db->Query("INSERT INTO `@#_member_account`(`uid`,`type`,`pay`,`content`,`money`,`time`)VALUES
			('$uid','$type','$pay','$content','$money','$time')");
		 
		 // ��ѯ�Ƿ��иü�¼
		 if($account){		    
			 //�޸�ʣ����
			 $leavemoney=$member['money']+$money;			 
			 $mrecode=$this->db->Query("UPDATE `@#_member` SET `money`='$leavemoney' WHERE `uid`='$uid' ");			 
			 //��Ӷ����в����¼		 
		     $recode=$this->db->Query("INSERT INTO `@#_member_recodes`(`uid`,`type`,`content`,`money`,`time`)VALUES
			('$uid','-2','$content','$money','$time')");
			_message("��ֵ�ɹ���");
		 }else{
		     _message("��ֵʧ�ܣ�");
		 }	
	   }
		include templates("member","cashout");
	}
	
	
	//���ּ�¼
	public function record(){
		$mysql_model=System::load_sys_class('model');
		$member=$this->userinfo;
		$uid = $member['uid'];
		$recount=0;
		$fufen = System::load_app_config("user_fufen",'','member');
		//��ѯ���ּ�¼	 
		//$recordarr=$mysql_model->GetList("select * from `@#_member_recodes` a left join `@#_member_cashout` b on a.cashoutid=b.id where a.`uid`='$uid' and a.`type`='-3' ORDER BY a.`time` DESC");		$recordarr=
		
		$recordarr=$mysql_model->GetList("select * from  `@#_member_cashout`  where `uid`='$uid' ORDER BY `time` DESC limit 0,30");
        
		if(!empty($recordarr)){
		  $recount=1;
		}		
		include templates("member","record");
	}
	//qq��
	public function qqclock(){
		$member=$this->userinfo;
		include templates("member","qqclock");
	}
}

?>