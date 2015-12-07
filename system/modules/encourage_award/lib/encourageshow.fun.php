<?php 
    
			
	//领取鼓励奖奖品
	function encourageshow($memberid){
	 $db = System::load_sys_class("model");
	 $eshow=$db->GetList("select * from `@#_encourage_award` where `user_id`='$memberid'");
	 return $eshow;
	}

?>