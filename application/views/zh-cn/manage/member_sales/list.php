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
<div class="p5">
  <div class="position"><b>首页</b> - 销售中心 - 销售团队</div>
    <div class="toolbar">
        <input type="button" value="添加" onclick="location.href='<?php echo site_url('manage/member_sales/add')?>'" />
    </div>
  <div class="scrollbar">
      <table width="100%" cellspacing="0">
          <thead class="titlelist">
          <tr>
              <td class="no">ID</td>
              <td>团队</td>
              <td>添加时间</td>
              <td width="120">操作</td>
          </tr>
          </thead>
          <tbody class="itemlist lh24">
          <?php echo list_level($result); ?>
          </tbody>
      </table>
  </div>
</div>
<?php 
function list_level($list,$pid=0,$level=0){
  $str = NULL;
  foreach($list as $item){
	if($item['sales_pid']==$pid){
	  $str .= '<tr>';
	  $str .= '<td>'.$item['sales_id'].'</td>';
	  $str .= '<td>'.str_repeat("&nbsp;",$level*6);
	  $str .= '<a target="mainFrame" class="btn" href="'.site_url('manage/member_sales/item/'.$item['sales_id']).'">'.$item['sales_name'].'</a></td>';
	  $str .= '<td>'.$item['create_time'].'</td>';
	  if($item['sales_pid']==0){
	  	$str .= '<td></td>';
	  }else{
		$str .= '<td><a class="btn" href="'.site_url('manage/member_sales/edit/'.$item['sales_id']).'">修改</a>&nbsp;'; 
		$str .= '<a class="btn del" href="'.site_url('manage/member_sales/delete/'.$item['sales_id']).'">删除</a></td>'; 
	  }
	  $str .= '</tr>'; 
	  $str .= list_level($list,$item['sales_id'],$level+1);
	}
  }
  return $str;
}
?>
</body>
</html>
