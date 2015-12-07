<?php 

class wapekepay {
 
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
			_message("点卡提交成功，验证成功后会进入您的账号中，返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}else if((string)$output['opstate']=="1"){	
			_message("订单Id无效，返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}else if((string)$output['opstate']=="2"){	
			_message("签名错误，请联系客服，返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}else if((string)$output['opstate']=="3"){	
			_message("请求参数无效，请联系客服，返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}else if((string)$output['opstate']=="-1"){	
			_message("对不起，您的卡号或密码错误，无法完成支付！返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}else if((string)$output['opstate']=="-2"){	
			_message("卡实际面值和提交时面值不符，卡内实际面值未使用！返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}else if((string)$output['opstate']=="-3"){	
			_message("卡实际面值和提交时面值不符，卡内实际面值已使用！返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}
		else if((string)$output['opstate']=="-4"){	
			_message("对不起，您的卡已经被使用，无法完成支付！返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}else {	
			_message("您的卡正在处理中，请稍等！返回点卡充值页面...",WEB_PATH.'/member/home/waprechargedk');
			
		}
			
			

			ob_end_flush();
			exit;
	
	}

 }

?>