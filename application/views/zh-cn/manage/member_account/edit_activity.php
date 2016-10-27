<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>修改活动记录</title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datePicker/WdatePicker.js"></script>
</head>
<body>
<div>
    <form action="<?php echo site_url('manage/member_activity/save');?>" method="post">
        <table width="100%" height="100%" cellspacing="0" cellpadding="5" class="itemlist lh24 mainbl">
			<!--<tr>
				<td colspan="7" style="padding:0;">
					<div id="wrapIframe" class="wrapIframe ofh">
						<a href="javascript:void(0)" style="width:33%" id="toFollowIframe">跟进记录</a>
						<a href="javascript:void(0)" style="width:33%" class="cur">活动记录</a>
						<a href="javascript:void(0)" style="width:33%" id="toGradeIframe">升降级记录</a>
                        <a href="javascript:void(0)" style="width:33%" id="toGradeIframe">分析师记录</a>
                        <a href="javascript:void(0)" style="width:33%" id="toGradeIframe">交易习惯</a>
					</div>
				</td>
			</tr>-->
            <tr>
                <td class="mainbr">时间<span class="red">*</span><?php echo form_error('activity_time'); ?></td>
                <td class="mainbr" width="118">活动名称<span class="red">*</span><?php echo form_error('activity_name'); ?></td>
				<td class="mainbr"><input type="hidden" name="member_id" value="<?php echo $row['member_id'];?>" /></td>
				<td class="mainbr"><input type="hidden" name="activity_id" value="<?php echo $row['activity_id'];?>" /></td>
            </tr>
            <tr>
				<td class="mainbr"><input type="text" name="activity_time" value="<?php echo (isset($row['activity_time'])?$row['activity_time']:date('Y-m-d H:i:s'))?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
				<td class="mainbr"><input type="text" name="activity_name" size="14" value="<?php echo (isset($row['activity_name'])?$row['activity_name']:"")?>" /></td>
				<td class="mainbr"></td>
				<td class="mainbr"></td>
            </tr>
            <tr>
				<td class="mainbr">赠金金额<span class="red">*</span><?php echo form_error('activity_time'); ?></td>
                <td class="mainbr">要求手数<span class="red">*</span><?php echo form_error('activity_trades'); ?></td>
                <td class="mainbr">结果<span class="red">*</span><?php echo form_error('activity_result'); ?></td>
				<td class="mainbr"></td>
            </tr>
            <tr>
				<td class="mainbr"><input type="text" name="activity_amount" value="<?php echo (isset($row['activity_amount'])?$row['activity_amount']:"")?>" /></td>
				<td class="mainbr"><input type="text" name="activity_trades" size="14" value="<?php echo (isset($row['activity_trades'])?$row['activity_trades']:"")?>" /></td>
				<td class="mainbr"><input type="text" name="activity_result" size="14" value="<?php echo (isset($row['activity_result'])?$row['activity_result']:"")?>" /></td>
				<td class="mainbr"><input type="submit" value="提交" /></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>