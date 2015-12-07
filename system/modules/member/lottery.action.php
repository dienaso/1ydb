<?php
defined('G_IN_SYSTEM')or exit('No permission resources.');
System::load_app_fun('user','go');
System::load_sys_fun("user");

class lottery extends SystemAction {
	private $db;
	private $userinfo;
	private $prize = array();

	public function __construct(){
		#                      奖项     说明     红包价格   概率
		$this->prize[] = array('七等奖', '1元红包', 1,  array(800,1000) );
		$this->prize[] = array('六等奖', '2元红包', 2, array(180,1000) );
		$this->prize[] = array('五等奖', '3元红包', 3, array(10,1000) );
		$this->prize[] = array('四等奖', '4元红包', 4, array(7,1000) );
		$this->prize[] = array('三等奖', '6元红包', 6, array(2,1000) );
		$this->prize[] = array('二等奖', '8元红包', 8, array(1,1000) );
		$this->prize[] = array('一等奖', '10元红包', 10, array(0,0) );


		$this->db = System::load_sys_class("model");
		$this->userinfo = System::load_app_class('base','member')->get_user_info();
	}

	public function init() {
		$LotteryList = $this->db->Getlist("SELECT * FROM `@#_activity_lottery` ORDER BY id DESC LIMIT 100");
		include templates(ROUTE_M, "lottery_index");
	}

	public function submit() {
		function _return($ok, $desc, $round = 0, $left=0) {
			$data = array();
			$data['ok'] = $ok;
			$data['desc'] = $desc;
			$data['round'] = $round;
			$data['left'] = $left;
			echo json_encode($data);
			die;
		}
		if ( !$this->userinfo ) {
			_return(false,'您还没有登陆，无法参与抽奖哦');
		} else if ( $this->userinfo['score'] <= 1000 ) {
			_return(false,'抱歉，您的抽奖次数用完了。');
		}

		$p = $this->probability();
		if ( $p == -1 ) {
			_return(true, '哎呀，姿势不对吧，竟然没中奖！', -1);
		} else {
			list($title,$desc,$money) = $this->prize[$p];
			$round = $this->round($p);
			$left = $this->userinfo['score'] -1000;

			$this->db->Query("UPDATE `@#_member` SET score = score - 1000,`money` = `money` + $money where (`uid` = '".$this->userinfo['uid']."')");
			$this->db->Query("INSERT INTO `@#_activity_lottery`(uid,prize,money,time,title,`desc`)VALUES('".$this->userinfo['uid']."','$p','$money','".time()."','{$title}','{$desc}')");
			$this->db->Query("INSERT INTO `@#_member_account` (`uid`, `type`, `pay`, `content`, `money`, `time`) VALUES ('".$this->userinfo['uid']."', '1', '账户', '大转盘抽奖[{$title}]红包', '$money', '".time()."')");

			_return(true, '恭喜'.$desc."已到账！", $round, $left);
		}

	}

	# 获取范围
	private function round($p) {
		$width = 360 / 7;
		$a = $p * $width;
		$b = $a + $width;
		return mt_rand($a + 10 ,$b - 10);
	}

	# 随机一个概率出来
	private function probability() {
		//return rand(0,6);
		$probability_all = array(0,0);
		foreach($this->prize as $i=>$val) {
			list($title,$desc,$money,$probability) = $val;
			$probability_all[0] += $probability[0];
			$probability_all[1] += $probability[1];
		}
		if ( empty($this->prize) ) {
			return -1;
		}


		$probability_all[1] = intval($probability_all[1] / count($this->prize));

		$yes = mt_rand(1,$probability_all[1]);

		$prize = -1;
		if ( $probability_all[0] <= 0 || $probability_all[1] <= 0 || $yes > $probability_all[0] ) {
		} else {
			$list = array();
			$add = 0;
			$total = 0;
			foreach($this->prize as $i=>$val) {
				list($title,$desc,$money,$probability) = $val;
				if ( $probability[0] <= 0 ) {
					continue;
				}
				$total = $add += $probability[0];
				$list[$add] = $i;
			}

			$yes = mt_rand(1,$total);
			foreach ($list as $k => $v) {
				if ( $yes <= $k ) {
					$prize = $v;
					break;
				}
			}
		}
		return $prize;
	}
}
