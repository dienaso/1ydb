<?php 

class ekepay {
 
	private $config;
	/**
	*	支付入口
	**/
	
	public function config($config=null){
			$this->config = $config;
	}
	
	public function send_pay(){
			$config = $this->config;

			
			$reqURL_onLine = "http://pay.yikaduixian.com/cardReceive.aspx";				 //产品通用接口请求地址

						
			$eka_merchant_id		=  $config['id'];
			$eka_merchant_key		=  $config['key'];	//hc6NOTDETVQe9Lgr	
			$eka_restrict			=  $config['restrict'];
			$eka_callback_url		=  $config['NotifyUrl'];
			$cardType 				= $config['cardType'];   //卡类型
			$card_number			= $config['card_number'];  //卡号
			$card_password 			= $config['card_password'];  //卡密
			$order_id = $config['code'];
			$amount = $config['money'];
		
			
		
			
		

			//调用签名函数生成签名串
			
			iconv_set_encoding("internal_encoding", "UTF-8");
			iconv_set_encoding("output_encoding", "GBK");
			// 开始缓存
			ob_start("ob_iconv_handler");
		
					
			$mid5key = "type=".$cardType."&parter=".$eka_merchant_id."&cardno=".$card_number."&cardpwd=".$card_password ."&value=".$amount."&restrict=".$eka_restrict."&orderid=".$order_id."&callbackurl=".$eka_callback_url;
			$sign=md5($mid5key.$eka_merchant_key);	

			
			$url	= $reqURL_onLine . "?" . $mid5key . "&sign=" .$sign;
				
			$result=file_get_contents($url);
			parse_str($result, $output);
			iconv_set_encoding("output_encoding", "UTF-8");	
			if((string)$output['opstate']=="0"){
				echo"<script>alert('点卡提交成功,验证成功会自动到账！');history.go(-1);</script>"; 
			
		}else if((string)$output['opstate']=="1"){	
			echo"<script>alert('订单Id无效！');history.go(-1);</script>"; 
			
			
		}else if((string)$output['opstate']=="2"){	
			echo"<script>alert('签名错误，请联系客服！');history.go(-1);</script>"; 
			
			
		}else if((string)$output['opstate']=="3"){
			echo"<script>alert('请求参数无效，请联系客服！');history.go(-1);</script>"; 

			
		}else if((string)$output['opstate']=="-1"){	
			 echo"<script>alert('对不起，您的卡号或密码错误!！');history.go(-1);</script>"; 

		}else if((string)$output['opstate']=="-2"){	
			echo"<script>alert('卡实际面值和提交时面值不符！');history.go(-1);</script>"; 
			
			
		}else if((string)$output['opstate']=="-3"){	
			echo"<script>alert('卡实际面值和提交时面值不符！');history.go(-1);</script>"; 
			
			
		}
		else if((string)$output['opstate']=="-4"){	
			echo"<script>alert('对不起，您的卡已经被使用！');history.go(-1);</script>"; 
			
		}else {	
			echo"<script>alert('您的卡正在处理中，请稍等！');history.go(-1);</script>"; 
			
			
		}
			
			

			ob_end_flush();
			exit;
	
	}

 }

?>