<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 默认页</div>
  <div class="toolbar"></div>
  <div class="errorbox"></div>
  <div class="scrollbar">
    <table width="100%" cellspacing="0">
      <tbody class="itemlist lh24">
        <tr>
          <td>系统信息：<?php echo $this->input->user_agent();?></td>
        </tr>
        <tr>
          <td>技术服务：info@trevo-tech.com</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="selectbar"> </div>
  <div class="toolbar"></div>
</div>
</body>
</html>
