<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/datePicker/WdatePicker.js"></script>
</head>
<body>
<div class="p5">
    <div class="position"><b>首页</b> - 客户中心 - 客户资料修改</div>
    <form method="post" action="<?php echo site_url('manage/member_delete/index');?>">
        <table style="min-width:985px;width:100%;" cellspacing="0" class="toolbar">
            <tr>
                <td height="20"></td>
            </tr>
        </table>
        <div class="searchbox" style="min-width:975px;">
            <table cellspacing="0">
                <tr>
                    <td>ID</td>
                	<td><input type="text" name="search_member_id" id="search_member_id" value="<?php echo $search['member_id'];?>" /></td>
                	<td><input type="submit" value="提交" /><input type="hidden" name="search_flag" value="1" /></td>
                    <td class="red pl20">
                        <?php if($code==1000) echo "ID=<span class='fs16'>".$search['member_id']."</span> 删除"."操作成功";?>
                        <?php if($code==1100) echo "ID=<span class='fs16'>".$search['member_id']."</span> 不存在";?>
                        <?php if($code==1200) echo "ID=<span class='fs16'>".$search['member_id']."</span> 删除"."操作失败";?>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <?php if(!empty($row)):?>
        <div class="scrollbar">
            <form method="post" action="<?php echo site_url('manage/member_edits/submit/'.$row['member_id']); ?>">
                <div class="scrollbar ofh" style="min-width:990px;">
                    <table cellspacing="0" cellpadding="5" class="fl">
                        <tbody class="itemlist lh24">
                        <tr>
                            <td>姓名<span class="red">*</span></td>
                            <td class="mainbr"><?php echo $row['member_name'];?>
                           	</td>
                            <td width="170">描述<span class="red">*</span></td>
                        </tr>
                        <tr>
                            <td>QQ1<span class="red">*</span></td>
                            <td class="mainbr"><?php echo $row['member_qq'];?><input type="checkbox" disabled="disabled" style="margin:0 0 0 10px;" name="member_qq_addfriend" value="1" <?php echo set_checkbox('member_qq_addfriend',1,($row['member_qq_addfriend']==1)?TRUE:FALSE);?>></td>
                            <td valign="top" rowspan="8" class="wrap_tab">
                            	<div style="height:250px;overflow-y:scroll;">
								<?php echo $row['member_info'];?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>QQ2<span class="red">*</span></td>
                            <td class="mainbr"><?php echo $row['member_qq2'];?><input type="checkbox" disabled="disabled" style="margin:0 0 0 10px;" name="member_qq2_addfriend" value="1" <?php echo set_checkbox('member_qq2_addfriend',1,($row['member_qq2_addfriend']==1)?TRUE:FALSE);?>></td>
                        </tr>
                        <tr>
                            <td>手机号码1<span class="red">*</span></td>
                            <td class="mainbr"><?php echo $row['member_phone'];?></td>
                        </tr>
                        <tr>
                            <td>手机号码2</td>
                            <td class="mainbr"><?php echo $row['member_phone2'];?></td>
                        </tr>
                        <tr>
                            <td>微信</td>
                            <td class="mainbr"><span style="width:200px;"><?php echo $row['member_weixin'];?></span>
                                <input type="checkbox" style="margin:0 0 0 10px;" disabled="disabled" name="member_weixin_addfriend" value="1" <?php echo set_checkbox('member_weixin_addfriend',1,($row['member_weixin_addfriend']==1)?TRUE:FALSE);?>></td>
                        </tr>
                        <tr>
                            <td>状态<span class="red">*</span></td>
                            <td class="mainbr"><?php echo $row['member_status'];?></td>
                        </tr>
                        <tr>
                            <td>来源</td>
                            <td class="mainbr"><?php echo $row['member_from'];?></td>
                        </tr>
                        <tr>
                            <td>负责人<span class="red">*</span></td>
                            <td class="mainbr"><?php echo $this->user_list_model->getUserGlobal($row['sales_man']);?></td>
                        </tr>
                        <tr>
                            <td>修改人</td>
                            <td class="mainbr"><?php echo $this->user_list_model->getUserGlobal($row['updater']);?></td>
                            <td class="mainbl">跟进记录</td>
                        </tr>
                        <tr>
                            <td>修改时间</td>
                            <td class="mainbr"><?php echo $row['update_time'];?></td>
                            <td class="wrap_tab" rowspan="12">
                            	<?php $status_records = $this->member_status_model->get_status_records($row['member_id']); ?>
                                <div style="height:364px;overflow-y:scroll;">
                                    <table width="100%" cellspacing="0" cellpadding="5" class="inside_tab" border="0">
                                        <?php foreach($status_records as $k=>$item):?>
                                        <tr>
                                            <td width="75"><?php echo $item['create_time'];?></td>
                                            <td><?php echo $item['member_status'];?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </table>
                              	</div>
                            </td>
                        </tr>
                        <tr>
                            <td>开户人</td>
                            <td class="mainbr"><?php echo $this->user_list_model->getUserGlobal($row['member_opener']);?></td>
                        </tr>
                        <tr>
                            <td>模拟账户</td>
                            <td class="mainbr"><?php echo $row['demo_account'];?></td>
                        </tr>
                        <tr>
                            <td>MT4账户</td>
                            <td class="mainbr"><?php echo $row['real_account']; ?></td>
                        </tr>
                        <tr>
                            <td>RC账户</td>
                            <td class="mainbr"><?php echo $row['rc_real_account']; ?></td>
                        </tr>
                        <tr>
                            <td>开户时间</td>
                            <td class="mainbr"><?php echo $row['open_time']; ?></td>
                        </tr>
                        <tr>
                            <td>账户类别</td>
                            <td class="mainbr"><?php echo $row['account_type'];?></td>
                        </tr>
                        <tr>
                            <td>MGM</td>
                            <td class="mainbr"><?php echo $row['member_MGM']; ?></td>
                        </tr>
                        <tr>
                            <td>建立人</td>
                            <td class="mainbr"><?php echo $this->user_list_model->getUserGlobal($row['creater']);?></td>
                        </tr>
                        <tr>
                            <td>建立时间</td>
                            <td class="mainbr"><?php echo $row['create_time'];?></td>
                        </tr>
                        <tr>
                            <td>电销预约</td>
                            <td class="mainbr <?php echo ($row['call_start_time'] && substr($row['call_start_time'],0,10) < date('Y-m-d'))?"red":"";echo (substr($row['call_start_time'],0,10) == date('Y-m-d'))?"orange":"";?>"><?php echo $row['call_start_time'];?></td>
                        </tr>
                        <tr>
                            <td>文销预约</td>
                            <td class="mainbr <?php echo ($row['wen_order_time'] && substr($row['wen_order_time'],0,10) < date('Y-m-d'))?"red":"";echo (substr($row['wen_order_time'],0,10) == date('Y-m-d'))?"orange":"";?>"><?php echo $row['wen_order_time'];?></td>
                        </tr>
                        </tbody>
                    </table>
                    <table cellpadding="5" cellspacing="0" height="678" class="fl" width="455">
                    	<tbody class="itemlist">
                        <tr class="wrap_tab">
                            <td colspan="2" height="580" class="wrap_tab"><iframe width="100%" height="100%" id="edit_member_follow" name="edit_member_follow" frameborder="0" scrolling="no" src="<?php echo site_url('manage/member_account/follow_iframe_show').'/'.$row['member_id'];?>"></iframe></td>
                        </tr>
                        <tr>
                            <td align="center" height="25" style="padding:0;" colspan="2" class="mainbr">*提示信息：<?php echo validation_errors();?></td>
                        </tr>
                        <tr>
                            <td align="center" style="padding:0;" colspan="2" class="mainbr vatop"><input style="cursor:default;" disabled="" type="submit" value="提交" <?php echo ($code==1200||$code==1000)?"disabled=''":"";?> /></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="toolbar" style="min-width:947px;">
                    <input type="button" value="删除" onclick="if(confirm('确认删除记录：ID=<?php echo $row["member_id"]?>')) location.href='<?php echo site_url('manage/member_delete/submit/'.$row['member_id'])?>'"/>
                </div>
            </form>
        </div>
    <?php endif;?>
</div>
</body>
</html>