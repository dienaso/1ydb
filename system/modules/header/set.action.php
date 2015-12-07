<?php 
defined('G_IN_SYSTEM')or exit('no');
System::load_app_fun('global',G_ADMIN_DIR);
System::load_app_class("admin",G_ADMIN_DIR,"no");
class set extends admin {
	private $db;
	private $categorys;
	private $pay;
	private $autodir = "header";#模块文件名
	public function __construct(){	
		$this->db = System::load_sys_class("model");
		$this->categorys=$this->db->GetList("SELECT * FROM `@#_category` WHERE 1 order by `parentid` ASC,`cateid` ASC",array('key'=>'cateid'));	
		$this->pay = System::load_app_class("pay","pay");
	}
	#操作界面显示
	public function index(){
	
		parent::__construct();
		$this->db=System::load_sys_class('model');
		$html_type =$this->db->GetList("select * from `@#_header`");	
		if(isset($_POST['dosubmit'])){
			$m_reg_temp = $_POST['html'];
			
			$q_1 = $this->db->Query("UPDATE `@#_header` SET `html`='$m_reg_temp'");
			
			if($q_1){
				_message("更新成功！");
			}else{
				_message("更新失败！");
			}
		}
		
		
		

			include $this->tpl($this->autodir,'set');
	}
	
	
}
?>