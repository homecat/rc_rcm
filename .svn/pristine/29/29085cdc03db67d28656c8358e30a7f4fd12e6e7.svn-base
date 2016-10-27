<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script src="<?php echo base_url()?>assets/js/script.js" language="javascript"></script>
</head>
<body>
<div class="position"><b>首页</b> - 销售中心 - 销售表现记录</div>
<div class="toolbar">
  <input type="button" value="返回" onclick="history.back()" />
  <input type="button" value="<?php echo isset($prow['sales_name'])?$prow['sales_name']:'none';?>" disabled="disabled" />
</div>
<table width="100%" cellspacing="0">
  <thead class="titlelist">
    <tr>
      <td class="no">成员</td>
      <td>添加时间</td>
      <td width="120">操作</td>
    </tr>
  </thead>
  <tbody class="itemlist lh24">
    <?php foreach($result as $item):?>
    <tr>
      <td><?php echo $item['sales_name']?></td>
      <td><?php echo $item['create_time']?></td>
      <td><a class="btn" target="mainFrame" href="<?php echo site_url('manage/member_sales/edit/'.$item['sales_id'].'/'.$pid);?>">查看</a> 
      <a class="btn del" target="mainFrame" href="<?php echo site_url('manage/member_sales/delete/'.$item['sales_id'].'/'.$pid);?>">删除</a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</body>
</html>
