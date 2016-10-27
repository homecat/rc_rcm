<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>文本记录</title>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/datePicker/WdatePicker.js"></script>
<script src="<?php echo base_url()?>assets/js/script.js" language="javascript"></script>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 文本管理 -文本记录</div>
  <div class="toolbar">
     <input type="button" value="添加" onclick="location.href='<?php echo site_url('manage/memo/save')?>'" />
    <div style=" float:right">
        <select onchange="location.href='<?php echo site_url('manage/memo/index/1')?>/'+this.value">
          <option <?php if($limit==20) echo 'selected="selected"'; ?>>20</option>
          <option <?php if($limit==50) echo 'selected="selected"'; ?>>50</option>
          <option <?php if($limit==100) echo 'selected="selected"'; ?>>100</option>
          <option <?php if($limit==200) echo 'selected="selected"'; ?>>200</option>
          <option <?php if($limit==1000) echo 'selected="selected"'; ?>>1000</option>
        </select>
      条/页
    </div>
  </div>
   <div class="searchbox">
     <form method="post">
	  <table cellspacing="0">
	      <tr>
	          <td>标题</td>
	          <td><input type="text" name="title" id="title" value="<?php echo $search['title'];?>"/></td>
	          <td>开始时间</td>
	          <td><input type="text" name="time_start" id="time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  value="<?php echo $search['time_start'];?>"/></td>
	          <td>结束时间</td>
	          <td><input type="text" name="time_end" id="time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo $search['time_end'];?>" /></td>
	          <td colspan="2">
	          <td><input type="submit" name="submit" value="查询" /></td>
	      </tr>
	  </table>
	 </form>
  </div>
  <div class="scrollbar">
    <table width="60%" cellspacing="0">
     <thead class="titlelist">
        <tr>
          <td  width=200>日期</td>
          <td>标题</td>
          <td width="100">操作</td>
        </tr>
      </thead>
     <tbody class="itemlist lh24">
       <?php foreach($result as $item):?>
           <tr>
	          <td><?php echo $item['dateandtime']?></td>
	          <td><?php echo $item['title']?></td>
	          <td><a class="btn" href="<?php echo site_url('manage/memo/edit/'.$item['id'])?>">修改</a>
                  <a class="btn del" href="<?php echo site_url('manage/memo/delete/'.$item['id'])?>">删除</a>
           </tr>
        <?php endforeach;?> 
      </tbody>
    </table>
  </div>
   <div class="selectbar"></div>
  <div class="toolbar"><?php echo $pages; ?></div>
</body>
</html>