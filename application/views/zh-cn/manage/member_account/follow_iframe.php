<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>跟进记录</title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<style>
.bgl{ background-color:#0CF}
</style>
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
		window.parent.document.getElementById('update_time').value=time;
	}
};
$(function(){
	$('.follow_info_radio').click(function(){$('#follow_info').val($(this).val()).attr('readonly',' ');});
	$('.write_follow_info').click(function(){$('#follow_info').val("").removeAttr('readonly');$('.follow_info_radio').removeAttr('checked')});
})
</script>
</head>
<body>
<div>
    <form action="<?php echo site_url('manage/member_follow/save_follow');?>" method="post">
        <table width="100%" height="100%" cellspacing="0" cellpadding="0" class="itemlist lh24 mainbl">
            <tr>
                <td class="mainbr" style="width:123px;">时间<span class="red">*</span><?php echo form_error('follow_time'); ?></td>
				<td class="mainbr">跟进信息<span class="red">*</span><?php echo form_error('follow_info'); ?></td>
				<td class="mainbr"></td>
            </tr>
            <tr>
                <td class="mainbr">
                	<input type="text" name="follow_time" readonly="readonly" value="<?php echo date('Y-m-d H:i:s');?>"/>
                </td>
				<td class="mainbr" colspan="2">
					<input type="text" name="follow_info" size="46" id="follow_info" value="<?php echo set_value('follow_info');?>" />
				</td>
            </tr>
			<tr>
                <td class="mainbr">跟进类型<span class="red">*</span><?php echo form_error('follow_type'); ?></td>
				<td class="mainbr" rowspan="2" style="vertical-align:middle">
					<label><input type="radio" class="follow_info_radio" name="follow_info_radio" value="N/A" style="vertical-align:top;" />N/A</label>
					<label><input type="radio" class="follow_info_radio" name="follow_info_radio" value="通话中" style="vertical-align:top;" />通话中</label>
					<label><input type="radio" class="follow_info_radio" name="follow_info_radio" value="未能接通" style="vertical-align:top;" />未能接通</label><br />
					<label><input type="radio" class="follow_info_radio" name="follow_info_radio" value="挂线" style="vertical-align:top;" />挂线</label>
					<label><input type="radio" class="follow_info_radio" name="follow_info_radio" value="客户忙，要求稍后再call" style="vertical-align:top;" />客户忙，要求稍后再call</label></td>
				<td class="mainbr"></td>
			</tr>
			<tr>
                <td class="mainbr">
                	<select name="follow_type">
                        <option value="">请选择</option>
                        <?php echo $this->member_params_model->get_parm_option('跟进类型'); ?>
                    </select>
                </td>
				<td class="mainbr">
					<input type="submit" value="添加" /><input type="hidden" name="member_id" value="<?php echo $row['member_id'];?>" />
				</td>
			</tr>
            <tr class="wrap_tab">
                <td colspan="3" class="wrap_tab">
                    <div style="overflow-y:scroll;height:290px;width:101%;">
                        <table cellspacing="0" cellpadding="0" class="inside_tab" width="100%">
                            <?php $follow_records = $this->member_follow_model->get_follow_records($row['member_id'],FALSE);?>
                            <?php foreach($follow_records as $k=>$item):?>
                            <tr <?php if($this->user_list_model->getUserGlobal($item['follower'],"user_limits")==4)echo "class='backyellow'";elseif($this->user_list_model->getUserGlobal($item['follower'],"user_limits")==2)echo 'class="bgl"';else echo '';?>>
                                <td style="width:75px;padding-left:5px;"><?php echo $item['follow_time'];?></td>
                                <td style="width:48px;padding-left:5px;"><?php echo $item['follow_type'];?></td>
                                <td style="width:38px;padding-left:5px;"><?php echo $this->user_list_model->getUserGlobal($item['follower']);?></td>
                                <td><?php echo $item['follow_info'];?></td>
								<?php if($this->session->userdata('user_limits')==1):?>
								<td align="center" style="width:40px;padding-left:2px;padding-top:4px;">
									<a class="btn" href="<?php echo site_url('manage/member_follow/edit_follow').'/'.$item['follow_id'];?>">修改</a>
								</td>
								<?php endif;?>
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