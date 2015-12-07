<?php 
defined('G_IN_SYSTEM')or exit('No permission resources.');

System::load_app_class('base','member','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_app_fun('addcount','zhuanpan');


class zhuanpan extends base {
	public function __construct(){
		parent::__construct();
		$this->db = system::load_sys_class("model");
	}

	public function init(){
		$zhuanpan_arr = $this->db->Getlist("SELECT a.*,b.username,b.email,b.mobile FROM `@#_zhuanpan` a LEFT JOIN `@#_member` b ON a.uid=b.uid ORDER BY id DESC");
		foreach ($zhuanpan_arr as $key => $val) {
			$zhuanpan_arr[$key]['mobile'] = substr_replace($zhuanpan_arr[$key]['mobile'], '*****', 3, 5);
			$email_arr = explode('@', $zhuanpan_arr[$key]['email']);
			$emailCount = mb_strlen($email_arr[0]);
			if ($emailCount <= 3) {
				$email_arr[0] = substr($email_arr[0], 0, 1) . '***';
			} else {
				$email_arr[0] = str_replace(substr($email_arr[0], -3, 3), '***', $email_arr[0]);
			}
			$zhuanpan_arr[$key]['email'] = $email_arr[0] . '@' . $email_arr[1];
		}
		echo json_encode($zhuanpan_arr);
	}

	public function get_award(){
		$member = $this->userinfo;
		if ($member) {
			$my_all = $this->db->GetOne("SELECT * FROM `@#_zhuanpan_count` where uid = ".$member['uid']);
			if ($my_all['count'] <= 0) {
				$data['code'] = '402';
				$data['msg'] = '您已无可用抽奖次数！';

				echo json_encode($data);
				exit();
			}

			// 随机抽奖奖励
			$award_arr = $this->db->Getlist("SELECT * FROM `@#_zhuanpan_award`");
			
			foreach ($award_arr as $key => $val) { 
				$arr[$val['id']] = $val['jilv']; 
			} 
			 
			$rid = $this->get_rand($arr); //根据概率获取奖项id 
			
			foreach ($award_arr as $key => $val) { 
				if ($val['id'] == $rid){
					$res['yes'][0] = $award_arr[$key]['text']; //中奖项 
					$res['yes'][1] = $award_arr[$key]['award_name'];
					$res['yes'][2] = $award_arr[$key]['award_count'];
					$res['yes'][3] = $award_arr[$key]['field'];
					$res['yes'][4] = $award_arr[$key]['min'];
					$res['yes'][5] = $award_arr[$key]['max'];
					$res['yes'][6] = $val['id'];
					break;
				}
			}
			
			if ($res['yes']) {
				$this->db->Query("INSERT INTO `@#_zhuanpan`(uid,award_text,award_name,award_count,addtime)VALUES('$member[uid]','". $res['yes'][0]."','".$res['yes'][1]."',".$res['yes'][2].",".time().")");
				if($this->db->affected_rows()){
					$sql = "UPDATE `@#_zhuanpan_count` SET `count`=count-1 WHERE `uid`='". $member[uid] ."'";
					$this->db->Query($sql);
					$sql = "UPDATE `@#_member` SET `". $res['yes'][3] ."`=". $res['yes'][3] ." + ". $res['yes'][2] ." WHERE `uid`='". $member[uid] ."'";
					$this->db->Query($sql);
					$data['code'] = '200';
					$data['msg'] = '恭喜您，抽中'. $res['yes'][0] .'，获得'. $res['yes'][1] .' : '. $res['yes'][2] .'！';

					$min = $res['yes'][4];
					$max = $res['yes'][5];
					if($res['yes'][6] == 7){ //七等奖
						$min = array(32,92,152,212,272,332);
						$max = array(58,118,178,238,298,358);
						$i = mt_rand(0,5);
						$data['angle'] = mt_rand($min[$i],$max[$i]); 
					}else{ 
						$data['angle'] = mt_rand($min,$max); //随机生成一个角度 
					} 
				}else{
					$data['code'] = '402';
					$data['msg'] = '抽奖失败，请重试！';
				}
			} else {
				$this->get_award();
				exit();
			}
		} else {
			$data['code'] = '404';
			$data['msg'] = '请登录后再抽奖！';
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

	public function add_count(){
		// $member = $this->userinfo;
		// add_count(101, $member['uid'], $this->db);
	}
}
?>