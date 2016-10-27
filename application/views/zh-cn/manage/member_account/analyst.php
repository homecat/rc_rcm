<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>分析师记录</title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<style type="text/css">
a.btn1{ background-color:#CCC; border-radius:3px;color:#FFF; cursor:default; height:20px; line-height:20px; text-decoration:none;}
.qgreed{ background-color:#0F6;}
</style>
<script src="<?php echo base_url() ?>assets/js/jquery.js" type="text/javascript"></script>
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
		//var old_update_time = window.parent.frames["post_table"].document.getElementById('update_time').value;
		window.parent.document.getElementById('update_time').value=time;
	}
};
$(function(){
	$('.btn1').each(function(index, element) {
        $(this).attr('href','javascript:void(0)');
    });
	$('.btn').each(function(index, element) {
		var confirm_url=$(this).attr('url');
        $(this).attr('href',confirm_url);
    });
	/*$('#toFollowIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/follow_iframe').'/'.$row['member_id'];?>"});
	$('#toActivityIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/member_account/activity_iframe').'/'.$row['member_id'];?>"});
	$('#toGradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/grade_iframe').'/'.$row['member_id'];?>"});
	$('#toTradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/trade_habit').'/'.$row['member_id'];?>"});*/
	
})
</script>
</head>
<body>
<div>
    <form action="<?php echo site_url('manage/authority/analyst_add');?>" method="post">
        <table width="100%" height="100%" cellspacing="0" cellpadding="0" class="itemlist lh24 mainbl">
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
                	<input type="text" name="follow_time" readonly="readonly" value="<?php echo date('Y-m-d H:i:s');?>"/>
                </td>
				<td class="mainbr" colspan="2"><input type="text" name="follow_info" size="46" id="follow_info" value="<?php echo set_value('follow_info');?>" /></td>
            </tr>
			<tr>
                <td class="mainbr">分析类型<span class="red">*</span><?php echo form_error('follow_type'); ?></td>
				<td class="mainbr" rowspan="2" style="vertical-align:middle"></td>
				<td class="mainbr"></td>
			</tr>
			<tr>
                <td class="mainbr"><select name="follow_type">
                        <option value="">请选择</option>
                        <?php echo $this->member_params_model->get_parm_option('分析類型'); ?>
                    </select>
                    </td>
				<td class="mainbr"><input type="submit" value="添加" /><input type="hidden" name="member_id" value="<?php echo $row['member_id'];?>" /></td>
			</tr>
            <tr class="wrap_tab">
                <td colspan="3" class="wrap_tab">
                    <div style="overflow-y:scroll;height:290px;width:101%;">
                        <table cellspacing="0" cellpadding="0" class="inside_tab" width="100%">
                    		<?php if($analyst_rows):?>
                            <?php foreach($analyst_rows as $k=>$item):?>
                            <tr <?php if($item['follow_confirm']==1 && $item['follow_btn_bg']==1)echo "class='qgreed'"?>>
                                <td style="width:75px;padding-left:5px;"><?php echo $item['follow_time'];?></td>
                                <td style="width:48px;padding-left:5px;"><?php echo $item['follow_type'];?></td>
                                <td style="width:38px;padding-left:5px;"><?php echo $item['follower'];?></td>
                                <td><?php echo $item['follow_info'];?></td>
								
								<td align="center" style="padding-top:5px;padding-bottom:5px;width:40px; background-color:#FFF;">
                                <?php if(isset($user_limits) && $user_limits==1):?>
                                <a style="display:block; margin-bottom:2px" class="btn url" href="<?php echo site_url('manage/authority/edit_follow').'/'.$item['follow_id'];?>">修改</a>
                                <?php endif;?>
                                <?php if(isset($user_limits) && ($user_limits==1 || $user_limits==6)):?>
                                <a ids="<?php echo $item['follow_id'];?>" url="<?php echo site_url('manage/authority/confirm').'/'.$item['follow_id']?>"  style="display:block;" <?php if($item['follow_btn_bg']==1)echo "class='btn1'";else echo "class='btn'";?> >确认</a>
                                <?php endif;?>
                                </td>
								
                            </tr>
                            <?php endforeach;?>
                            <?php endif;?>
                        </table>
                    </div>
                   
        </table>
    </form>
</div>
</body>
<script>
var nums=[];
	$('.btn1').each(function(index, element) {
		nums[index]=$(this).attr('ids');
    });
var str = nums.toString();
	 //alert(str)
var option_button=window.parent.document.getElementById('option_button')
$(option_button).click(function(){
	window.parent.document.getElementById('flag_habit_bg').value=str;
})
</script>
</html>