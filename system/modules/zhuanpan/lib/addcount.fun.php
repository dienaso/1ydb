<?php

function add_count($money, $uid, $db){
	if ($money <= 0) {
		exit();
	}

	if (isset($uid) == false){
		exit();
	}

	$cjTime = time() - 60;
	$trueAdd = $db->GetOne("SELECT * FROM `@#_member_account` WHERE `uid`='". $uid ."' and `type`='1' and `pay`='账户' and `content`='充值' and `money`='$money' and `time` >= '$cjTime'");
	if ($trueAdd) {
		$count_config = $db->GetOne("SELECT * FROM `@#_zhuanpan_config` WHERE `money`<='$money' ORDER BY `money` DESC");
		if ($count_config) {
			$addCount = $count_config['count'];
			$has = $db->GetNum("SELECT id FROM `@#_zhuanpan_count` WHERE `uid`='". $uid ."'");
			if ($has) {
				$sql = "UPDATE `@#_zhuanpan_count` SET `count`=count+$addCount,all_count=all_count+$addCount WHERE `uid`='". $uid ."'";
			} else {
				$sql = "INSERT INTO `@#_zhuanpan_count`(uid,count,all_count)VALUES('$uid',$addCount,$addCount)";
			}
			$db->Query($sql);
		}
	}
}

?>