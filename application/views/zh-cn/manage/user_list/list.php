<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script src="<?php echo base_url()?>assets/js/script.js" language="javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(".btn1").click(function(){
  	$(".stop_user").toggle();
  });
});
</script>
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 系统管理 - 用户管理</div>
  <div class="toolbar">
    <input type="button" value="添加" onclick="location.href='<?php echo site_url('manage/user_list/add')?>'" />
    <button class="btn1">显示/隐藏(停用的用户)</button>
    <div style=" float:right">
      <select name="myselect" onchange="location.href='<?php echo site_url('manage/user_list/index/'.$page)?>/'+this.value+'/1'">
        <option value="20" <?php echo set_select('myselect','20', '20'==$limit?true:false); ?>>20</option>
        <option value="100" <?php echo set_select('myselect','100', '100'==$limit?true:false); ?>>100</option>
        <option value="1000" <?php echo set_select('myselect','1000', '1000'==$limit?true:false); ?>>1000</option>
      </select>
      条/页
    </div>
  </div>
  <div class="scrollbar">
    <table width="100%" cellspacing="0">
      <thead class="titlelist">
        <tr>
          <td class="no" width="60">ID</td>
          <td>用户名</td>
          <td>销售组/成员</td>
          <td>用户级别</td>
          <td>用户状态</td>
          <td width="100">操作</td>
        </tr>
      </thead>
      <tbody class="itemlist lh24">
        <?php foreach($result as $item):?>
        <?php 
        if($item['user_status']==1){
			echo '<tr class="stop_user" style="display:none;">';
		}else{
			echo '<tr>';
		}
        ?>
          <td><?php echo $item['user_id'];?></td>
          <td><?php echo $item['user_name'];?></td>
          <td><?php echo $item['sales_name'];?></td>
          <td><?php echo $list_limits[$item['user_limits']];?></td>
          <td><?php if($item['user_status']==1) echo '<span class="red">停用</span>';?>
		  		<?php if($item['user_status']==2) echo '<span class="green">启用</span>';?></td>
          <td><a class="btn" href="<?php echo site_url('manage/user_list/edit/'.$page.'/'.$item['user_id'])?>">修改</a>
				<?php if($item['user_id']>1):?>
                <a class="btn del" href="<?php echo site_url('manage/user_list/delete/'.$page.'/'.$item['user_id'])?>">删除</a>
                <?php endif;?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="selectbar"></div>
  <div class="toolbar"><?php echo $pages; ?></div>
</div>
</body>
</html>
