<html>
<head>
<title>To EkePay Page</title>
</head>
<body onLoad="document.ekepay.submit();">
<form name='ekepay' action='<?php echo $reqURL_onLine; ?>' method='post'>
<input type='hidden' name='type'					value='<?php echo $cardType; ?>'>
<input type='hidden' name='parter'				value='<?php echo $eka_merchant_id; ?>'>
<input type='hidden' name='cardno'				value='<?php echo $card_number; ?>'>
<input type='hidden' name='cardpwd'					value='<?php echo $card_password; ?>'>
<input type='hidden' name='value'					value='<?php echo $amount; ?>'>
<input type='hidden' name='restrict'					value='<?php echo $eka_restrict; ?>'>
<input type='hidden' name='orderid'					value='<?php echo $order_id; ?>'>
<input type='hidden' name='callbackurl'				value='<?php echo $eka_callback_url; ?>'>
<input type='hidden' name='sign'					value='<?php echo $sign; ?>'>
<input type='hidden' name='attach'					value=''>
</form>
</body>
</html>