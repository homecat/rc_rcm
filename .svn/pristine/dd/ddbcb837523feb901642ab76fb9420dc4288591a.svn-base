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
    <div class="position"><b>首页</b> - 交易记录导入</div>
	<table style="min-width:985px;width:100%;" cellspacing="0" class="toolbar">
		<tr>
			<td height="20"></td>
		</tr>
	</table>
   
    <form method="post" action="<?php echo site_url('manage/importrade/submit/1');?>" enctype="multipart/form-data">
        <div class="searchbox" style="min-width:975px;">
            <table cellspacing="0">
                <tr>
                    <td>csv文件：</td>
                    <td><input type="text"id="fileBrowser" name="fileBrowser" size="50" /></td>
                    <td>
                    <iframe src="<?php echo site_url('tools/upload/form/file/fileBrowser');?>" frameborder="0" width="300" height="24"></iframe></td>
					<td><input name="sub" type="submit" value="提交" /><span class="red"><?php 
						if(isset($info)&&$info=='1')
						{
							echo '导入成功';
						}elseif(isset($info)&&$info=='2')
						{ 
							echo "未知错误";//"第{$row}条之后未能成功导入，请删除csv中第{$row}条之前的数据重新导入";
						} 
						elseif(isset($info)&&$info=='3')
						{ 
							echo "第{$row}条数据账号不存在，请删除csv中第{$row}条(包括第{$row}条)之前的数据重新导入";
						}
					?></span></td>
                </tr>
            </table>
        </div>
    </form>

    <form method="post" action="<?php echo site_url('manage/importrade/submit/2');?>" enctype="multipart/form-data">
        <div class="searchbox" style="min-width:975px;">
            <table cellspacing="0">
                <tr>
                    <td>csv文件(导入客户信息)：</td>
                    <td><input type="text"id="fileBrowser1" name="fileBrowser1" size="50" /></td>
                    <td>
                    <iframe src="<?php echo site_url('tools/upload/form/file/fileBrowser1');?>" frameborder="0" width="300" height="24"></iframe></td>
					<td><input name="sub" type="submit" value="提交" /><span class="red">

						<?php if(isset($row)&&$row=='a'){
								echo '请上传文件';
							}elseif(isset($row)&&$row){
								echo $row."条数据上传成功";
								}
						?>
					</span></td>
                </tr>
            </table>
        </div>
    </form>
</div>
</body>
</html>