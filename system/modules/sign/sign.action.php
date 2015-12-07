<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');

System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');

class sign extends base {
	public function __construct(){
		parent::__construct();
		$this->db = system::load_sys_class("model");
	}

	public function init(){

	}

	public function sign_init(){
		$data['people'] = $this->db->GetNum("SELECT uid FROM `@#_sign` where DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
		//$data['people'] = $this->db->GetNum("SELECT DISTINCT uid FROM `@#_sign` where DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
		$data['count'] = $this->db->GetNum("SELECT id FROM `@#_sign` where DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m') = DATE_FORMAT(NOW(),'%Y-%m')");
		$member = $this->userinfo;
		$data['mycount'] = 0;
		// print_r($member);
		if ($member) {
			$data['mycount'] = $this->db->GetNum("SELECT id FROM `@#_sign` where uid = ".$member['uid']." and DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m') = DATE_FORMAT(NOW(),'%Y-%m')");
		}
		echo json_encode($data);
	}

	public function sign_today(){
		$member = $this->userinfo;
		if ($member) {
			$today = $this->db->GetOne("SELECT id FROM `@#_sign` where uid = ".$member['uid']." and DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
			if ($today) {
				$data['code'] = '403';
				$data['msg'] = '您今日已经签到过了！';

				echo json_encode($data);
				exit();
			}

			$my_all = $this->db->GetNum("SELECT id FROM `@#_sign` where uid = ".$member['uid']." and DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m') = DATE_FORMAT(NOW(),'%Y-%m')");
			if ($my_all >= 28) {
				$data['code'] = '402';
				$data['msg'] = '您本月已无可用签到次数！';

				echo json_encode($data);
				exit();
			}

			// 随机签到奖励
			$award_arr = $this->db->Getlist("SELECT * FROM `@#_sign_award`");
			
			foreach ($award_arr as $key => $val) { 
				$arr[$val['id']] = $val['jilv']; 
			} 
			 
			$rid = $this->get_rand($arr); //根据概率获取奖项id 
			
			foreach ($award_arr as $key => $val) { 
				if ($val['id'] == $rid){
					$res['yes'][0] = $award_arr[$key]['text']; //中奖项 
					$res['yes'][1] = $award_arr[$key]['count'];
					$res['yes'][2] = $award_arr[$key]['field'];
					break;
				}
			}
			
			if ($res['yes']) {
				$this->db->Query("INSERT INTO `@#_sign`(uid,award,count,addtime)VALUES('$member[uid]','". $res['yes']['0']."',".$res['yes'][1].",".time().")");
				if($this->db->affected_rows()){
					$sql = "UPDATE `@#_member` SET `". $res['yes'][2] ."`=". $res['yes'][2] ." + ". $res['yes'][1] ." WHERE `uid`='". $member[uid] ."'";
					$this->db->Query($sql);
					$data['people'] = $this->db->GetNum("SELECT uid FROM `@#_sign` where DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
					$data['count'] = $this->db->GetNum("SELECT id FROM `@#_sign` where DATE_FORMAT(FROM_UNIXTIME(addtime),'%Y-%m') = DATE_FORMAT(NOW(),'%Y-%m')");
					$data['code'] = '200';
					$data['msg'] = '签到成功，获得'. $res['yes'][0] .' ： '. $res['yes'][1] .'！';
				}else{
					$data['code'] = '402';
					$data['msg'] = '签到失败，请重试！';
				}
			} else {
				$this->sign_today();
				exit();
			}
		} else {
			$data['code'] = '404';
			$data['msg'] = '请登录后再签到！';
		}

		echo json_encode($data);
		exit();
	}

	public function get_rand($proArr) { 
		$result = '';
	 
		$proSum = array_sum($proArr);
	 
		foreach ($proArr as $key => $proCur) { 
			$randNum = mt_rand(1, $proSum); 
			if ($randNum <= $proCur) { 
				$result = $key; 
				break; 
			} else { 
				$proSum -= $proCur; 
			} 
		}

		return $result; 
	}
}
?>