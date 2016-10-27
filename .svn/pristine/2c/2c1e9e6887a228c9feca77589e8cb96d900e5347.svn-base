<?php if (!defined('BASEPATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/datePicker/WdatePicker.js"></script>
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 客户中心 - 客户资料修改审批</div>
  <form method="post">
  <table width="100%" class="toolbar" cellspacing="0">
    <tr>
      <td>
          <input type="reset" value="重置" />
          <input type="submit" name="submit" value="查询" />
      </td>
      <td align="right"><select onchange="location.href='<?php echo site_url('manage/member_checks/index/1')?>/'+this.value">
          <option <?php if($limit==20) echo 'selected="selected"'; ?>>20</option>
          <option <?php if($limit==50) echo 'selected="selected"'; ?>>50</option>
          <option <?php if($limit==100) echo 'selected="selected"'; ?>>100</option>
          <option <?php if($limit==200) echo 'selected="selected"'; ?>>200</option>
          <option <?php if($limit==1000) echo 'selected="selected"'; ?>>1000</option>
        </select>
        条/页</td>
    </tr>
  </table>
  <div class="searchbox">
  <table cellspacing="0">
      <tr>
          <td>真实账号</td>
          <td><input type="text" name="real_account" id="real_account" value="<?php echo $search['real_account'];?>" /></td>
          <td>状态</td>
          <td><select name="check_status">
            <option value="">所有</option>
            <option value="1" <?php if($search['check_status']==1) echo 'selected="selected"';?>>待审批</option>
            <option value="2" <?php if($search['check_status']==2) echo 'selected="selected"';?>>已审批</option>
            <option value="3" <?php if($search['check_status']==3) echo 'selected="selected"';?>>已放弃</option>
          </select></td>
          <td><label><input type="radio" name="time_type" value="1" <?php if($search['time_type']!=2) echo 'checked="checked"';?> /> 提案时间</label>
            <label><input type="radio" name="time_type" value="2" <?php if($search['time_type']==2) echo 'checked="checked"';?> /> 审批时间</label></td>
          <td>开始时间</td>
          <td><input type="text" name="time_start" id="time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo $search['time_start'];?>"/></td>
          <td>结束时间</td>
          <td><input type="text" name="time_end" id="time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo $search['time_end'];?>" /></td>
          <td colspan="2">
      </tr>
    </table>
  </div>
  </form>
  <div class="scrollbar">
  <table width="100%" cellspacing="0">
    <thead class="titlelist">
      <tr>
        <td class="no">ID</td>
        <td>账户姓名</td>
        <td>提案人</td>
        <td>提案时间</td>
        <td>审批人</td>
        <td>审批时间</td>
        <td>提案状态</td>
        <td>操作</td>
      </tr>
    </thead>
    <tbody class="itemlist lh24">
      <?php foreach($result as $item):?>
      <tr>
          <td><?php echo $item['edit_id'];?></td>
          <td><?php echo $this->member_account_model->member_name($item['member_id']);?></td>
          <td><?php echo $this->user_list_model->getUserGlobal($item['edit_people']);?></td>
          <td><?php echo $item['edit_time'];?></td>
          <td><?php echo $this->user_list_model->getUserGlobal($item['check_people']);?></td>
          <td><?php echo $item['check_time'];?></td>
          <td>
              <?php if($item['check_status']==1):?>
                  <span class="red">待审批</span>
              <?php elseif($item['check_status']==2):?>
                  <span class="green">已审批</span>
              <?php elseif($item['check_status']==3):?>
                  <span>已放弃</span>
              <?php endif;?>
          </td>
          <td><a class="btn" href="<?php echo site_url('manage/member_checks/show/'.$page.'/'.$item['edit_id'])?>">查看</a></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  </div>
  <div class="selectbar"></div>
  <div class="toolbar"><?php echo $pages; ?></div>
</div>
</body>
</html>