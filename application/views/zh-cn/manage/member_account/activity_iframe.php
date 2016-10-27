<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>活动记录</title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>assets/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datePicker/WdatePicker.js"></script>
<script type="text/javascript">
var update_follow_time = '';
<?php if(isset($update_follow_time)):?>
update_follow_time = "<?php echo $update_follow_time;?>";
<?php endif;?>
changeUpdateFollowTime(update_follow_time);
function changeUpdateFollowTime(time)
{
	if(time != '')
	{
		//var old_update_time = window.parent.document.getElementById('update_time').value;
		//window.parent.document.getElementById('update_time').value = time;
		var old_update_time = window.parent.frames["post_table"].document.getElementById('update_time').value;
		window.parent.frames["post_table"].document.getElementById('update_time').value=time;
	}
};
$(function(){
	$('.follow_info_radio').click(function(){$('#follow_info').val($(this).val()).attr('readonly','readonly');});
	$('.write_follow_info').click(function(){$('#follow_info').val("").removeAttr('readonly');$('.follow_info_radio').removeAttr('checked')});
	
	/*$('#toFollowIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/follow_iframe').'/'.$row['member_id'];?>"});
	$('#toGradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/grade_iframe').'/'.$row['member_id'];?>"});
	$('#toAnalystIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/analyst').'/'.$row['member_id'];?>"});
	$('#toTradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/trade_habit').'/'.$row['member_id'];?>"});*/
})
</script>
</head>
<body>
<div>
    <form action="<?php echo site_url('manage/member_activity/save');?>" method="post">
        <table width="100%" height="100%" cellspacing="0" cellpadding="0" class="itemlist lh24 mainbl">
			<!--/*<tr>
				<td colspan="7" style="padding:0;">
					<div id="wrapIframe" class="wrapIframe ofh">
						<a href="javascript:void(0)" style="width:20%" id="toFollowIframe">跟进记录</a>
						<a href="javascript:void(0)" style="width:20%" class="cur">活动记录</a>
						<a href="javascript:void(0)" style="width:20%" id="toGradeIframe">升降级记录</a>
                        <a href="javascript:void(0)" style="width:20%" id="toAnalystIframe">分析师记录</a>
                        <a href="javascript:void(0)" style="width:20%" id="toTradeIframe">交易习惯</a>
					</div>
				</td>
			</tr>*/-->
            <tr>
                <td class="mainbr">时间<span class="red">*</span><?php echo form_error('activity_time'); ?></td>
                <td class="mainbr" width="118">活动名称<span class="red">*</span><?php echo form_error('activity_name'); ?></td>
				<td class="mainbr"><input type="hidden" name="member_id" value="<?php echo $row['member_id'];?>" /></td>
				<td class="mainbr"></td>
            </tr>
            <tr>
				<td class="mainbr"><input type="text" name="activity_time" value="<?php echo (isset($row['activity_time'])?$row['activity_time']:date('Y-m-d H:i:s'))?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
				<td class="mainbr"><input type="text" name="activity_name" size="14" value="<?php echo (isset($row['activity_name'])?$row['activity_name']:"")?>" /></td>
				<td class="mainbr"></td>
				<td class="mainbr"></td>
            </tr>
            <tr>
				<td class="mainbr">赠金金额<span class="red">*</span><?php echo form_error('activity_amount'); ?></td>
                <td class="mainbr">要求手数<span class="red">*</span><?php echo form_error('activity_trades'); ?></td>
                <td class="mainbr">结果<span class="red">*</span><?php echo form_error('activity_result'); ?></td>
				<td class="mainbr"></td>
            </tr>
            <tr>
				<td class="mainbr"><input type="text" name="activity_amount" value="<?php echo (isset($row['activity_amount'])?$row['activity_amount']:"")?>" /></td>
				<td class="mainbr"><input type="text" name="activity_trades" size="14" value="<?php echo (isset($row['activity_trades'])?$row['activity_trades']:"")?>" /></td>
				<td class="mainbr"><input type="text" name="activity_result" size="14" value="<?php echo (isset($row['activity_result'])?$row['activity_result']:"")?>" /></td>
				<td class="mainbr"><input type="submit" value="添加" /></td>
            </tr>
        </table>
		<table height="100%" width="100%" cellspacing="0" cellpadding="5" class="itemlist lh24">
			<tr class="wrap_tab">
                <td class="wrap_tab">
                    <div style="overflow-y:scroll;height:290px;">
                        <table cellspacing="0" cellpadding="2" class="inside_tab" width="100%">
                            <?php $activity_records = $this->member_activity_model->get_activity_records($row['member_id']);?>
							<tr>
								<td style="width:75px;padding-left:5px;">时间</td>
								<td>活动名称</td>
								<td>赠金金额</td>
								<td>手数要求</td>
								<td>结果</td>
								<td style="width:45px;"></td>
							</tr>
							<?php foreach($activity_records as $k=>$item):?>
							<tr>
								<td style="width:75px;padding-left:5px;"><?php echo $item['activity_time']?></td>
								<td><?php echo $item['activity_name']?></td>
								<td><?php echo $item['activity_amount']?></td>
								<td><?php echo $item['activity_trades']?></td>
								<td><?php echo $item['activity_result']?></td>
								<td style="width:50px;padding-left:5px;"><input type="button" onclick="location.href='<?php echo site_url('manage/member_activity/edit').'/'.$item['activity_id'];?>'" value="修改" /></td>
							</tr>
							<?php endforeach;?>
                        </table>
                    </div>
                </td>
            </tr>
		</table>
    </form>
</div>
</body>
</html>