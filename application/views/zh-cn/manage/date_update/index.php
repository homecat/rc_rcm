<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/datePicker/WdatePicker.js"></script>
</head>
<body>
<div class="p5">
    <div class="position"><b>首页</b> - 数据修改</div>
	<table style="min-width:985px;width:100%;" cellspacing="0" class="toolbar">
		<tr>
			<td height="20"></td>
		</tr>
	</table>
    <form action="<?php echo site_url('manage/date_update/update')?>" method="post"> <br />
        <label for=""><input type="text" value="" name="oldsaid" /> 旧 格式（负责人/销售团队id）</label><br/><br />
        <label for="">
            <input type="text"id="fileBrowser" name="fileBrowser" size="30" />客户id批量修改
            <iframe src="<?php echo site_url('tools/upload/form/file/fileBrowser');?>" frameborder="0" width="300" height="24"></iframe>
        </label><br/><br />
        <label for=""><input type="text" value="" name="newsaid" /> 新 格式（负责人/销售团队id）</label><br/><br />
        <label for="">s1<input type="checkbox" name="member_status[]" value="Stage1"></label>
        <label for="">s2<input type="checkbox" name="member_status[]" value="Stage2"></label>
        <label for="">s3<input type="checkbox" name="member_status[]" value="Stage3"></label>
        <label for="">s4<input type="checkbox" name="member_status[]" value="Stage4"></label>
        <label for="">s5<input type="checkbox" name="member_status[]" value="Stage5"></label><br />
        <input type="submit" name="sub" value="修改" />
    </form>
</div>
</body>
</html>