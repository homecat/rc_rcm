<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 客户管理 - 客户资料修改审批</div>
  <table class="toolbar" cellspacing="0" width="100%" style="min-width:958px;">
    <tr>
      <td><input type="button" value="返回" onclick="location.href='<?php echo site_url('manage/member_checks/index/'.$page)?>'"/></td>
      <td class="red fb">修改项背景为淡黄色</td>
    </tr>
  </table>
	<div class="scrollbar ofh" style="min-width:970px;">
        <table cellspacing="0" cellpadding="5" class="fl">
            <tbody class="itemlist lh24">
            <tr>
                <td>姓名<span class="red">*</span></td>
                <td class="mainbr"><?php echo $old['member_name'];?></td>
                <td width="170" height="18">描述</td>
            </tr>
            <tr>
                <td>QQ1<span class="red">*</span></td>
                <td class="mainbr"><?php echo $old['member_qq'];?><input type="checkbox" disabled="disabled" style="margin:0;" name="member_qq_addfriend" value="1" <?php echo (isset($old['member_qq_addfriend'])&&$old['member_qq_addfriend']==1)?"checked='checked'":"";?>></td>
                <td valign="top" rowspan="7" class="wrap_tab">
                    <div style="height:220px;overflow-y:scroll;">
                    <?php echo $old['member_info'];?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>QQ2<span class="red">*</span></td>
                <td class="mainbr"><?php echo (isset($old['member_qq_addfriend']))?$old['member_qq2']:"";?><input type="checkbox" disabled="disabled" style="margin:0;" name="member_qq2_addfriend" value="1" <?php echo (isset($old['member_qq_addfriend'])&&$old['member_qq_addfriend']==1)?"checked='checked'":"";?>></td>
            </tr>
            <tr>
                <td>手机号码1<span class="red">*</span></td>
                <td class="mainbr"><?php echo $old['member_phone'];?></td>
            </tr>
            <tr>
                <td>手机号码2</td>
                <td class="mainbr"><?php echo isset($old['member_phone2'])?$old['member_phone2']:"";?></td>
            </tr>
            <tr>
                <td>微信</td>
                <td class="mainbr"><span style="width:200px;"><?php echo (isset($old['member_weixin']))?$old['member_weixin']:"";?></span>
                    <input type="checkbox" style="margin:0;" disabled="disabled" name="member_weixin_addfriend" value="1" <?php echo (isset($old['member_weixin'])&&$old['member_weixin_addfriend']==1)?"checked='checked'":"";?>></td>
            </tr>
            <tr>
                <td>状态<span class="red">*</span></td>
                <td class="mainbr"><?php echo $old['member_status'];?></td>
            </tr>
            <tr>
                <td>来源</td>
                <td class="mainbr"><?php echo $old['member_from'];?></td>
            </tr>
            <tr <?php if($new['sales_man']!=$old['sales_man']) echo 'class="lhse"';?>>
                <td>负责人</td>
                <td class="mainbr"><input type="text" disabled="disabled" size="39" value="<?php echo $this->user_list_model->getUserGlobal($new['sales_man']);?>" /></td>
                <td>跟进记录</td>
            </tr>
            <tr>
                <td>修改人</td>
                <td class="mainbr"><?php echo $this->user_list_model->getUserGlobal($old['updater']);?></td>
                <td class="wrap_tab" rowspan="12" class="mainbl">
					<?php $status_records = $this->member_status_model->get_status_records($old['member_id']); ?>
                    <div style="height:387px;overflow-y:scroll;">
                        <table width="100%" cellspacing="0" cellpadding="5" class="inside_tab">
                            <?php foreach($status_records as $k=>$item):?>
                            <tr>
                                <td width="75" height="21"><?php echo $item['create_time'];?></td>
                                <td><?php echo $item['member_status'];?></td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>修改时间</td>
                <td class="mainbr"><?php echo $old['update_time'];?></td>
            </tr>
            <tr <?php if($new['member_opener']!=$old['member_opener']) echo 'class="lhse"';?>>
                <td>开户人</td>
                <td class="mainbr"><input type="text" disabled="disabled" size="39" value="<?php echo $this->user_list_model->getUserGlobal($new['member_opener']);?>" /></td>
            </tr>
            <tr>
                <td>模拟账户</td>
                <td class="mainbr"><?php echo $old['demo_account'];?></td>
            </tr>
            <tr <?php if($new['real_account']!=$old['real_account']) echo 'class="lhse"';?>>
                <td>MT4账户</td>
                <td class="mainbr"><input type="text" disabled="disabled" size="39" value="<?php echo $new['real_account'];?>" /></td>
            </tr>
            <tr <?php if(@$new['rc_real_account']!=@$old['rc_real_account']) echo 'class="lhse"';?>>
                <td>RC账户</td>
                <td class="mainbr"><input type="text" disabled="disabled" size="39" value="<?php echo $new['rc_real_account'];?>" /></td>
            </tr>
            <tr <?php if($new['open_time']!=$old['open_time']) echo 'class="lhse"';?>>
                <td>开户时间</td>
                <td class="mainbr"><input type="text" disabled="disabled" size="39" value="<?php echo $new['open_time'];?>" /></td>
            </tr>
            <tr <?php if($new['account_type']!=$old['account_type']) echo 'class="lhse"';?>>
                <td>账户类别</td>
                <td class="mainbr"><input type="text" disabled="disabled" size="39" value="<?php echo $new['account_type'];?>" /></td>
            </tr>
            <tr <?php echo (@$new['member_MGM']!=@$old['member_MGM'])?'class="lhse"':"";?>>
                <td>MGM</td>
                <td class="mainbr"><?php echo isset($new['member_MGM'])?$new['member_MGM']:"";?></td>
            </tr>
            <tr>
                <td>建立人</td>
                <td class="mainbr"><?php echo $this->user_list_model->getUserGlobal($old['creater']);?></td>
            </tr>
            <tr>
                <td>建立时间</td>
                <td class="mainbr"><?php echo $old['create_time'];?></td>
            </tr>
            <tr>
                <td>电销预约</td>
                <td class="mainbr <?php echo ($old['call_start_time'] && substr($old['call_start_time'],0,10) < date('Y-m-d'))?"red":"";echo (substr($old['call_start_time'],0,10) == date('Y-m-d'))?"orange":"";?>"><?php echo $old['call_start_time'];?></td>
            </tr>
            <tr>
                <td>文销预约</td>
                <td class="mainbr <?php echo (isset($old['wen_order_time']) && (substr($old['wen_order_time'],0,10)) < date('Y-m-d'))?"red":"";echo (isset($old['wen_order_time'])&&(substr($old['wen_order_time'],0,10)) == date('Y-m-d'))?"orange":"";?>"><?php echo isset($old['wen_order_time'])?$old['wen_order_time']:"";?></td>
            </tr>
            </tbody>
        </table>
        <table cellpadding="5" cellspacing="0" class="fl" width="455" height="675">
            <tbody class="itemlist">
            <tr class="wrap_tab">
                <td height="580" class="wrap_tab"><iframe width="100%" height="100%" id="edit_member_follow" name="edit_member_follow" frameborder="0" scrolling="no" src="<?php echo site_url('manage/member_account/follow_iframe_show').'/'.$old['member_id'];?>"></iframe></td>
            </tr>
            <tr>
                <td align="center" height="25" style="padding:0;" colspan="2" class="mainbr">*提示信息：<?php echo validation_errors();?></td>
            </tr>
            <tr>
                <td align="center" style="padding:0;" colspan="2" class="mainbr vatop"><input type="submit" value="提交" disabled='' /></td>
            </tr>
            </tbody>
        </table>
	</div>
	<div class="selectbar" style="min-width:945px;"></div>
    <div class="toolbar" style="min-width:947px;">
		<?php if($check_status==1):?>
        <input type="button" value="审批" onclick="location.href='<?php echo site_url('manage/member_checks/submit/'.$page.'/'.$edit_id)?>'"/>
        <input type="button" value="放弃" onclick="location.href='<?php echo site_url('manage/member_checks/forgo/'.$page.'/'.$edit_id)?>'" />
        <?php endif;?>
    </div>
</div>
</body>
</html>