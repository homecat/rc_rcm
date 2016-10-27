<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>上传文件</title>
<style>body{padding:0;margin:0;font-size:12px;}.red{color:red;}</style>
</head>
<body>
<form action="<?php echo $url;?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="image" id="image"/>
	<input type="file" name="file" size="10"/><input type="submit" value="上传" onclick="note()"/> <span class="red" id="load" style="display:none;">上传中...</span>
</form>
<script type="text/javascript">
	document.getElementById('image').value = window.parent.document.getElementById('<?php echo $id;?>').value;
	function note(){document.getElementById('load').style.display="";}
</script>
</body>
</html>
