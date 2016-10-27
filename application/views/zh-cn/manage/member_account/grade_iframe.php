<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>客户升降级记录</title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>assets/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
/*$(function(){
	$('#toFollowIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/follow_iframe').'/'.$row['member_id'];?>"});
	$('#toActivityIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/member_account/activity_iframe').'/'.$row['member_id'];?>"});
	$('#toAnalystIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/analyst').'/'.$row['member_id'];?>"});
	$('#toTradeIframe').click(function(){window.parent.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/trade_habit').'/'.$row['member_id'];?>"});
})*/
</script>
</head>
<body>
<div>
	<table width="100%" height="100%" cellspacing="0" cellpadding="0" class="itemlist lh24 mainbl">
		<!--<tr>
			<td class="mainbr" colspan="3" style="padding:0;">
				<div id="wrapIframe" class="wrapIframe ofh">
					<a href="javascript:void(0)" style="width:20%" id="toFollowIframe">跟进记录</a>
					<a href="javascript:void(0)" style="width:20%" id="toActivityIframe">活动记录</a>
					<a href="javascript:void(0)" style="width:20%" class="cur">升降级记录</a>
                    <a href="javascript:void(0)" style="width:20%" id="toAnalystIframe">分析师记录</a>
                    <a href="javascript:void(0)" style="width:20%" id="toTradeIframe">交易习惯</a>
				</div>
			</td>
		</tr>-->
		<tr class="wrap_tab">
			<td class="wrap_tab" colspan="2">
				<div style="overflow-y:scroll;height:428px;width:100%;">
					<table cellspacing="0" cellpadding="2" class="itemlist" width="100%">
						<tr>
							<td class="mainbr">时间</td>
							<td class="mainbr">升级/降级</td>
							<td class="mainbr">账户类别</td>
							<td class="mainbr">负责同事</td>
						</tr>
						<?php $grade_records = $this->member_grade_model->get_grade_records($row['member_id']);?>
						<?php foreach($grade_records as $k=>$item):?>
						<tr>
							<td class="mainbr"><?php echo $item['create_time'];?></td>
							<td class="mainbr"><?php if($item['grade_status'] != 0):?> <?php echo ($item['grade_status']==1)?"升级":"降级";?> <?php endif;?></td>
							<td class="mainbr"><?php echo $item['account_type'];?></td>
							<td class="mainbr"><?php echo $this->user_list_model->getUserGlobal($item['sales_man']);?></td>
						</tr>
						<?php endforeach;?>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>
</body>
</html>