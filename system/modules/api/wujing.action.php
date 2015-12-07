<?php 

class wujing extends SystemAction {	

		public function getTotal() {
			$mysql_model=System::load_sys_class('model');
			$recordx = $mysql_model->GetOne("select * from `@#_caches` where `key` = 'goods_count_num'");
			echo $recordx['value']+1000000;
		}

}

?>