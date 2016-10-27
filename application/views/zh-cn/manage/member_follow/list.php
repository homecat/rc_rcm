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
    <div class="position"><b>首页</b> - 客户中心 - 客户跟进记录</div>
    <form method="post">
        <table width="100%" cellspacing="0" class="toolbar">
            <tr>
                <td><input type="button" value="添加" onclick="location.href='<?php echo site_url('manage/member_follow/add')?>'" />
                    <input type="button" onclick="location.href='<?php echo site_url('manage/member_follow/index/2')?>'" value="导出Excel " />
                    <input type="reset" value="重置" />
                    <input type="submit" value="查询" /></td>
                <td align="right"><select onchange="location.href='<?php echo site_url('manage/member_follow/index/'.$sign.'/1')?>/'+this.value">
                        <option <?php if($limit==20) echo 'selected="selected"'; ?>>20</option>
                        <option <?php if($limit==50) echo 'selected="selected"'; ?>>50</option>
                        <option <?php if($limit==100) echo 'selected="selected"'; ?>>100</option>
                        <option <?php if($limit==200) echo 'selected="selected"'; ?>>200</option>
                        <option <?php if($limit==1000) echo 'selected="selected"'; ?>>1000</option>
                    </select>
                    条/页 </td>
            </tr>
        </table>
        <div class="searchbox">
            <table cellspacing="0">
                <tr>
                    <td>客户姓名</td>
                    <td><input type="text" name="member_name" value="<?php echo $search['member_name'];?>" /></td>
                    <td>跟进人</td>
                    <td><select name="follower">
                            <option value="">全部</option>
                            <?php echo $this->member_params_model->get_parm_option('操作人',$search['follower']);?>
                        </select>
                    </td>
                    <td>跟进类型</td>
                    <td><select name="follow_type">
                            <option value="">全部</option>
                            <?php echo $this->member_params_model->get_parm_option('跟进类型',$search['follow_type']);?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>开始时间</td>
                    <td><input type="text" name="time_start" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo $search['time_start'];?>"/></td>
                    <td>结束时间</td>
                    <td><input type="text" name="time_end" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" value="<?php echo $search['time_end'];?>" /></td>
                    <td colspan="2">
                        <input type="radio" name="time_type" value="1" <?php if($search['time_type']==1) echo 'checked="checked"';?> /> 预约时间
                        <input type="radio" name="time_type" value="2" <?php if($search['time_type']==2) echo 'checked="checked"';?> /> 创建时间
                    </td>
                </tr>
            </table>
        </div>
    </form>
    <div class="scrollbar">
        <table width="100%" cellspacing="0">
            <thead class="titlelist">
            <tr>
                <td>客户姓名</td>
                <td>跟进人</td>
                <td>跟进类型</td>
                <td>详情</td>
                <td>预约开始时间</td>
                <td>创建时间</td>
                <td width="100">操作</td>
            </tr>
            </thead>
            <tbody class="itemlist lh24">
            <?php foreach($result as $item):?>
                <tr>
                    <td><?php echo $this->member_account_model->member_name($item['member_id']);?></td>
                    <td><?php echo $item['follower'];?></td>
                    <td><?php echo $item['follow_type'];?></td>
                    <td><?php echo $item['follow_info'];?></td>
                    <td><?php echo $item['call_start_time'];?></td>
                    <td><?php echo $item['follow_time'];?></td>
                    <td>
                        <a class="btn del" href="<?php echo site_url('manage/member_follow/delete/'.$page.'/'.$item['follow_id'])?>">删除</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="selectbar"></div>
    <div class="toolbar"><?php echo $pages; ?></div>
</div>
</body>
</html>