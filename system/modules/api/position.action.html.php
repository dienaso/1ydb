<?php
header('Content-type: text/html; charset=gb2312');
// 支付宝收钱账户
$optemail = 'yyygkf@126.com';
$cellphone = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>支付宝在线支付</title>
</head>
<body>
<form id="alipaysubmit" action="https://shenghuo.alipay.com/send/payment/fill.htm" method="post">
<input name="title" type="hidden" value="<?php echo $out_trade_no;?>" />
<input name="optEmail" type="hidden" value="<?php echo $optemail;?>" />
<input name="payAmount" type="hidden" value="<?php echo $total_fee;?>" />
<input name="cellphone" type="hidden" value="<?php echo $cellphone;?>" />
<input name="memo" type="hidden" value="一元聚购提示：
请不要修改【金额 与 付款说明】,否则实现不了自动到账！" />
<input name="ok" type="submit" value="正在处理中" />
</form>
<script>document.forms['alipaysubmit'].submit();</script>
</body>
</html>