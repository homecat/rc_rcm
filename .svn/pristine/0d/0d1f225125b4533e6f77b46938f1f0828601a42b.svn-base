<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/datePicker/WdatePicker.js"></script>
<script type="text/javascript">
</script>
</head>
<body>
<div class="p5" style="min-width:840px;">
	<div class="position"><b>首页</b> - 销售中心 - 销售表现记录</div>
    <div class="mainstyle">
    	<form method="post" id="search_member_behave" name="search_member_behave">
            <div class="borderbottom toolbar">
                <table cellpadding="0" cellspacing="0" width="100%" style="min-width:800px;">
                	<tr>
                    	<td><span class="tit pr20">客户记录列表</span>
                        <input type="submit" value="查询" />
                        <input type="reset" value="重置" /></td>
                        <td align="right">
                        	<select style="width:auto;" onchange="location.href='<?php echo site_url('manage/member_behave/index').'/'.$sign.'/'.$page;?>/'+this.value">
                                <option <?php if($limit==20) echo 'selected="selected"'; ?>>20</option>
                                <option <?php if($limit==50) echo 'selected="selected"'; ?>>50</option>
                                <option <?php if($limit==100) echo 'selected="selected"'; ?>>100</option>
                            </select>
        				</td>
                    </tr>
                </table>
            </div>
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr class="borderbottom">
                	<td>用户状态</td>
                    <td>
                        <select name="user_status" id="user_status" style="width:auto;">
                        <option value="" <?php echo ($search['user_status'] !=2 )?"selected='selected'":"";?>>所有</option>
                        <option value="2" <?php echo ($search['user_status']==2)?"selected='selected'":"";?>>启用</option>
                        </select>
                    </td>
                    <td>负责人</td>
                    <td class="borderright">
                        <select name="sales_man">
                            <option value="">全部</option>
                            <?php echo $this->user_list_model->get_user_id_option($search['sales_man']);?>
                        </select>
                    </td>
                    <td>负责团队</td>
                    <td class="borderright">
                        <select name="sales_id">
                            <option value="<?php echo $this->session->userdata['sales_id'];?>">全部</option>
                            <?php echo $this->member_sales_model->sales_option($search['sales_id']);?>
                        </select>
                    </td>
                    <td>开始时间</td>
                    <td class="borderright"><input type="text" name="time_start" value="<?php echo ($search['time_start'])?$search['time_start']:date('Y-m-d 00:00:00');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                    <td>结束时间</td>
                    <td class="borderright"><input type="text" name="time_end" value="<?php echo ($search['time_end'])?$search['time_end']:date('Y-m-d 23:59:59');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                </tr>
            </table>
    	</form>
    </div>
    <div class="scrollbar">
        <table width="100%" cellspacing="0">
          <thead class="titlelist">
            <tr>
                <td width="80">负责人</td>
                <td>用户状态</td>
                <td>新增CRM</td>
                <td>成功开户</td>
                <td>Dead lead</td>
                <td>Stage1</td>
                <td>Stage2</td>
                <td>Stage3</td>
                <td>Stage4</td>
                <td>合共2</td>
            </tr>
          </thead>
          <tbody class="itemlist lh24">
            <?php foreach($result as $item):?>
            <tr>
                <td><?php echo $this->user_list_model->getUserGlobal($item['sales_man']);?></td>
                <td><?php if($item['user_status']==1) echo '<span class="red">停用</span>';?>
		  			<?php if($item['user_status']==2) echo '<span class="green">启用</span>';?></td>
                <td><?php echo $item['newCreate'];?></td>
                <td><?php echo $item['newOpen'];?></td>
                <td><?php echo $item['Dead'];?></td>
                <td><?php echo $item['Stage1'];?></td>
                <td><?php echo $item['Stage2'];?></td>
                <td><?php echo $item['Stage3'];?></td>
                <td><?php echo $item['Stage4'];?></td>
                <td><?php echo $item['nums'];?></td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
    </div>
    <div class="selectbar"></div>
    <div class="toolbar" style="min-width:840px;"><?php echo $pages; ?></div>
</div>
<!--修改页面-->
<div class="graybg"> </div>
<div id="editBox">
	<iframe id="edit_member_account" name="edit_member_account" frameborder="0" scrolling="no" src="" height="100%" width="100%"></iframe>
</div>
</body>
</html>