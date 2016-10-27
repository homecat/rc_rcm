<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="p5">
    <div class="position"><b>首页</b> - 客户中心 - 参数设置</div>
    <div class="toolbar">
        <input type="button" value="返回" onclick="location.href='<?php echo site_url('manage/member_params/index/'.$page)?>'" />
    </div>
    <div class="errorbox red">
        <?php if($code==10001)echo'参数已存在';?>
    </div>
    <form method="post">
        <div class="scrollbar">
            <table width="100%" cellspacing="0" cellpadding="5">
                <tbody class="itemlist lh24">
                <tr>
                    <td>参数ID</td>
                    <td><input type="text" name="parm_id" value="<?php echo set_value('parm_id',$row['parm_id']); ?>" disabled="disabled" size="39"/>
                        <?php echo form_error('parm_id'); ?></td>
                </tr>
                <tr>
                    <td width="120">参数类别<span class="red">*</span></td>
                    <td><select name="parm_type" class="sWidth">
                            <option value="">请选择</option>
                            <option value="来源" <?php if($row['parm_type']=="来源")echo'selected="selected"';?>>来源</option>
                            <option value="渠道" <?php if($row['parm_type']=="渠道")echo'selected="selected"';?>>渠道</option>
                            <option value="账户类别" <?php if($row['parm_type']=="账户类别")echo'selected="selected"';?>>账户类别</option>
                            <option value="操作人" <?php if($row['parm_type']=="操作人")echo'selected="selected"';?>>操作人</option>
                            <option value="状态" <?php if($row['parm_type']=="状态")echo'selected="selected"';?>>状态</option>
                            <option value="跟进类型" <?php if($row['parm_type']=="跟进类型")echo'selected="selected"';?>>跟进类型</option>
                        </select>
                        <?php echo form_error('parm_type');?></td>
                </tr>
                <tr>
                    <td>参数排序<span class="red">*</span></td>
                    <td><input type="text" name="parm_sort" value="<?php echo set_value('parm_sort',$row['parm_sort']);?>" size="39"/>
                        <?php echo form_error('parm_sort');?></td>
                </tr>
                <tr>
                    <td>参数名称<span class="red">*</span></td>
                    <td><input type="text" name="parm_name" value="<?php echo set_value('parm_name',$row['parm_name']);?>" size="39"/>
                        <?php echo form_error('parm_name');?></td>
                </tr>
                <tr>
                    <td width="120">参数描述<span class="red">*</span></td>
                    <td><textarea name="parm_info"><?php echo set_value('parm_info',$row['parm_info']);?></textarea>
                        <?php echo form_error('parm_info');?></td>
                </tr>
                <tr>
                    <td>更新时间</td>
                    <td><input type="text" name="parm_time" value="<?php echo set_value('parm_time',$row['parm_time']); ?>" disabled="disabled" size="39"/>
                        <?php echo form_error('parm_time'); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="提交" /></td>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
    <div class="selectbar"></div>
    <div class="toolbar"></div>
</div>
</body>
</html>