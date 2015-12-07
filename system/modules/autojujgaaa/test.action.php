<?php 

class test{

	function  aa(){
		ignore_user_abort();
		set_time_limit(0);
		//echo "aaa";
		echo  date("Y-m-d H:i:s",time());
		echo "<br/>";
		flush();
		usleep(10000000);
		echo  date("Y-m-d H:i:s",time());
		
	}

}

?>