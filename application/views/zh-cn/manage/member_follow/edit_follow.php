<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>assets/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(function(){
	$('.follow_info_radio').click(function(){$('#follow_info').val($(this).val()).attr('readonly','readonly');});
	$('.write_follow_info').click(function(){$('#follow_info').val("").removeAttr('readonly');$('.follow_info_radio').removeAttr('checked')});
	
	/*$('#toActivityIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/member_account/activity_iframe').'/'.$row['member_id'];?>"});
	$('#toGradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/grade_iframe').'/'.$row['member_id'];?>"});
	$('#toAnalystIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/analyst').'/'.$row['member_id'];?>"});

	$('#toTradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/trade_habit').'/'.$row['member_id'];?>"});*/
})
</script>
</head>
<body>
<div>
    <form action="<?php echo site_url('manage/member_follow/save_follow');?>" method="post">
        <table width="100%" height="100%" cellspacing="0" cellpadding="5" class="itemlist lh24 mainbl">
           <!-- <tr>
				<td colspan="3" style="padding:0;">
					<div id="wrapIframe" class="wrapIframe ofh">
						<a href="javascript:void(0)" style="width:20%" class="cur">跟进记录</a>
						<a href="javascript:void(0)" style="width:20%" id="toActivityIframe">活动记录</a>
						<a href="javascript:void(0)" style="width:20%" id="toGradeIframe">升降级记录</a>
                        <a href="javascript:void(0)" style="width:20%" id="toAnalystIframe">分析师记录</a>
                        <a href="javascript:void(0)" style="width:20%" id="toTradeIframe">交易习惯</a>
					</div>
				</td>
			</tr>-->
            <tr>
                <td class="mainbr" style="width:123px;">时间<span class="red">*</span><?php echo form_error('follow_time'); ?></td>
				<td class="mainbr">跟进信息<span class="red">*</span><?php echo form_error('follow_info'); ?></td>
				<td class="mainbr"></td>
            </tr>
            <tr>
                <td class="mainbr">
                	<input type="text" name="follow_time" readonly="readonly" value="<?php echo $row['follow_time'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"/>
                </td>
                <td class="mainbr" colspan="2">
					<?php if($row['follow_info']!="NA"&&$row['follow_info']!="不通"&&$row['follow_info']!="现在忙"):?>
					<input type="text" name="follow_info" size="46" id="follow_info" value="<?php echo $row['follow_info'];?>" />
					<?php else:?>
					<input type="text" name="follow_info" size="46" id="follow_info" readonly="readonly" value="" />
					<?php endif;?>
                </td>
            </tr>
			<tr>
                <td class="mainbr">跟进类型<span class="red">*</span><?php echo form_error('follow_type'); ?></td>
				<td class="mainbr" style="vertical-align:middle" rowspan="2">
					<label><input type="radio" class="follow_info_radio" <?php echo ($row['follow_info']=="N/A")?'checked="checked"':"";?> name="follow_info_radio" value="N/A" style="vertical-align:top;" />N/A</label>
					<label><input type="radio" class="follow_info_radio" <?php echo ($row['follow_info']=="通话中")?'checked="checked"':"";?> name="follow_info_radio" value="通话中" style="vertical-align:top;" />通话中</label>
					<label><input type="radio" class="follow_info_radio" <?php echo ($row['follow_info']=="未能接通")?'checked="checked"':"";?> name="follow_info_radio" value="未能接通" style="vertical-align:top;" />未能接通</label><br />
					<label><input type="radio" class="follow_info_radio" <?php echo ($row['follow_info']=="挂线")?'checked="checked"':"";?> name="follow_info_radio" value="挂线" style="vertical-align:top;" />挂线</label>
					<label><input type="radio" class="follow_info_radio" <?php echo ($row['follow_info']=="客户忙，要求稍后再call")?'checked="checked"':"";?> name="follow_info_radio" value="客户忙，要求稍后再call" style="vertical-align:top;" />客户忙，要求稍后再call</label>
					<!--<label><input type="radio" class="write_follow_info" <?php echo ($row['follow_info']!="NA"&&$row['follow_info']!="不通"&&$row['follow_info']!="现在忙")?'checked="checked"':"";?> name="follow_info_radio" value="" style="vertical-align:top;" />自定义</label>-->
				</td>
				<td class="mainbr"></td>
			</tr>
			<tr>
				<td class="mainbr">
					<select name="follow_type">
                        <option value="">请选择</option>
                        <?php echo $this->member_params_model->get_parm_option('跟进类型',$row['follow_type']); ?>
                    </select></td>
				<td class="mainbr">
					<input type="submit" value="提交" />
					<input type="hidden" name="member_id" value="<?php echo $row['member_id'];?>" />
					<input type="hidden" name="follow_id" value="<?php echo $row['follow_id'];?>" />
				</td>
			</tr>
        </table>
    </form>
</div>
</body>
</html>