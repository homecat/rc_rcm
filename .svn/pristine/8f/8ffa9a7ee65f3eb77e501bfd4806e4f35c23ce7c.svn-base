<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>英伦金业 - CRM管理中心</title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div class="login">
  <div class="logo"><img src="<?php echo base_url()?>assets/css/manage/logo.jpg"></div>
  <div class="logos">CRM管理系统</div>
  <div class="errorbox mb20"></div>
  <form method="post">
    <table width="500" cellpadding="8" cellspacing="0" align="center">
    
      <tr>
        <td width="70" align="right">用户名&nbsp;：</td>
        <td><input name="login" type="text" class="w250" value="<?php echo set_value('login'); ?>">
          <?php echo form_error('login')?>
          <?php if($code==1):?>
          <span class="red">用户名不存在或密码错误</span>
          <?php endif;?></td>
      </tr>
      <tr>
        <td align="right">密码&nbsp;：</td>
        <td><input name="password" type="password" class="w250" value="<?php echo set_value('password'); ?>">
          <?php echo form_error('password')?></td>
      </tr>
      <tr>
        <td align="right">验证码&nbsp;：</td>
        <td><input name="captcha" type="text" class="w100">
          <img src="<?php echo site_url('tools/captcha/index/'.time())?>" /> <?php echo form_error('captcha')?></td>
      </tr>
      <tr>
        <td height="40"></td>
        <td><input type="submit" value="提交" class="submit" /></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>
