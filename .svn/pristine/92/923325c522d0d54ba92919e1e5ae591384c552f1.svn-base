<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>上传文件</title>
<style>body{padding:0;margin:0;font-size:12px;}.red{color:red;}</style>
</head>
<body>
<?php if($code==9000):?>
<script language="javascript">
	var path = window.parent.document.getElementById("<?php echo $id;?>");
	if(path) path.value = "<?php echo $file_url.$file_name;?>";
</script>
<input type="button" value="重新上传" onClick="location.href='<?php echo $url;?>';"/> <span class="red">上传成功</span>
<?php else: ?>
<input type="button" value="重新上传" onClick="location.href='<?php echo $url;?>';"/> <span class="red">上传失败</span>
<?php endif; ?>
</body>
</html>