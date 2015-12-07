<?php

function add_count($uid, $db){
	if (isset($uid) == false) {
		exit();
	}

	$has = $db->GetOne("SELECT * FROM `@#_qzone` WHERE `uid`=". $uid);
	if ($has) {
		$data['code'] = 404;
		$data['msg'] = '您已经领取过奖励了';
		return $data;
	}

	$count_config = $db->GetOne("SELECT * FROM `@#_qzone_config`");
	if ($count_config) {
		$award_name = $count_config['award_name'];
		$award_count = $count_config['award_count'];
		$field = $count_config['field'];
		$sql = "UPDATE `@#_member` SET `". $field ."`=". $field ." + ". $award_count ." WHERE `uid`='". $uid ."'";
		$db->Query($sql);
		if($db->affected_rows()){
			$sql = "INSERT INTO `@#_qzone`(uid,award_name,award_count,addtime)VALUES('$uid','$award_name',$award_count,'". time() ."')";
			$db->Query($sql);
			$data['code'] = 200;
			$data['msg'] = '恭喜您,成功领取分享奖励：'. $award_name .'x'. $award_count .'！';
			return $data;
		}
	}
}

?>