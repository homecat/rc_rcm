<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/datePicker/WdatePicker.js"></script>
</head>
<body>
<div class="p5">
    <div class="position"><b>首页</b> - 客户资料全部导出</div>
	<table style="min-width:985px;width:100%;" cellspacing="0" class="toolbar">
		<tr>
			<td height="20"></td>
		</tr>
	</table> 
    <form method="post" action="<?php echo site_url('manage/member_alldata/index');?>">
        <div class="searchbox" style="min-width:975px;">
            <table cellspacing="0">
                <tr>
                    <td>开始时间</td>
                    <td><input type="text" name="time_start" value="<?php echo ($search['time_start'])?$search['time_start']:date('Y-m-d 00:00:00');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                    <td>结束时间</td>
                    <td><input type="text" name="time_end" value="<?php echo ($search['time_end'])?$search['time_end']:date('Y-m-d 23:59:59');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                    <td>状态</td>
                      <td>
                        <select name="member_status" id="member_status">
							<option value="">所有</option>
                            <option value="S1-S5" <?php echo ($search['member_status']=="S1-S5")?"selected='selected'":"";?>>S1-S5</option>
                            <option value="S1-S4" <?php echo ($search['member_status']=="S1-S4")?"selected='selected'":"";?>>S1-S4</option>
                            <?php echo $this->member_params_model->get_parm_option('状态',$search['member_status']);?>
                        </select>
                    </td>
					<td><input type="submit" value="导出所有记录" /></td>
                </tr>
            </table>
        </div>
    </form>
</div>
</body>
</html>