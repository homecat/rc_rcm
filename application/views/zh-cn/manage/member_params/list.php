<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/script.js" language="javascript"></script>
</head>
<body>
<div class="p5">
    <div class="position"><b>首页</b> - 客户中心 - 参数设置</div>
    <div class="toolbar">
        <input type="button" value="添加" onclick="location.href='<?php echo site_url('manage/member_params/add')?>'" />
    </div>
    <div class="scrollbar">
        <table width="100%" cellspacing="0">
            <thead class="titlelist">
            <tr>
                <td>参数类别</td>
                <td>参数排序</td>
                <td>参数名称</td>
                <td>参数描述</td>
                <td>创建时间</td>
                <td width="100">操作</td>
            </tr>
            </thead>
            <tbody class="itemlist lh24">
            <?php foreach($result as $item):?>
                <tr>
                    <td><?php echo $item['parm_type'];?></td>
                    <td><?php echo $item['parm_sort'];?></td>
                    <td><?php echo $item['parm_name'];?></td>
                    <td><?php echo $item['parm_info'];?></td>
                    <td><?php echo $item['parm_time'];?></td>
                    <td>
                        <a class="btn" href="<?php echo site_url('manage/member_params/edit/'.$page.'/'.$item['parm_id'])?>">修改</a>
                        <a class="btn del" href="<?php echo site_url('manage/member_params/delete/'.$page.'/'.$item['parm_id'])?>">删除</a>
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
