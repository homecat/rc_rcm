<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="p5">
	<div class="position"><b>首页</b> - 修改密码</div>
	<div class="toolbar"><input type="button" value="返回" onclick="location.href='<?php echo site_url('manage/user_list')?>'" /></div>
	<div class="errorbox red"><?php if($code==1001) echo "旧密码错误"; elseif($code==9000) echo "修改成功";?></div>
	<form method="post">
	<table width="100%" cellspacing="0" cellpadding="5">
		<tbody class="itemlist">
			<tr>
				<td width="150">用户名<span class="red">*</span></td>
				<td><input type="text" name="user_name" disabled="disabled" value="<?php echo set_value('user_name',$row['user_name']);?>" size="40"/>
					<?php echo form_error('name');?></td>
			</tr>
			<tr>
				<td>旧密码 <span class="red">*</span></td>
				<td><input type="password" name="password_old" size="40"/>
					<?php echo form_error('password_old'); ?></td>
			</tr>
			<tr>
				<td>新密码 <span class="red">*</span></td>
				<td><input type="password" name="password_new" size="40"/>
					<?php echo form_error('password_new'); ?></td>
			</tr>
			<tr>
				<td>确认新密码 <span class="red">*</span></td>
				<td><input type="password" name="password_cfm" size="40"/>
					<?php echo form_error('password_cfm'); ?></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="提交" /></td>
			</tr>
		</tbody>
	</table>
	</form>
	<div class="selectbar"></div>
</div>
</body>
</html>
