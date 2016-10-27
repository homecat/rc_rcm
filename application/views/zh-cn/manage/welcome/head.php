<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<body>
<div class="topbox">
  <div class="logo">英伦金业</div>
  <ul class="user">
    <li><b><?php echo $user_name;?></b>&lt;<?php echo $user_loginip;?>&gt;</li>
    <li><a href="<?php echo site_url('manage/welcome/right');?>" target="mainFrame">后台首页</a> | <a href="<?php echo site_url('manage/user_pwd')?>" target="mainFrame">修改密码</a></li>
  </ul>
  <ul class="tool">
    <li><a href="<?php echo base_url();?>" target="_blank">网站首页</a></li>
    <li><a href="<?php echo site_url('manage/login/out');?>">退出</a></li>
  </ul>
  <div class="subnav">
    <select onchange="location.href='<?php echo site_url('manage/login/lang')?>/'+this.value">
      <option value="en" <?php if($language=='en') echo 'selected="selected"';?>>English</option>
      <option value="zh-cn" <?php if($language=='zh-cn') echo 'selected="selected"';?>>简体中文</option>
      <option value="zh-tw" <?php if($language=='zh-tw') echo 'selected="selected"';?>>繁體中文</option>
    </select>
  </div>
</div>
<div class="topline">
  <div class="lbg"></div>
</div>
</body>
</html>
