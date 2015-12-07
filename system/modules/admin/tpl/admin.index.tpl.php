<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>极光系统管理后台</title>
</head>
<frameset rows="50,*,1" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="<?php echo G_MODULE_PATH; ?>/yunwei/webtongji" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset rows="*" cols="215,*" framespacing="0" frameborder="no" border="0">
    <frame src="<?php echo G_ADMIN_PATH; ?>/yunwei/websubmit" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="<?php echo G_ADMIN_PATH; ?>/index/Tdefault" name="mainFrame" id="mainFrame" title="mainFrame" />
  </frameset>
  <frame src="UntitledFrame-8">
</frameset>
<noframes><body>
</body></noframes>
</html>
