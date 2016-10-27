<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>跟进记录</title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>assets/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datePicker/WdatePicker.js"></script>
<script>
var update_follow_time = '';
var check_qq_phone = '';
<?php if(isset($update_follow_time)):?>
	update_follow_time = "<?php echo $update_follow_time;?>";
<?php endif;?>

<?php if(isset($check_qq_phone)):?>
	check_qq_phone = "<?php echo $check_qq_phone;?>";
<?php endif;?>

changeUpdateFollowTime(update_follow_time);
changeUpdateFollowTim(check_qq_phone);
function changeUpdateFollowTime(time){
	if(time != ''){
		window.parent.document.getElementById('update_time').value=time;
	}
};
function changeUpdateFollowTim(check_qq_phone){
	if(check_qq_phone != ''){
		window.parent.document.getElementById('check_qq_phone').value=check_qq_phone;
	}
};

</script>
</head>
<body>
<form method="post" action="<?php echo site_url('manage/member_account/save_cos/'.$row['member_id']);?>">
   <table id="from" cellspacing="0" cellpadding="5" class="fl" height="526" width="280">
                <tbody class="editBox itemlist lh24">
                    <tr>
                        <td width="62">姓名<span class="red">*</span></td>
                        <td colspan="3"><input type="text" size="25" name="member_name" id="member_name" value="<?php echo $row['member_name'];?>" /></td>
                    </tr>
                    <tr>
                        <td>QQ1<span class="red">*</span></td>
                        <td colspan="3"><input  id="member_qq" type="text" name="member_qq" value="<?php echo set_value('member_qq', $row['member_qq']); ?>" maxlength="23" size="25"/>
                            <input type="checkbox" id="member_qq_addfriend" style="margin:0;" name="member_qq_addfriend" value="1" <?php echo ($row['member_qq_addfriend']==1)?"checked='checked'":"";?> /></td>
                    </tr>
                    <tr>
                        <td>QQ2</td>
                        <td colspan="3"><input id="member_qq2" type="text" name="member_qq2" value="<?php echo set_value('member_qq2', $row['member_qq2']); ?>" maxlength="23" size="25"/>
                        	<input type="hidden" id='load_lxfsqq2' name="load_lxfsqq2" value="<?php echo $row['member_qq2']?>" />
                            <input type="checkbox" id="member_qq2_addfriend" style="margin:0;" name="member_qq2_addfriend" value="1" <?php echo ($row['member_qq2_addfriend']==1)?"checked='checked'":"";?> /></td>
                    </tr>
					<tr>
						<td>专家QQ</td>
						<td colspan="3"><label><input id="expert_qq_invited" type="checkbox" style="margin:0;" name="expert_qq_invited" value="1" <?php echo ($row['expert_qq_invited']==1)?"checked='checked'":"";?> />已邀请</label>&nbsp;&nbsp;
							<label><input id="expert_qq_added" type="checkbox" style="margin:0;" name="expert_qq_added" value="1" <?php echo ($row['expert_qq_added']==1)?"checked='checked'":"";?> />已添加</label></td>
					</tr>
                    <tr>
                        <td>手机号码1<span class="red">*</span></td>
                        <td colspan="3"><input id="member_phone" type="text" name="member_phone" value="<?php echo set_value('member_phone', $row['member_phone']); ?>" maxlength="20" size="25"/></td>
                    </tr>
                    <tr>
                        <td>手机号码2</td>
                        <td colspan="3">
                        	<input id="member_phone2" type="text" name="member_phone2" value="<?php echo set_value('member_phone2', $row['member_phone2']); ?>" maxlength="20" size="25"/>
                        </td>
                    </tr>
                    <tr>
                        <td>微信</td>
                        <td colspan="3"><input id="member_weixin" type="text" name="member_weixin" value="<?php echo set_value('member_weixin', $row['member_weixin']); ?>" maxlength="32" size="25"/>
                        	<input id="member_weixin_addfriend" type="checkbox" style="margin:0;" name="member_weixin_addfriend" value="1" <?php echo ($row['member_weixin_addfriend']==1)?"checked='checked'":"";?>>
                        </td>
                    </tr>
                    <tr>
                        <td>状态<span class="red">*</span></td>
                        <td colspan="3">
                        	<select id="member_status" name="member_status" class="sWidth">
                                <option value="">请选择</option>
                                <?php echo $this->member_params_model->get_parm_option('状态',$row['member_status']);?>
                            </select>
                    </tr>
                    <tr>
                        <td>来源</td>
                        <td colspan="3">
                        	<select id="member_from" name="member_from" class="sWidth">
                                <option value="">请选择</option>
                                <?php echo $this->member_params_model->get_parm_option('来源', $row['member_from']); ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td>负责人</td>
                        <td colspan="3"><?php echo $this->user_list_model->getUserGlobal($row['sales_man']);?></td>
                    </tr>
                    <tr>
                        <td>修改人</td>
                        <td colspan="3"><?php echo $this->user_list_model->getUserGlobal($row['updater']);?></td>
                    </tr>
                    <tr>
                        <td>修改时间</td>
                        <td colspan="3"><?php echo $row['update_time'];?></td>
                    </tr>
                    <tr>
                        <td>开户人</td>
                        <td colspan="3"><?php echo $this->user_list_model->getUserGlobal($row['member_opener']);?></td>
                    </tr>
                    <tr>
                        <td>模拟账户</td>
                        <td colspan="3"><input id="demo_account" type="text" name="demo_account" value="<?php echo set_value('demo_account', $row['demo_account']); ?>" maxlength="32" size="28"/></td>
                    </tr>
                    <tr>
                        <td>MT4账户</td>
                        <td><?php echo $row['real_account'];?></td>
                        <td>RC账户</td>
                        <td><?php echo $row['rc_real_account'];?></td>
                    </tr>
                    <tr>
                        <td>开户时间</td>
                        <td colspan="3"><?php echo $row['open_time']; ?></td>
                    </tr>
                    <tr>
                        <td>账户类别</td>
						<td colspan="3">
							<span class="mainbr mr5" style="display:inline-block;width:35px;"><?php echo $row['account_type'];?></span> MGM : <?php echo $row['member_MGM'];?>
						</td>
                    </tr>
                    <tr>
                        <td>建立人</td>
                        <td colspan="3">
                        	<?php echo $this->user_list_model->getUserGlobal($row['creater']); ?><input type="hidden" name="creater" value="<?php echo $row['creater'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>建立时间</td>
                        <td colspan="3"><?php echo $row['create_time'];?></td>
                    </tr>
                    <tr>
                        <td>电销预约</td>
                        <td colspan="3">
                        	<input <?php echo ($row['call_start_time'] && substr($row['call_start_time'],0,10) < date('Y-m-d'))?"class='red'":"";echo (substr($row['call_start_time'],0,10) == date('Y-m-d'))?"class='blue'":"";?> type="text" size="25" id="call_start_time" name="call_start_time" value="<?php echo $row['call_start_time'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
                        	<input <?php echo $row['key_reser_time']?"checked='checked'":NULL?> type="checkbox" id="key_reser_time" name="key_reser_time" value="1" />
                        </td>
                    </tr>
                    <tr>
                        <td>文销预约</td>
                        <td colspan="3">
                        	<input <?php echo ($row['wen_order_time'] && substr($row['wen_order_time'],0,10) < date('Y-m-d'))?"class='red'":"";echo (substr($row['wen_order_time'],0,10) == date('Y-m-d'))?"class='blue'":"";?> type="text" size="28" id="wen_order_time" name="wen_order_time" value="<?php echo $row['wen_order_time'];?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" />
                        </td>
                    </tr>
            	</tbody>
            </table>
            <table width="225" cellspacing="0" cellpadding="5" class="fl itemlist lh24 mainbl">
                <tr>
                    <td style="padding-bottom:3px;">描述<span class="red">*</span></td>
                </tr>
                <tr>
                    <td class="wrap_tab" style="height:60px;">
						<textarea id="member_info" style="padding:0;height:100%;width:100%;overflow-y:scroll;resize:none;border:none;margin:0;" name="member_info"><?php echo set_value('member_info', $row['member_info']); ?></textarea>
					</td>
                </tr>
                <tr>
	                <td class="mainbr">
	                	 <select name="is_upgrade" style="margin:0 20px 0 20px;" id="is_upgrade">
	                        <option value="0" <?php if($row['is_upgrade']==0):?>selected="selected"<?php endif;?>>夹升级</option>
	                        <option value="1" <?php if($row['is_upgrade']==1):?>selected="selected"<?php endif;?>>已升级</option>
                   		 </select>
	                	 <select name="is_operation" style="margin:0 20px 0 20px;" id="is_operation">
	                        <option value="0" <?php if($row['is_operation']==0):?>selected="selected"<?php endif;?>>夹操作</option>
	                        <option value="1" <?php if($row['is_operation']==1):?>selected="selected"<?php endif;?>>已操作</option>
                   		 </select>
	                </td>
                </tr>
                <tr>
	                <td>
	               		<label style="margin:0 20px 0 20px;"><input id="re_MGM" type="checkbox" style="margin:0;" name="re_MGM" value="1" <?php echo ($row['re_MGM']==1)?"checked='checked'":"";?> />MGM</label>
	               		<label style="margin:0 20px 0 35px;"><input id="is_income" type="checkbox" style="margin:0;" name="is_income" value="1" <?php echo ($row['is_income']==1)?"checked='checked'":"";?> />将入金</label>
	                </td>
                </tr>
				<tr>
                    <td>客户习惯性</td>
                </tr>
                <tr>
                    <td class="wrap_tab" style="height:60px;">
                    	<textarea id="member_habit" style="height:100%;width:100%;overflow-y:scroll;resize:none;border:none;margin:0;padding:0;" name="member_habit"><?php echo set_value('member_habit', $row['member_habit']); ?></textarea>
					</td>
                </tr>
                <tr>
                    <td height="24">状态记录</td>
                </tr>
                <tr class="wrap_tab">
                    <td class="wrap_tab">
                        <?php $status_records = $this->member_status_model->get_status_records($row['member_id']); ?>
                        <div style="height:200px;overflow-y:scroll;">
							<table width="100%" cellspacing="0" cellpadding="5" class="inside_tab">
							<?php foreach($status_records as $k=>$item):?>
								<tr>
									<td width="70"><?php echo $item['create_time'];?></td>
									<td><?php echo $item['member_status'];?></td>
								</tr>
							<?php endforeach;?>
							</table>
						</div>
					</td>
				</tr>
		</table>
</form>
</body>
<script>
var option_button=window.parent.document.getElementById('option_button');
$(option_button).click(function(){
	window.parent.document.getElementById('member_name').value=$("#member_name").val();
	window.parent.document.getElementById('member_qq').value=$("#member_qq").val();
	window.parent.document.getElementById('member_qq2').value=$("#member_qq2").val();
	if($("#expert_qq_invited").is(":checked").valueOf()===true){
		window.parent.document.getElementById('expert_qq_invited').value=$("#expert_qq_invited").val();
	}else{
		window.parent.document.getElementById('expert_qq_invited').value  = 0;
	}
	
	if($("#expert_qq_added").is(":checked").valueOf()===true){
		window.parent.document.getElementById('expert_qq_added').value=$("#expert_qq_added").val();
	}else{
		window.parent.document.getElementById('expert_qq_added').value = 0;
	}
	
	if($("#member_qq_addfriend").is(":checked").valueOf()===true){
		window.parent.document.getElementById('member_qq_addfriend').value=$("#member_qq_addfriend").val();
	}else{
		window.parent.document.getElementById('member_qq_addfriend').value  = 0;
	}
	
	if($("#member_qq2_addfriend").is(":checked").valueOf()===true){
		window.parent.document.getElementById('member_qq2_addfriend').value=$("#member_qq2_addfriend").val();
	}else{
		window.parent.document.getElementById('member_qq2_addfriend').value = 0;
	}
	
	if($("#member_weixin_addfriend").is(":checked").valueOf()===true){
		window.parent.document.getElementById('member_weixin_addfriend').value=$("#member_weixin_addfriend").val();
	}else{
		window.parent.document.getElementById('member_weixin_addfriend').value = 0;
	}
	window.parent.document.getElementById('member_phone').value=$("#member_phone").val();
	window.parent.document.getElementById('member_phone2').value=$("#member_phone2").val();
	window.parent.document.getElementById('member_weixin').value=$("#member_weixin").val();
	window.parent.document.getElementById('member_status').value=$("#member_status").val();
	window.parent.document.getElementById('member_from').value=$("#member_from").val();
	
	if($("#call_start_time").value == ''){
		window.parent.document.getElementById('call_start_time').value = 'NULL';
	}else{
		window.parent.document.getElementById('call_start_time').value=$("#call_start_time").val();
	}
	window.parent.document.getElementById('wen_order_time').value=$("#wen_order_time").val();
	window.parent.document.getElementById('member_info').value=$("#member_info").val();
	if($("#key_reser_time").is(":checked").valueOf()===true){
		window.parent.document.getElementById('key_reser_time').value=$("#key_reser_time").val();
	}
	window.parent.document.getElementById('member_habit').value=$("#member_habit").val();
	window.parent.document.getElementById('is_upgrade').value=$("#is_upgrade").val();
	window.parent.document.getElementById('is_operation').value=$("#is_operation").val();
	if($("#re_MGM").is(":checked").valueOf()===true){
		window.parent.document.getElementById('re_MGM').value = 1;
	}else{
		window.parent.document.getElementById('re_MGM').value = 0;
	}
	if($("#is_income").is(":checked").valueOf()===true){
		window.parent.document.getElementById('is_income').value = 1;
	}else{
		window.parent.document.getElementById('is_income').value = 0;
	}
})
</script>
</html>