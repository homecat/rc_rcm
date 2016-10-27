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
	/*$('#toFollowIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/follow_iframe').'/'.$row['member_id'];?>"});
	$('#toActivityIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/member_account/activity_iframe').'/'.$row['member_id'];?>"});
	$('#toGradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/grade_iframe').'/'.$row['member_id'];?>"});
	<!--$('#toAnalystIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/analyst').'/'.$row['member_id'];?>"});-->

	$('#toTradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/trade_habit').'/'.$row['member_id'];?>"});*/
})
</script>
</head>
<body>
<div>
    <form action="<?php echo site_url('manage/authority/save_follow');?>" method="post">
        <table width="100%" height="100%" cellspacing="0" cellpadding="5" class="itemlist lh24 mainbl">
            <!--<tr>
				<td colspan="3" style="padding:0;">
					<div id="wrapIframe" class="wrapIframe ofh">
						<a href="javascript:void(0)" style="width:20%" id="toFollowIframe">跟进记录</a>
						<a href="javascript:void(0)" style="width:20%" id="toActivityIframe">活动记录</a>
						<a href="javascript:void(0)" style="width:20%" id="toGradeIframe">升降级记录</a>
                        <a href="javascript:void(0)" style="width:20%" class="cur">分析师记录</a>
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
                <td class="mainbr" colspan="2"><input type="text" name="follow_info" size="40" id="follow_info" value="<?php echo $row['follow_info'];?>" /></td>
            </tr>
			<tr>
                <td class="mainbr">分析类型<span class="red">*</span><?php echo form_error('follow_type'); ?></td>
				<td class="mainbr" style="vertical-align:middle" rowspan="2"></td>
				<td class="mainbr"></td>
			</tr>
			<tr>
				<td class="mainbr">
					<select name="follow_type">
                        <option value="">请选择</option>
                        <?php echo $this->member_params_model->get_parm_option('分析類型',$row['follow_type']); ?>
                    </select></td>
				<td class="mainbr" colspan="2">
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