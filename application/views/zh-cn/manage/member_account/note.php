<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/css/manage/style.css"/>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript">
$(function(){
	var code = "<?php echo (isset($code))?$code:"";?>";
	var new_url="<?php echo (isset($new_url))?$new_url:"";?>";
	if(code == 9999)
	{
		alert('修改成功');
		
	}else
	{
		alert('修改失败');
	}
	window.parent.location.href=new_url;
	//window.parent.search_member_account.submit();
})
</script>
</head>
<body>
<div class="p5">
</div>
</body>
</html>
