<?php
// +----------------------------------------------------------------------
// | Fanwe 方维众筹商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class weixin
{
	//微信APPID
   	var $app_id="";
    //微信秘钥
    var $app_secret="";
    //跳转链接
    var $redirect_url="";
    //传递的方式
    var $scope="";
    var $state=1;
    //用户同意授权，获取code
    var $code="";
    //授权通过后获取access_token  openid
    var $access_token="";
    var $openid="";
    function __construct($app_id="",$app_secret="",$redirect_url="",$scope="snsapi_userinfo",$state=1)
    {
        $this->app_id=$app_id;
        $this->app_secret=$app_secret;
        $this->redirect_url=urlencode($redirect_url);
        $this->scope=$scope;
        $this->state=$state;
    }
    public function scope_get_code(){
    	 $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->app_id."&redirect_uri=".$this->redirect_url."&response_type=code&scope=".$this->scope."&state=".$this->state."#wechat_redirect";
    	 return $url;
    }
    public function scope_get_userinfo($code){
    	require_once S_ROOT."transport.php";
    	$tran = new transport();
    	$this->code=$code;
    	$get_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->app_id."&secret=".$this->app_secret."&code=".$this->code."&grant_type=authorization_code";
       	$token_info=$this->https_request($get_token_url);

     	$token_info=json_decode($token_info['body'],true);
     	$this->access_token=$token_info['access_token'];
    	$this->openid=$token_info['openid'];
     	$get_userinfo="https://api.weixin.qq.com/sns/userinfo?access_token=".$this->access_token."&openid=".$this->openid."&lang=zh_CN";
    	$user_info=$this->https_request($get_userinfo);
     	$user_info=json_decode($user_info['body'],true);
    	return $user_info;
    }
    public function https_request($url){
    	$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
		$http_response = curl_exec($curl);
		 if (curl_errno($curl) != 0)
        {
            return false;
        }

        $separator = '/\r\n\r\n|\n\n|\r\r/';
        list($http_header, $http_body) = preg_split($separator, $http_response, 2);

        $http_response = array('header' => $http_header,//肯定有值
                               'body'   => $http_body); //可能为空
		curl_close($curl);
		return $http_response;
    }
}

?>