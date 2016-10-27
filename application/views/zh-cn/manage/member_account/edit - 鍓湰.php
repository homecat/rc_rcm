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
	$('#wrapIframe > a').click(function(){
		$(this).addClass('cur').siblings().removeClass('cur');
	});
	$('#toFollowIframe').click(function(){window.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/follow_iframe').'/'.$row['member_id'];?>"});
	$('#toActivityIframe').click(function(){window.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/activity_iframe').'/'.$row['member_id'];?>"});
	$('#toGradeIframe').click(function(){window.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/grade_iframe').'/'.$row['member_id'];?>"});
	$('#toAnalystIframe').click(function(){window.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/analyst').'/'.$row['member_id'];?>"});
	$('#toTradeIframe').click(function(){window.document.getElementById('edit_member_follow').src = "<?php echo site_url('manage/authority/trade_habit').'/'.$row['member_id'];?>"});
})
</script>
</head>
<body>
<div class="p5">
    <div class="ofh">
        <form method="post" action="<?php echo site_url('manage/member_account/edit').'/'.$page.'/'.$row['member_id'].'/TRUE';?>">
            <table  style="float:left" cellpadding="5" cellspacing="0" height="100%" class="itemlist" width="505">
                <tr class="wrap_tab">
                    <td height="526" class="wrap_tab">
                    	<iframe  width="100%" height="100%" id="post_table" name="post_table" frameborder="0" scrolling="no" src="<?php echo site_url('manage/authority/customer_content').'/'.$row['member_id'];?>"></iframe>
                    </td>
                </tr>
            </table>
            <table style="float:left" cellpadding="5" cellspacing="0" height="526" class="itemlist lh24 mainbl" width="465">
            	<tr>
					<td colspan="2" style="padding:0;">
						<div id="wrapIframe" class="wrapIframe ofh">
							<a href="javascript:void(0)" style="width:20%" id="toFollowIframe" class="cur">跟进记录</a>
							<a href="javascript:void(0)" style="width:20%" id="toActivityIframe">活动记录</a>
							<a href="javascript:void(0)" style="width:20%" id="toGradeIframe">升降级记录</a>
	                        <a href="javascript:void(0)" style="width:20%" id="toAnalystIframe">分析师记录</a>
	                        <a href="javascript:void(0)" style="width:20%" id="toTradeIframe">交易习惯</a>
						</div>
					</td>
				</tr>
                <tr class="wrap_tab">
                    <td colspan="2" height="430" class="wrap_tab">
                    	<iframe width="100%" height="100%" id="edit_member_follow" name="edit_member_follow" frameborder="0" scrolling="no" src="<?php echo site_url('manage/authority/follow_iframe').'/'.$row['member_id'];?>"></iframe>
                    </td>
                </tr>
                <tr>
                	<td colspan="2" align="center" height="18" class="mainbr">*提示信息: 
                    	<span class="red"><?php 
							if(isset($check_qq_phone) && $check_qq_phone>1000){
								if($check_qq_phone==1200) echo "QQ和手机号码必填一项";
								if($check_qq_phone==1300) echo "该QQ已经存在";
								if($check_qq_phone==1310) echo "该QQ2已经存在";
								if($check_qq_phone==1320) echo "该手机号码已经存在";
								if($check_qq_phone==1330) echo "该手机号码2已经存在";
								if($check_qq_phone==1500) echo "没有改动需要提交";
								if($check_qq_phone==1800) echo "提交失败";
								if($check_qq_phone==1100) echo "手机号码存在多个请删除后再做修改";
								if($check_qq_phone==1700) echo "QQ号码存在多个请删除后再做修改";
								if($check_qq_phone==2000) echo "修改提交成功！";
							}else{
								 echo validation_errors();
							}
						?></span>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="mainbr" style="padding:0;"><input class="option_button" id="option_button" type="submit" value="保存" />
					<input type="hidden" id="expert_qq_invited" name="expert_qq_invited" value="" />
                    <input type="hidden" id="expert_qq_added" name="expert_qq_added" value="" />
                    <input type="hidden" id="member_tradehabit" name="member_tradehabit" value="" />
                    
                    <input type="hidden" id="member_name" name="member_name" value="" />
                    <input type="hidden" id="member_qq2" name="member_qq2" value="" />
                    <input type="hidden" id="member_qq" name="member_qq" value="" />
                    <input type="hidden" id="member_qq_addfriend" name="member_qq_addfriend" value="" />
                    <input type="hidden" id="member_qq2_addfriend" name="member_qq2_addfriend" value="" />
                    <input type="hidden" id="member_phone" name="member_phone" value="" />
                    <input type="hidden" id="member_phone2" name="member_phone2" value="" />
                    <input type="hidden" id="member_weixin" name="member_weixin" value="" />
                    <input type="hidden" id="member_weixin_addfriend" name="member_weixin_addfriend" value="" />
                    <input type="hidden" id="member_status" name="member_status" value="" />
                    <input type="hidden" id="member_from" name="member_from" value="" />
                    <input type="hidden" id="call_start_time" name="call_start_time" value="" />
                    <input type="hidden" id="wen_order_time" name="wen_order_time" value="" />
                    <input type="hidden" id="key_reser_time" name="key_reser_time" value="" />
                    <input type="hidden" id="member_info" name="member_info" value="" />
                    <input type="hidden" id="member_habit" name="member_habit" value="" />
                    <input type="hidden" id="is_upgrade" name="is_upgrade" value="" />
                    <input type="hidden" id="is_operation" name="is_operation" value="" />
                    <input type="hidden" id="re_MGM" name="re_MGM" value="" />
                    <input type="hidden" id="is_income" name="is_income" value="" />
                    </td>
                    <td align="center" class="mainbr" style="padding:0;">
                    	<input class="option_button" type="button" onclick="window.parent.editBoxHide();" value="取消" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>