<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 销售中心 - 销售团队</div>
  <div class="toolbar">
    <input type="button" value="返回" onclick="history.back()" />
  </div>
  <div class="errorbox"></div>
  <?php echo form_open(uri_string()); ?>
  <table width="100%" cellspacing="0" cellpadding="5">
    <tbody class="itemlist">
      <tr>
        <td width="120">ID</td>
        <td><input type="text" disabled="disabled" value="<?php echo $row['sales_id'];?>" size="39" /></td>
      </tr>
      <tr>
        <td>所属组<span class="red">*</span></td>
        <td><select name="sales_pid" class="sWidth">
        	<?php echo $this->member_sales_model->sales_option($row['sales_pid'],$row['sales_id']);?>
          </select>
          <?php echo form_error('sales_pid');?></td>
      </tr>
      <tr>
        <td>名称<span class="red">*</span></td>
        <td><input type="text" name="sales_name" value="<?php echo set_value('sales_name',$row['sales_name']); ?>" maxlength="16" size="39"/>
          <?php echo form_error('sales_name');?></td>
      </tr>
      <!--<tr>
        <td>负责人</td>
        <td><input type="text" name="sales_lead" value="<?php echo set_value('sales_lead',$row['sales_lead']); ?>" maxlength="16" size="39"/>
          <?php echo form_error('sales_lead');?></td>
      </tr>-->
      <tr>
        <td>描述</td>
        <td><input type="text" name="sales_info" value="<?php echo set_value('sales_info',$row['sales_info']); ?>" maxlength="255" size="39"/>
          <?php echo form_error('sales_info'); ?></td>
      </tr>
      <tr>
        <td>添加时间</td>
        <td><input type="text" name="create_time" value="<?php echo set_value('create_time',$row['create_time']); ?>" disabled="disabled" size="39"/>
          <?php echo form_error('create_time'); ?></td>
      </tr>
      <tr>
        <td>更新时间</td>
        <td><input type="text" name="update_time" value="<?php echo set_value('update_time',$row['update_time']); ?>" disabled="disabled" size="39"/>
          <?php echo form_error('update_time'); ?></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="提交" /></td>
      </tr>
    </tbody>
  </table>
  <?php echo form_close();?>
  <div class="selectbar"></div>
</div>
</body>
</html>
