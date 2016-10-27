<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 支付相关 - 存取款银行</div>
  <div class="toolbar">
    <input type="button" value="返回" onclick="location.href='<?php echo site_url('manage/member_params/index')?>'" />
  </div>
  <div class="errorbox red">
    <?php if($code==10001)echo'银行名称已存在';?>
  </div>
  <form method="post">
    <div class="scrollbar">
      <table width="100%" cellspacing="0" cellpadding="5">
        <tbody class="itemlist lh24">
        <tr>
          <td width="120">银行类别<span class="red">*</span></td>
          <td><select name="bank_cid" class="sWidth">
              <option value="1">存款银行</option>
              <option value="2">取款银行</option>
            </select>
            <?php echo form_error('bank_cid');?></td>
        </tr>
          <tr>
            <td>银行名称<span class="red">*</span></td>
            <td><input type="text" name="bank_name" size="39"/>
              <?php echo form_error('bank_name');?></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" value="提交" /></td>
          </tr>
        </tbody>
      </table>
    </div>
  </form>
  <div class="selectbar"></div>
  <div class="toolbar"></div>
</div>
</body>
</html>