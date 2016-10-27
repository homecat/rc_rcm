<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
<link href="<?php echo base_url() ?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url() ?>assets/datePicker/WdatePicker.js"></script>
</head>
<body>
<div>
    <form action="<?php echo site_url('manage/member_follow/save_follow');?>" method="post">
        <table height="100%" cellspacing="0" cellpadding="5" class="itemlist lh24 mainbl" width="100%">
            <tr>
                <td height="18" colspan="4" class="mainbr">跟进记录</td>
            </tr>
            <tr>
                <td class="mainbr">时间<span class="red">*</span><?php echo form_error('follow_time'); ?></td>
                <td class="mainbr">跟进类型<span class="red">*</span></td>
                <td class="mainbr">跟进信息<span class="red">*</span><?php echo form_error('follow_info'); ?></td>
                <td class="mainbr"></td>
            </tr>
            <tr>
                <td class="mainbr" width="75">
                	<input type="text" name="follow_time" disabled="disabled" value="" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})">
                </td>
                <td class="mainbr"><select name="follow_type" style="width:75px;">
                        <option value="">请选择</option>
                        <?php echo $this->member_params_model->get_parm_option('跟进类型'); ?>
                    </select>
                    </td>
                <td class="mainbr"><input type="text" name="follow_info" disabled="disabled" value="" /></td>
                <td class="mainbr"><input type="submit" value="添加" disabled="" style="cursor:default;" /><input type="hidden" name="member_id" value="<?php echo $row['member_id'];?>" /></td>
            </tr>
            <tr class="wrap_tab">
                <td colspan="4" class="wrap_tab">
                    <div style="overflow-y:scroll;height:479px;">
                        <table cellspacing="0" cellpadding="4" class="inside_tab" width="100%">
                            <?php $follow_records = $this->member_follow_model->get_follow_records($row['member_id']);?>
                            <?php foreach($follow_records as $k=>$item):?>
                            <tr>
                               <td style="width:75px;padding-left:5px;"><?php echo $item['follow_time'];?></td>
                                <td style="width:48px;padding-left:5px;"><?php echo $item['follow_type'];?></td>
                                <td style="width:38px;padding-left:5px;"><?php echo $this->user_list_model->getUserGlobal($item['follower']);?></td>
                                <td><?php echo $item['follow_info'];?></td>
                                <!--<td width="40" class="vatop"><a class="btn gray" href="javascript:void(0)">修改</a></td>-->
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