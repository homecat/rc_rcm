<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>交易习惯</title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>assets/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datePicker/WdatePicker.js"></script>
<script type="text/javascript">
/*var update_follow_time = '';
<?php if(isset($update_follow_time)):?>
update_follow_time = "<?php echo $update_follow_time;?>";
<?php endif;?>
changeUpdateFollowTime(update_follow_time);
function changeUpdateFollowTime(time)
{
	if(time != '')
	{
		var old_update_time = window.parent.document.getElementById('update_time').value;
		window.parent.document.getElementById('update_time').value = time;
	}
};*/
$(function(){
	$('.follow_info_radio').click(function(){$('#follow_info').val($(this).val()).attr('readonly',' ');});
	$('.write_follow_info').click(function(){$('#follow_info').val("").removeAttr('readonly');$('.follow_info_radio').removeAttr('checked')});
	/*$('#toFollowIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/follow_iframe').'/'.$row['member_id'];?>"});
	$('#toActivityIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/member_account/activity_iframe').'/'.$row['member_id'];?>"});
	$('#toGradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/grade_iframe').'/'.$row['member_id'];?>"});
	$('#toAnalystIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/analyst').'/'.$row['member_id'];?>"});*/
})
</script>
</head>
<body>
<div>
    <!--<form action="<?php echo site_url('manage/authority/trade_sub');?>" method="post">-->
        <table width="100%" height="100%" cellspacing="0" cellpadding="0" class="itemlist lh24 mainbl">
			<!--<tr>
				<td colspan="4" style="padding:0;">
					<div id="wrapIframe" class="wrapIframe ofh">
						<a href="javascript:void(0)" style="width:20%" id="toFollowIframe">跟进记录</a>
						<a href="javascript:void(0)" style="width:20%" id="toActivityIframe">活动记录</a>
						<a href="javascript:void(0)" style="width:20%" id="toGradeIframe">升降级记录</a>
                        <a href="javascript:void(0)" style="width:20%" id="toAnalystIframe">分析师记录</a>
                        <a href="javascript:void(0)" style="width:20%" class="cur">交易习惯</a>
					</div>
				</td>
			</tr>-->
            <tr>
            	<td>姓名</td>
                <td><input name='member_name' type="text" readonly="readonly" value='<?php echo (isset($row) && $row)?$row['member_name']:'';?>'/><input name="member_id" type="hidden" value="<?php echo (isset($row) && $row)?$row['member_id']:'';?>"></td>
                <td>真实账号</td>
                <td><input name='real_account' type="text" readonly="readonly" value='<?php echo (isset($row) && $row)? $row['real_account']:'';?>'/></td>
            </tr>
            <tr>
            	<td>账户类别</td>
                <td><input name='account_type' type="text" readonly="readonly" value='<?php echo (isset($row) && $row)? $row['account_type']:'';?>'/></td>
                <td>开户时间</td>
                <td><input name='open_time' type="text" readonly="readonly" value='<?php echo (isset($row) && $row)? $row['open_time']:'';?>'/>
                <input type="hidden" id="flag_habit" name="flag_habit" value="1" />
                </td>
            </tr>
            <tr>
            	<td>专家QQ</td>
                <td colspan="3">
                <!--<select name="expert_qq_invited"><option value='0' <?php echo (isset($row) && $row && $row['expert_qq_invited']==0)?'selected="selected"':'';?>>未邀请</option><option value='1' <?php echo (isset($row) && $row && $row['expert_qq_invited']==1)?'selected="selected"':'';?>>已邀请</option></select>
                <select name="expert_qq_added"><option value='0' <?php echo (isset($row) && $row && $row['expert_qq_added']==0)?'selected="selected"':'';?>>未添加</option><option value='1' <?php echo (isset($row) && $row && $row['expert_qq_added']==1)?'selected="selected"':'';?>>已添加</option></select>-->
                <label><input id="expert_qq_invited" type="checkbox" style="margin:0;" name="expert_qq_invited" value="1" <?php echo ($row['expert_qq_invited']==1)?"checked='checked'":"";?> />已邀请</label>&nbsp;&nbsp;
							<label><input id="expert_qq_added" type="checkbox" style="margin:0;" name="expert_qq_added" value="1" <?php echo ($row['expert_qq_added']==1)?"checked='checked'":"";?> />已添加</label>
                </td>
            </tr>
            <tr>
            	<td>描述</td>
                <td colspan="3">
                <textarea readonly="readonly" name="member_info" style="padding:0;height:100%;width:100%;overflow-y:scroll;resize:none;border:none;margin:0;"><?php echo (isset($row) && $row)? $row['member_info']:'';?></textarea>
                </td>
            </tr>
            <tr>
            	<td>交易习惯</td>
                <td colspan="3">
                <textarea id="member_tradehabit" name="member_tradehabit" style="padding:0;height:100%;width:100%;overflow-y:scroll;resize:none;border:none;margin:0;"><?php echo (isset($row) && $row)? $row['member_tradehabit']:'';?></textarea>
                </td>
            </tr>
            <!--<tr>
            	<td colspan="2">(只有专家QQ,交易习惯可以修改)</td>
                <td><span class="red"><?php 
				if(isset($info)&&$info=='110') echo '没有修改过内容' ;
				if(isset($info)&&$info=='1') echo '修改成功' ;
				?></span></td>
                <td align="left"><input type="submit" name="sub" value="修改" /></td>
               	
            </tr>-->
            <tr>
            	<td>交易记录</td>
                <td colspan="3"></td>
            </tr>
            
            <tr>
            <td colspan="4">
            	<div  style=" height:120px; overflow-y:scroll;">
                <table width="100%">
                <tr>
                    <td width="30%">添加时间</td>
                    <td width="30%">时间</td>
                    <td width="20%">账号</td>
                    <td width="20%">交易手数</td>
            	</tr>
                <!---循环--->
               	 <?php if($tardes_sj):foreach($tardes_sj as $item):?>
                    <tr>
                        <td><?php echo $item['add_time']?></td>
                        <td><?php echo $item['recode_time']?></td>
                        <td><?php echo $item['rec_flag'];?></td>
                        <td><?php echo $item['trade_num']?></td>
                    </tr>
                 <?php endforeach;else:?>
                 <tr>
                		<td align="center" colspan="3">暂无记录</td>
           		 </tr>
            	<?php endif;?>
                </table>
                </div>
            </td>
            	
            </tr>
           
            
        </table>
   <!-- </form>-->
</div>
</body>
<script>
//$('#expert_qq_invited').click(function(){alert($(this).is(":checked").valueOf())})
var option_button=window.parent.document.getElementById('option_button')
$(option_button).click(function(){
	//alert($('#expert_qq_invited').is(":checked").valueOf());
	if($('#expert_qq_invited').is(":checked").valueOf()===true){
		
window.parent.document.getElementById('expert_qq_invited').value=$('#expert_qq_invited').val();}else{window.parent.document.getElementById('expert_qq_invited').value='';}
if($('#expert_qq_added').is(":checked").valueOf()===true){
window.parent.document.getElementById('expert_qq_added').value=$('#expert_qq_added').val();}else{window.parent.document.getElementById('expert_qq_added').value=''}

window.parent.document.getElementById('member_tradehabit').value=$('#member_tradehabit').val();
window.parent.document.getElementById('flag_habit').value=$('#flag_habit').val();
})
</script>
</html>