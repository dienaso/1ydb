<?php
header('Content-type: text/html; charset=gb2312');
// ֧������Ǯ�˻�
$optemail = 'yyygkf@126.com';
$cellphone = '';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>֧��������֧��</title>
</head>
<body>
<form id="alipaysubmit" action="https://shenghuo.alipay.com/send/payment/fill.htm" method="post">
<input name="title" type="hidden" value="<?php echo $out_trade_no;?>" />
<input name="optEmail" type="hidden" value="<?php echo $optemail;?>" />
<input name="payAmount" type="hidden" value="<?php echo $total_fee;?>" />
<input name="cellphone" type="hidden" value="<?php echo $cellphone;?>" />
<input name="memo" type="hidden" value="һԪ�۹���ʾ��
�벻Ҫ�޸ġ���� �� ����˵����,����ʵ�ֲ����Զ����ˣ�" />
<input name="ok" type="submit" value="���ڴ�����" />
</form>
<script>document.forms['alipaysubmit'].submit();</script>
</body>
</html>