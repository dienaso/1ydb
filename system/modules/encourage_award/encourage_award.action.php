<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_class('admin',G_ADMIN_DIR,'no');
System::load_app_fun('global',G_ADMIN_DIR);

class encourage_award extends admin {	
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class("model");
		$this->ment=array(
						array("webcfg","鼓励奖设置",ROUTE_M.'/'.ROUTE_C."/eset"),
						array("config","奖励配置",ROUTE_M.'/'.ROUTE_C."/eupdate"),
						array("upload","领取情况",ROUTE_M.'/'.ROUTE_C."/elist"),
		);
	
	}
	
	public function eset(){ 
		$info_encourage=System::load_sys_config("encourage");	
		if(isset($_POST['encourage_awardset'])){		
		   $encourage_awardset=htmlspecialchars($_POST['encourage_awardset']);
		   		$html=<<<HTML
			<?php 
			return array (	
				'e_start' => '{$encourage_awardset}',	//是否开启
				'e_num' => '{$info_encourage['e_num']}',//数量（共有几个鼓励奖）
				'e_rule' => '{$info_encourage['e_rule']}',		//奖励计算规则
				'e_content' => '{$info_encourage['e_content']}',				//奖励内容
				'e_qzsp' => "{$info_encourage['e_qzsp']}",//商品限制
				'e_time' => "{$info_encourage['e_time']}",  		//设置此奖的时间
			);
			?>
HTML;
			if(!is_writable(G_CONFIG.'encourage.inc.php')) _message('Please chmod  encourage  to 0777 !');
			$ok=file_put_contents(G_CONFIG.'encourage.inc.php',$html);
			if($ok){
				_message("设置成功");
			}
		}else{
			$encourage_award=$info_encourage['e_start'];
			if(!isset($encourage_award)||empty($encourage_award)){
				$encourage_awardset='N';
			}else{
			    $encourage_awardset=$info_encourage['e_start'];
			}
		}
		include $this->tpl(ROUTE_M,'encourage_award.eset');
		
	
	}
	
	public function eupdate(){
		$info_encourage=System::load_sys_config("encourage");
		if(isset($_POST['submit'])){
	        $hideoption=$_POST['hideoption'];
			$ff_content=$_POST['ff_content'];
			$jb_content=$_POST['jb_content'];
			$qt_content=$_POST['qt_content'];			
			$shop_je=htmlspecialchars($_POST['shop_je']);
			// $hideoption=htmlspecialchars($_POST['hideoption']);
			// $ff_content=htmlspecialchars($_POST['ff_content']);
			// $jb_content=htmlspecialchars($_POST['jb_content']);
			// $qt_content=htmlspecialchars($_POST['qt_content']);
			// $shop_je=htmlspecialchars($_POST['shop_je']);
		 //保存鼓励奖表 
			 $e_content="";
			for($i=0;$i<count($hideoption);$i++){
				$m=$i+1;
				$optnum='option'.$m;
				$option[$i]=$_POST["$optnum"];		
				if(empty($option[$i][0])) _message("请选择奖励方式");		
				$str[$i]=($m+1).','.$option[$i][0].','.$ff_content[$i].','.$jb_content[$i].','.$qt_content[$i].'#';
				$e_content=$e_content.$str[$i];		
			}
			$e_rule="闪购码与一等奖（幸运码）的距离由近到远依次设置鼓励奖";
			$e_num=count($hideoption);
			$eadd_time=time();
			$html=<<<HTML
			<?php 
			return array (	
				'e_start' => '{$info_encourage['e_start']}',	//是否开启
				'e_num' => '{$e_num}',//数量（共有几个鼓励奖）
				'e_rule' => '{$e_rule}',		//奖励计算规则
				'e_content' => '{$e_content}',				//奖励内容
				'e_qzsp' => "{$shop_je}", //商品价格限制
				'e_time' => "{$eadd_time}",  		//设置此奖的时间
			);
			?>
HTML;
			if(!is_writable(G_CONFIG.'encourage.inc.php')) _message('Please chmod  encourage  to 0777 !');
			$ok=file_put_contents(G_CONFIG.'encourage.inc.php',$html);
			if($ok){
				_message("设置成功");
			}else{
				_message("添加失败");
				}
		}
		else{
            $info_encourage=System::load_sys_config("encourage");
			$infoe_content=explode('#',$info_encourage['e_content']);
			// echo "<pre/>";
			// print_r($infoe_content);
			foreach($infoe_content as $key=>$v){			
			$infoe_content1=explode(',',$infoe_content[$key]);
			// echo "<pre/>";
			// print_r($infoe_content1);
			}
			
		} 				 			
	    include $this->tpl(ROUTE_M,'encourage_award.eupdate');

	}
	public function elist(){  
	    $eshow=$this->db->GetList("select * from `@#_encourage_award` where `e_get`='N' ");
		include $this->tpl(ROUTE_M,'encourage_award.elist');

	}
	
}//

?>